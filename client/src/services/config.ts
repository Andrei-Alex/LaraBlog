import axios from 'axios';


const apiInstance = axios.create({
    baseURL: process.env.NEXT_PUBLIC_SERVER_API
});

export default apiInstance;
