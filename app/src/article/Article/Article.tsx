import React from "react";
import {ArticleType, Provider} from "../ArticleType";
import {ProductType} from "../ProductType";
import Product from "../Product/Product";
import "./Article.css";
import datesAreOnSameDay from "../../service/DatesAreOnSameDay";

type ArticleProps = {
    article: ArticleType
}


export default function Article({ article }: ArticleProps) {
    const products = article.products.map((product: ProductType) => <Product key={product.id} product={product} />);

    const timeBgColor = datesAreOnSameDay(new Date(article.date), new Date()) ? 'bg-red-700/[.8]' : 'bg-black/[.5]';

    let classNames = null;
    switch (article.provider) {
        case Provider.ASMODEE:
            classNames = 'pt-20 md:pt-32 border-l-fuchsia-800 hover:shadow-fuchsia-800';
            break;
        case Provider.XBOX_DYNASTY:
            classNames = 'md:h-48 h-auto bg-right-top pt-16 bg-contain border-l-lime-500 hover:shadow-lime-500';
            break;
        case Provider.TSW:
            classNames = 'bg-cover relative md:h-80 md:pt-64 border-l-orange-500 hover:shadow-orange-500';
            break;
        case Provider.RAIL_SIM:
            classNames = 'border-l-red-900 hover:shadow-red-900 bg-auto';
            break;
        case Provider.F_SHOP:
            classNames = 'border-l-green-600 hover:shadow-green-600';
            break;
        case Provider.BLUE_BRIXX:
            classNames = 'border-l-sky-500 hover:shadow-sky-500';
            break;
        case Provider.FANTASY_FLIGHT_GAMES:
            classNames = 'border-l-blue-600 hover:shadow-blue-600 bg-bottom p-5 h-80 bg-cover';
            break;
        case Provider.ULISSES_SPIELE:
            classNames = 'h-44 md:h-80 pt-32 md:pt-64 bg-cover border-l-green-600 hover:shadow-green-600';
            break;
    }

    return (
        <article className={`shadow-md rounded-xl bg-no-repeat bg-top bg-contain bg-white pt-28 pb-1 mb-5 block relative overflow-hidden border-l-8 transition-shadow duration-500 ${article.provider} ${classNames}`} style={{backgroundImage: `url(${article.image})`}}>
            <a
                href={article.link}
                target="_blank"
                rel="noreferrer"
                className="w-full aspect-auto"
                data-testid="article-external-link"
            >
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
