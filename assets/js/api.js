
const axiosInstance =  axios.create({
  baseUrl: baseURL // GLOBAL
})

class InventoryApi{
  async get(url){
    const {data,status} =  await axiosInstance.get(url)
    return {data,status}
  }


  async post(url,dataRequest){
    const {data,status}= await axiosInstance.post(url,dataRequest)
  }
}