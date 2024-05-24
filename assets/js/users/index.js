document.addEventListener("DOMContentLoaded", () => {
	const inventoryApi = new InventoryApi();
	const btnCreatedUser = document.querySelector('#btnCreatedUser')
	const formNewUser =  document.querySelector('#formNewUser')
	let dataUsers = [];

	const table = new DataTable("#tableUsers", {
		columns: [
			{ data: "id", title: "ID" },
			{ data: "name", title: "Nombre" },
			{ data: "user", title: "Usuario" },
			{ data: "email", title: "Email" },
		],
	});

	const drawTableUsers = () => {
		table.rows().remove().draw()
    table.rows.add(dataUsers).draw()
	};

	const loadDataUsers = () => {
		inventoryApi
			.post(`${baseURL}user/listUsers`)
			.then((res) => {
				const { status, data } = res;
				dataUsers = data.data.map(({ id, name, user, email }) => ({
					id,
					name,
					user,
					email,
				}));
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


	/* listeners */
	btnCreatedUser.addEventListener('click',()=>{
		$('#modalApp').modal('show')
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
