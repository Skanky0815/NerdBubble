import React from "react";
import {ArticleType} from "./ArticleType";
import {ProductType} from "./ProductType";
import Product from "./Product";
import "./Article.css";
import datesAreOnSameDay from "../service/DatesAreOnSameDay";

type ArticleProps = {
    article: ArticleType
}


export default function Article({ article }: ArticleProps) {
    const products = article.products.map((product: ProductType) => <Product key={product.id} product={product} />);

    const timeBgColor = datesAreOnSameDay(new Date(article.date), new Date()) ? 'bg-red-700/[.8]' : 'bg-black/[.5]';

    return (
        <article className={`drop-shadow-lg rounded-xl bg-no-repeat bg-top bg-contain bg-white pt-28 pb-1 mb-5 block relative overflow-hidden ${article.provider}`} style={{backgroundImage: `url(${article.image})`}}>
            <a href={article.link} target="_blank" rel="noreferrer" className="w-full aspect-auto">
                <time className={`text-white text-xs absolute ${timeBgColor} px-1 py-0.5 mb-5 top-0 left-0`} dateTime={article.date}>
                    {article.date}
                </time>
                <h2 className="text-white w-auto block bg-black/[.5] px-2 py-2 mt-0.5 mb-1">{article.title}</h2>
            </a>
            {article.subTitle && <p className="px-2 mb-2 text-sm">{article.subTitle}</p>}
            {article.description && <p className="px-2 mb-2 text-sm">{article.description}</p>}
            {products.length > 0 && <div className="grid grid-flow-row grid-cols-2 gap-2 px-2">{products}</div>}
        </article>
    );
}
