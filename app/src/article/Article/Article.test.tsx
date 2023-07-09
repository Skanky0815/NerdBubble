import React from 'react';
import {render, screen} from '@testing-library/react';
import Article from "./Article";
import {ArticleType, Provider} from "../ArticleType";
import {ProductType} from "../ProductType";

jest.mock('../Product/Product', () => ({ product }: any) => {
    // @ts-ignore
    return <mock-product data-testid={product.id} />;
})

describe('<Article />', () => {
    test('when Article is given then the all data will be rendered', () => {
        const product: ProductType = {
            id: '876e73c6-bc79-4d6f-9528-147d0ab9d139',
            name: 'Bar title',
            link: 'product-link.to',
            image: 'product-image.to',
        }

        const article: ArticleType = {
            id: 'c2f5a9e5-e673-494f-b086-95dbb3fd292d',
            title: 'Foo Title',
            subTitle: 'some text',
            link: 'link.to',
            image: 'image-link.to',
            date: '2023-01-01',
            provider: Provider.ASMODEE,
            products: [product],
        }
        render(<Article article={article}/>);

        expect(screen.getByText(article.title)).toBeInTheDocument();
        expect(screen.getByText(article.subTitle!!)).toBeInTheDocument();
        expect(screen.getByText(article.date)).toBeInTheDocument();
        expect(screen.getByTestId(product.id)).toBeInTheDocument();
    });
});
