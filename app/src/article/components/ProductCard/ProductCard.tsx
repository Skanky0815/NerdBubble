import Product from "article/entities/Product";
import React from "react";
import MarkButton from "../MarkButton/MarkButton";

type ProductProps = {
    product: Product
}

const ProductCard = ({ product }: ProductProps) => {
    return (
        <figure
            className="flex flex-col gap-2 p-2 my-2 border border-gray-100 rounded hover:shadow-md"
            data-testid="product"
        >
            <div>
                <a href={product.link} target="_blank" rel="noreferrer">
                    <h3 className="text-xs">{product.name}</h3>
                </a>

                <MarkButton product={product} />
            </div>

            <img src={product.image} alt={product.name}/>
        </figure>
    );
}

export default ProductCard;
