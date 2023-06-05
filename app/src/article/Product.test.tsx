import React from 'react';
import { render, screen } from '@testing-library/react';
import Product from "./Product";
import {ProductType} from "./ProductType";

jest.mock('./MarkButton',() => ({ product }: any) => {
    // @ts-ignore
    return <mock-mark-button data-testid={`mark-button-${product.id}`} />;
});

describe('<Product />', () => {
    test('when a Product is given then all data will be rendered', () => {
        const product: ProductType = {
            id: 'random-id',
            name: 'Foo title',
            link: 'some-link.to',
            image: 'some-image.asyto',
        }

        render(<Product product={product}/>);

        expect(screen.getByText(product.name)).toBeInTheDocument();
        expect(screen.getByTestId(`mark-button-${product.id}`)).toBeInTheDocument();
    });
});
