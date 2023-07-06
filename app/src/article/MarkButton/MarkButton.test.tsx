import React from "react";
import apiClient from "../../service/api";
import {AlertType} from "../../common/context/AlertContext";
import {ProductType} from "../ProductType";
import { render, screen, waitFor } from '@testing-library/react';
import MarkButton from "./MarkButton";
import {setupServer} from "msw/node";
import {rest} from "msw";

jest.mock('../../common/hook/useAlert', () => {
    const setAlert = jest.fn();
    return {
        __esModule: true,
        default: () => ({ setAlert }),
    };
});

describe('<MarkButton />', () => {
    const server = setupServer(
        rest.post('/api/products/success-product-id/mark', (req, res, ctx) => {
            return res(ctx.status(204));
        }),
        rest.post('/api/products/error-product-id/mark', (req, res, ctx) => {
            return res(ctx.status(500), ctx.json({ message: 'Invalid ID' }));
        }),
    );

    beforeAll(() => server.listen())
    afterEach(() => server.resetHandlers())
    afterAll(() => server.close())

    test('when click the mark button and the api will called then a success message is shown', async () => {
        const {setAlert} = jest.requireMock('../../common/hook/useAlert').default();
        jest.spyOn(apiClient, 'post');

        const product: ProductType = {
            id: 'success-product-id',
            name: 'Produkt name',
            link: 'https://link.de',
            image: 'https://image.omg',
        }

        render(<MarkButton product={product} />);

        screen.getByTestId('mark-button').click();

        await waitFor(() => {
            expect(apiClient.post).toHaveBeenCalledWith('/api/products/success-product-id/mark');
            expect(setAlert).toHaveBeenCalledWith('Produkt gemerkt', AlertType.SUCCESS);
        });
    });

    test.skip('when click the mark button and the api will called then a error message is shown', async () => {
        const {setAlert} = jest.requireMock('../../common/hook/useAlert').default();
        jest.spyOn(apiClient, 'post');

        const product: ProductType = {
            id: 'error-product-id',
            name: 'Produkt name',
            link: 'https://link.de',
            image: 'https://image.omg',
        }

        render(<MarkButton product={product} />);

        screen.getByTestId('mark-button').click();

        await waitFor(() => {
            expect(apiClient.post).toHaveBeenCalledWith('/api/products/error-product-id/mark');
            expect(setAlert).toHaveBeenCalledWith('Invalid ID', AlertType.ERROR);
        });
    });
});
