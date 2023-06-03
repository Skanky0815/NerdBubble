import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'http://localhost',
    withCredentials: true,
});

apiClient.defaults.headers.common['Accept'] = 'application/json';

export default apiClient;
