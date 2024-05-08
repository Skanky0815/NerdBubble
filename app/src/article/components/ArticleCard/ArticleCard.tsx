import React from "react";
import ProductCard from "../ProductCard/ProductCard";
import "./ArticleCard.css";
import datesAreOnSameDay from "../../../service/DatesAreOnSameDay";
import Article from "article/entities/Article";
import Product from "article/entities/Product";
import Provider from "article/value-objects/Provider";
import classNames from "classnames";

type ArticleCardProps = {
    article: Article
}


export default function ArticleCard({ article }: ArticleCardProps) {
    const products = article.products.map((product: Product) => <ProductCard key={product.id} product={product} />);

    const timeBgColor = datesAreOnSameDay(new Date(article.date), new Date()) ? 'bg-red-700/[.8]' : 'bg-black/[.5]';

    const articleClassNames = classNames({
        'pt-20 md:pt-32 border-l-fuchsia-800 hover:shadow-fuchsia-800 bg-top bg-contain': Provider.ASMODEE === article.provider,
        'lg:h-36 h-28 pt-6 bg-right bg-contain border-l-lime-500 hover:shadow-lime-500': Provider.XBOX_DYNASTY === article.provider,
        'bg-cover bg-center relative md:h-80 md:pt-52 border-l-orange-500 hover:shadow-orange-500': Provider.TSW === article.provider,
        'border-l-red-900 hover:shadow-red-900 bg-[length:80%] lg:bg-[center_top_1rem] bg-[center_top_2rem]': Provider.RAIL_SIM === article.provider,
        'border-l-green-600 hover:shadow-green-600 bg-[center_top_1rem] bg-[length:16rem]': Provider.F_SHOP === article.provider,
        'border-l-sky-500 hover:shadow-sky-500 bg-[center_top_1rem] bg-auto': Provider.BLUE_BRIXX === article.provider,
        'border-l-blue-600 hover:shadow-blue-600 bg-bottom p-5 h-80 bg-cover': Provider.FANTASY_FLIGHT_GAMES === article.provider,
        'h-44 md:h-80 pt-24 md:pt-64 bg-cover bg-center border-l-green-600 hover:shadow-green-600': Provider.ULISSES_SPIELE === article.provider,
    });

    return (
        <article className={`shadow-md rounded-tr-3xl bg-no-repeat bg-white pt-28 pb-1 mb-5 block relative overflow-hidden border-l-8 transition-shadow duration-500 ${article.provider} ${articleClassNames}`} style={{backgroundImage: `url("${article.image}")`}}>
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
            {article.subTitle && Provider.XBOX_DYNASTY !== article.provider && <p className="px-2 mb-2 text-sm">{article.subTitle}</p>}
            {article.description && <p className="px-2 mb-2 text-sm">{article.description}</p>}
            {products.length > 0 && <div className="columns-2 gap-2 px-2">{products}</div>}
        </article>
    );
}
