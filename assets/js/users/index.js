document.addEventListener("DOMContentLoaded", () => {
	const inventoryApi = new InventoryApi();
	const btnCreatedUser = document.querySelector('#btnCreatedUser')
	const formNewUser =  document.querySelector('#formNewUser')
	const formEditUser =  document.querySelector('#formEditUser')
	let dataUsers = [];
	let userToEdit={}

	const table = new DataTable("#tableUsers", {
		columns: [
			{ data: "id", title: "ID" },
			{ data: "name", title: "Nombre" },
			{ data: "user", title: "Usuario" },
			{ data: "email", title: "Email" },
			{ data: "btnActions", title: "Acciones" },
		],
	});

	function editUser(userID){
		const currentDataUser = dataUsers.find(user=>user.id === userID)
		userToEdit=currentDataUser
		if(!currentDataUser?.name) return Swal.fire({title:'Atención',text:'no se encontro el usuario a modificar',icon:'warning',timer:800})
		document.querySelector('#nameEdit').value=currentDataUser.name
		document.querySelector('#emailEdit').value=currentDataUser.email
		$('#modalEditUser').modal('show')
	}

	function execDeleteUser(userID){
		inventoryApi.get(`${baseURL}user/removeUser?userId=${userID}`)
		.then((res)=>{
			const {status}=res
			if(status === 200){
				loadDataUsers()
				Swal.fire({
					title:'Usuario Eliminado',
					timer:800,
					icon: "success"
				})
			}
		})
		.catch((e)=>{
			console.log(e);
			const message = e.response?.data?.message || 'Ocurrio un error eliminando el usuario'
			Swal.fire({
				title:'Atención',
				text:message,
				icon:'error'
			})
		})
	}

	function removeUser(userID){
		console.log('eliminando usuario',userID)
		Swal.fire({
			title: "Seguro de  eliminar el usuario?",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#d33",
			confirmButtonText: "Eliminar",

		}).then((result) => {
			/* Read more about isConfirmed, isDenied below */
			if (result.isConfirmed) {
				execDeleteUser(userID)
			} 
		});
		
	}

	function drawTableUsers ()  {
		table.rows().remove().draw()
    table.rows.add(dataUsers).draw()

		const btnEdit = document.querySelectorAll('.btnEdit')
		btnEdit.forEach(btn=> btn.addEventListener('click',(e)=>editUser(e.target.value)))


		const btnRemove = document.querySelectorAll('.btnRemove')
		btnRemove.forEach(btn=> btn.addEventListener('click',(e)=>removeUser(e.target.value)))
	};

	function loadDataUsers  ()  {
		userToEdit={}
		inventoryApi
			.post(`${baseURL}user/listUsers`)
			.then((res) => {
				const { status, data } = res;
				dataUsers = data.data.map(({ id, name, user, email }) => {
					const btnActions =`
						<button class="btn btn-sm btn-primary btnEdit" value=${id}>Modificar <i class="fas fa-edit"></i></button>
						<button class="btn btn-sm btn-danger btnRemove" value=${id}>Eliminar <i class="fas fa-trash"></i></button>
					`;
					return{
					id,
					name,
					user,
					email,
					btnActions
				}});
				drawTableUsers();
			})
			.catch((e) => {
				Swal.fire(
					"Atencíon",
					e.response?.data?.message || "Error al cargar datos de usuarios",
					"error"
				);
			});
	};

	function execUpdateUser(dataForm){
		const newData = {
			...dataForm,
			userId:userToEdit.id
		}
		inventoryApi.post(`${baseURL}user/updateUser`,newData)
		.then(res=>{
			const {status,data}=res
			if(status === 200){
				Swal.fire({
					title:'Atención',
					text:data.message || 'Usuario Actualizado correctamente',
					icon:'success',
					timer:1000
				})
				$('#modalEditUser').modal('hide')

				loadDataUsers()
				return
			}
		})
		.catch(e=>{
			console.log(e)
			const message =  e.response?.data?.message || 'Ocurrio un errro actualizando el usuario'
			Swal.fire({
				title:'Atención',
				text:message,
				icon:'error',
				timer:1000
			})
		})
	}


	/* listeners */
	btnCreatedUser.addEventListener('click',()=>{
		$('#modalApp').modal('show')
	})

	formEditUser.addEventListener('submit',(e)=>{
		e.preventDefault();
		const formData = new FormData(formEditUser)
		const data = Object.fromEntries(formData);

		const {nameEdit,emailEdit}=data

		if(nameEdit === userToEdit.name && emailEdit === userToEdit.email){
			Swal.fire({
				title:'Atención',
				text:'Realice modificaciones antes de guardar',
				icon:'warning',
				timer:1000
			})
			return
		}
		execUpdateUser(data)
	})

	formNewUser.addEventListener('submit',(e)=>{
		e.preventDefault();

		const formData =  new FormData(formNewUser)
		const data =  Object.fromEntries(formData)
		const {name,email,user,password} = data
		if(!name || !email || !user || !password){
			Swal.fire({
				title:'Atención',
				text:'Todos los campos del formulario son requeridos',
				timer:1000
			})
			return
		}
		inventoryApi.post(`${baseURL}user/createUser`,data)
		.then(res=>{
			const {status,data} =res
			if(status ===200){
				Swal.fire({
					title:'Atención',
					text:'Usuario creado con exito',
					timer:1000
				})
				formNewUser.reset();
				$('#modalApp').modal('hide');
				loadDataUsers();

			}
		})
		.catch(e=>{
			Swal.fire(
				"Atencíon",
				e.response?.data?.message || "Error al cargar datos de usuarios",
				"error"
			);
		})


	})



	loadDataUsers();
});
