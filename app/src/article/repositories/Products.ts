import Product from "article/entities/Product";
import apiClient from "../../shared-kernel/services/api";

const Products = {
    markAsFavourite: async (id: string) => {
        const response = await apiClient.post(`/products/${id}/mark`);

        return response.data;
    },
    findMarked: async () => {
        const response = await apiClient.get<{data: Product[]}>('/marked-products');

        return response.data.data;
    }
}

export default Products;
