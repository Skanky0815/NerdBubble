import React from 'react';
import {render, screen} from '@testing-library/react';
import ArticleCard from "./ArticleCard";
import Provider from 'article/value-objects/Provider';
import Article from 'article/entities/Article';
import Product from 'article/entities/Product';

jest.mock('../ProductCard/ProductCard', () => ({ product }: any) => {
    // @ts-ignore
    return <mock-product-card data-testid={product.id} />;
})

describe('<ArticleCard />', () => {
    test('when ArticleCard is given then the all data will be rendered', () => {
        const product: Product = {
            id: '876e73c6-bc79-4d6f-9528-147d0ab9d139',
            name: 'Bar title',
            link: 'product-link.to',
            image: 'product-image.to',
        }

        const article: Article = {
            id: 'c2f5a9e5-e673-494f-b086-95dbb3fd292d',
            title: 'Foo Title',
            subTitle: 'some text',
            link: 'link.to',
            image: 'image-link.to',
            date: '2023-01-01',
            provider: Provider.ASMODEE,
            products: [product],
        }
        render(<ArticleCard article={article}/>);

        expect(screen.getByText(article.title)).toBeInTheDocument();
        expect(screen.getByText(article.subTitle!!)).toBeInTheDocument();
        expect(screen.getByText(article.date)).toBeInTheDocument();
        expect(screen.getByTestId(product.id)).toBeInTheDocument();
    });
});
