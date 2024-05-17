

const formLogin = document.querySelector('#formLogin')


const inventoryApi = new InventoryApi()



const handleSubmitLogin= async(event)=>{
  
  event.preventDefault();
  const dataForm =  new FormData(formLogin)
  const valuesForm = Object.fromEntries(dataForm)
  console.log(valuesForm);
  
  inventoryApi.post(`${baseURL}login/initLogin`,valuesForm)
  .then((res)=>{
    console.log(res)
    window.location.reload();
  })
  .catch((e)=>{
    Swal.fire('Atencíon',e.response.data.message|| 'Error al iniciar sesion','error')
  })
}




formLogin.addEventListener('submit',handleSubmitLogin)