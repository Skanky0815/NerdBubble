import apiClient from "../../shared-kernel/services/api";
import Keyword from "../entities/Keyword";
import KeywordData from "../value-objects/KeywordData";

const Keywords = {
    add: async (keywordData: KeywordData) => {
        await apiClient.post('keywords', keywordData);
    },
    findAll: async () => {
        const response = await apiClient.get<{data: Keyword[]}>('keywords');

        return response.data.data
    },
    remove: async (id: string) => {
        await apiClient.delete(`keywords/${id}`);
    }
}

export default Keywords;
