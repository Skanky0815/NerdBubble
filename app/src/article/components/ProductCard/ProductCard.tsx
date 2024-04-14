import Product from "article/entities/Product";
import React from "react";
import MarkButton from "../MarkButton/MarkButton";

type ProductProps = {
    product: Product
}

const ProductCard = ({ product }: ProductProps) => {
    return (
        <figure
            className="p-2 border border-gray-100 rounded hover:shadow-md w-auto h-52 md:h-96 bg-bottom bg-contain bg-no-repeat" style={{backgroundImage: `url(${product.image})`}}
            data-testid="product"
        >
            <a href={product.link} target="_blank" rel="noreferrer">
                <h3 className="text-xs">{product.name}</h3>
            </a>

            <MarkButton product={product} />
        </figure>
    );
}

export default ProductCard;
