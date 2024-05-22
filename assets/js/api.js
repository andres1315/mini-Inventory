

const axiosInstance =  axios.create({
  baseUrl: baseURL // GLOBAL
})

class InventoryApi{
  async get(url){
    const {data,status} =  await axiosInstance.get(url)
    return {data,status}
  }


  async post(url,dataRequest){
    const {data,status}= await axiosInstance.postForm(url,dataRequest)  //POSTFORM para que sean enviados el json como formulario y no comoc ontenido del body del request
    return {data,status}
  }
}