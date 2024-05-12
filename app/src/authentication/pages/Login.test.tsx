import React, {PropsWithChildren} from 'react';
import {render, screen, waitFor} from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { rest } from 'msw';
import { setupServer } from 'msw/node';
import Login from './Login';
import { AlertType } from '../../application/context/AlertContext';
import apiClient from '../../shared-kernel/services/api';
import {QueryClient, QueryClientProvider} from "@tanstack/react-query";

jest.mock('../../application/hook/useAlert', () => {
    const setAlert = jest.fn();
    return {
        __esModule: true,
        default: () => ({ setAlert }),
    };
});

describe('<Login />', () => {
    const server = setupServer(
        rest.get('/csrf-cookie', (req, res, ctx) => {
            return res(ctx.status(200));
        }),
        rest.post('/login', async (req, res, ctx) => {
            const { email, password } = await req.json<{email: string, password: string}>();
            if (email === 'test@example.com' && password === 'password') {
                return res(ctx.status(200));
            } else {
                return res(ctx.status(400), ctx.json({ message: 'Invalid credentials' }));
            }
        })
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

    test.skip('submits the form and performs login on successful response', async () => {
        const login = jest.fn();
        jest.spyOn(apiClient, 'post');

        render(<Login />, {wrapper});

        await userEvent.type(screen.getByLabelText('E-Mail-Adresse*'), 'test@example.com');
        await userEvent.type(screen.getByLabelText('Passwort*'), 'password');
        await userEvent.click(screen.getByText('Anmelden'));

        await waitFor(() => {
            expect(apiClient.post).toHaveBeenCalledWith('/login', {
                email: 'test@example.com',
                password: 'password',
            });
            expect(login).toHaveBeenCalled();
        });
    });

    test.skip('displays error message on failed login', async () => {
        const {setAlert} = jest.requireMock('../common/hook/useAlert').default();
        jest.spyOn(apiClient, 'get');
        jest.spyOn(apiClient, 'post');

        render(<Login />, {wrapper});

        await userEvent.type(screen.getByTestId('email'), 'test@example.com');
        await userEvent.type(screen.getByTestId('password'), 'incorrect');
        await userEvent.click(screen.getByTestId('login'));

        await waitFor(() => {
            expect(apiClient.get).toHaveBeenCalledWith('/csrf-cookie');
            expect(apiClient.post).toHaveBeenCalledWith('/login', {
                email: 'test@example.com',
                password: 'incorrect',
            });

            expect(setAlert).toHaveBeenCalledWith('Invalid credentials', AlertType.ERROR);
        });
    });
});
