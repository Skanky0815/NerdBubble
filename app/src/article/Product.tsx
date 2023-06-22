import React from "react";
import {ProductType} from "./ProductType";
import MarkButton from "./MarkButton";

type ProductProps = {
    product: ProductType
}

export default function Product({ product }: ProductProps) {
    return (
        <figure
            className="p-2 border border-gray-100 rounded hover:shadow-md w-auto h-52 md:h-96 bg-bottom bg-contain bg-no-repeat" style={{backgroundImage: `url(${product.image})`}}
            data-testid="product"
        >
            <a href={product.link} target="_blank">
                <h3 className="text-xs">{product.name}</h3>
            </a>

            <MarkButton product={product} />
        </figure>
    );
}
