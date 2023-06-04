import React from 'react';
import { render, screen } from '@testing-library/react';
import Product from "./Product";
import {ProductType} from "./ProductType";

describe('<Product />', () => {
    test('when a Product is given then all data will be rendered', () => {
        const product: ProductType = {
            id: 'random-id',
            name: 'Foo title',
            link: 'some-link.to',
            image: 'some-image.to',
        }

        render(<Product product={product}/>);

        expect(screen.getByText(product.name)).toBeInTheDocument();
    });
});
