import LoginData from "authentication/value-objects/LoginData";
import apiClient from "../../service/api";
import User from "../entities/User";

const Users = {
    authenticate: async (loginData: LoginData) => {
        const response = await apiClient.post('/login', loginData);

        return response.data;
    },
    logout: async () => {
        const response = await apiClient.post('/logout');

        return response.data;
    },
    me: async () => {
        const response = await apiClient.get<User>('/api/me');

        return response.data;
    }
}

export default Users;
