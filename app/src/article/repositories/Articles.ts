import apiClient from "../../service/api";
import Article from "article/entities/Article";

const Articles = {
    findAll: async () => {
        const response = await apiClient.get<{ data: Article[] }>('/articles');

        return response.data.data;
    }
}

export default Articles;
