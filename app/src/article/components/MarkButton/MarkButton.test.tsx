import React, {PropsWithChildren} from "react";
import apiClient from "../../../shared-kernel/services/api";
import {AlertType} from "../../../application/context/AlertContext";
import { render, screen, waitFor } from '@testing-library/react';
import MarkButton from "./MarkButton";
import {setupServer} from "msw/node";
import {rest} from "msw";
import Product from "article/entities/Product";
import {QueryClient, QueryClientProvider} from "@tanstack/react-query";

jest.mock( '../../../application/hook/useAlert', () => {
    const setAlert = jest.fn();
    return {
        __esModule: true,
        default: () => ({ setAlert }),
    };
});

describe('<MarkButton />', () => {
    const server = setupServer(
        rest.post('/products/success-product-id/mark', (req, res, ctx) => {
            return res(ctx.status(204));
        }),
        rest.post('/products/error-product-id/mark', (req, res, ctx) => {
            return res(ctx.status(500), ctx.json({ message: 'Invalid ID' }));
        }),
    );

    const queryClient = new QueryClient();
    const wrapper = ({ children }: PropsWithChildren) => (
        <QueryClientProvider client={queryClient}>
            {children}
        </QueryClientProvider>
    );

    beforeAll(() => server.listen())
    afterEach(() => server.resetHandlers())
    afterAll(() => server.close())

    test('when click the mark button and the api will called then a success message is shown', async () => {
        const {setAlert} = jest.requireMock('../../../application/hook/useAlert').default();
        jest.spyOn(apiClient, 'post');

        const product: Product = {
            id: 'success-product-id',
            name: 'Produkt name',
            link: 'https://link.de',
            image: 'https://image.omg',
        }

        render(<MarkButton product={product} />, {wrapper});

        screen.getByTestId('mark-button').click();

        await waitFor(() => {
            expect(apiClient.post).toHaveBeenCalledWith('/products/success-product-id/mark');
            expect(setAlert).toHaveBeenCalledWith('Produkt gemerkt', AlertType.SUCCESS);
        });
    });

    test.skip('when click the mark button and the api will called then a error message is shown', async () => {
        const {setAlert} = jest.requireMock('../../../application/hook/useAlert').default();
        jest.spyOn(apiClient, 'post');

        const product: Product = {
            id: 'error-product-id',
            name: 'Produkt name',
            link: 'https://link.de',
            image: 'https://image.omg',
        }

        render(<MarkButton product={product} />, {wrapper});

        screen.getByTestId('mark-button').click();

        await waitFor(() => {
            expect(apiClient.post).toHaveBeenCalledWith('/products/error-product-id/mark');
            expect(setAlert).toHaveBeenCalledWith('Invalid ID', AlertType.ERROR);
        });
    });
});
