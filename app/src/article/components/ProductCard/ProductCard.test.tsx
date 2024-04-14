import React from 'react';
import { render, screen } from '@testing-library/react';
import ProductCard from "./ProductCard";
import Product from 'article/entities/Product';

jest.mock('../MarkButton/MarkButton',() => ({ product }: any) => {
    // @ts-ignore
    return <mock-mark-button data-testid={`mark-button-${product.id}`} />;
});

describe('<ProductCard />', () => {
    test('when a Product is given then all data will be rendered', () => {
        const product: Product = {
            id: 'random-id',
            name: 'Foo title',
            link: 'some-link.to',
            image: 'some-image.asyto',
        }

        render(<ProductCard product={product}/>);

        expect(screen.getByText(product.name)).toBeInTheDocument();
        expect(screen.getByTestId(`mark-button-${product.id}`)).toBeInTheDocument();
    });
});
