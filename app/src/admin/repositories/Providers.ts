import apiClient from "../../shared-kernel/services/api";
import Provider from "../entities/Provider";
import ProviderData from "../value-objects/ProviderData";
import SelectorData from "../value-objects/SelectorData";
import SelectorTest from "../value-objects/SelectorTest";

const Providers = {
    findAll: async () => {
        const response = await apiClient.get<{ data: Provider[]}>('/providers');

        return response.data.data;
    },
    find: async (id: string) => {
        const response = await apiClient.get<{ data: Provider}>(`/providers/${id}`);

        return response.data.data;
    },
    save: async (providerData: ProviderData) => {
        if (providerData.id) {
            await apiClient.put(`/providers/${providerData.id}`, providerData);
        } else {
            await apiClient.post('/providers', providerData);
        }
    },
    test: async(selectorData: SelectorData) => {
        const response = await apiClient.post<SelectorTest>('/providers/actions', {action: 'TEST_SELECTORS', data: selectorData});

        return response.data;
    }
}

export default Providers;
