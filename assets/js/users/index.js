document.addEventListener("DOMContentLoaded", () => {
	const inventoryApi = new InventoryApi();
	const table = new DataTable("#tableUsers", {
		columns: [
			{ data: "id", title: "ID" },
			{ data: "name", title: "Nombre" },
			{ data: "user", title: "Usuario" },
			{ data: "email", title: "Email" },
		],
	});
	let dataUsers = [];

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

	loadDataUsers();
});
