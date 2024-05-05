import React from "react";
import useAlert from "../../common/hook/useAlert";
import {AlertType} from "../../common/context/AlertContext";
import {useQuery} from "@tanstack/react-query";
import Products from "../../article/repositories/Products";
import PageTitle from "shared-kernel/components/PageTitle/PageTitle";
import Loading from "shared-kernel/components/Loading/Loading";
import Product from "article/entities/Product";
import ProductCard from "article/components/ProductCard/ProductCard";

export default function MarkedProducts() {
    const {setAlert} = useAlert();
    const {data: products, error, isLoading, isError} = useQuery({
        queryKey: ['marked-products'],
        queryFn: Products.findMarked,
    });

    if (isError) {
        setAlert(error.message, AlertType.ERROR);
    }

    const productList = products?.map((product: Product) => <ProductCard key={product.id} product={product} />);

    return (
        <>
            <PageTitle text={`Marked Products`} />

            {isLoading
                ? <Loading color={`green`} />
                : <div className="gap-4 columns-1 md:columns-2">{productList}</div>}
        </>
    );
}
