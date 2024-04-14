import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://localhost',
    withCredentials: true,
    withXSRFToken: true,
    headers: {
        'Accept': 'application/json'
    }
});

export default apiClient;
