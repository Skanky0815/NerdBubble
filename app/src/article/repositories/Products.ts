import Product from "article/entities/Product";
import apiClient from "../../service/api";

const Products = {
    markAsFavourite: async (id: string) => {
        const response = await apiClient.post(`/api/products/${id}/mark`);

        return response.data;
    },
    findMarked: async () => {
        const response = await apiClient.get<{data: Product[]}>('api/marked-products');

        return response.data.data;
    }
}

export default Products;
