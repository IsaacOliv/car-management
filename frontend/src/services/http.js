import axios from 'axios'

const axiosInstance = axios.create({
    baseURL: 'http://localhost:8000',
    Headers: {
        'Content-Type': 'application/json'
    },

})
export default axiosInstance;