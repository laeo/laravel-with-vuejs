import axios from 'axios';

const api = axios.create({
    baseURL: `${process.env.MAPI}/v1`
});

export default api;
