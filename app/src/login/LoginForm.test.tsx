import React from 'react';
import {render, screen, waitFor} from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { rest } from 'msw';
import { setupServer } from 'msw/node';
import LoginForm from './LoginForm';
import { AlertType } from '../common/context/AlertContext';
import apiClient from '../service/api';

jest.mock('../common/hook/useAlert', () => {
    const setAlert = jest.fn();
    return {
        __esModule: true,
        default: () => ({ setAlert }),
    };
});

describe('<LoginForm />', () => {
    const server = setupServer(
        rest.get('/sanctum/csrf-cookie', (req, res, ctx) => {
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

    beforeAll(() => server.listen())
    afterEach(() => server.resetHandlers())
    afterAll(() => server.close())

    test('submits the form and performs login on successful response', async () => {
        const login = jest.fn();
        jest.spyOn(apiClient, 'get');
        jest.spyOn(apiClient, 'post');

        render(<LoginForm login={login}/>);

        await userEvent.type(screen.getByTestId('email'), 'test@example.com');
        await userEvent.type(screen.getByTestId('password'), 'password');
        await userEvent.click(screen.getByTestId('login'));

        await waitFor(() => {
            expect(apiClient.get).toHaveBeenCalledWith('/sanctum/csrf-cookie');
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

        render(<LoginForm login={jest.fn()}/>);

        await userEvent.type(screen.getByTestId('email'), 'test@example.com');
        await userEvent.type(screen.getByTestId('password'), 'incorrect');
        await userEvent.click(screen.getByTestId('login'));

        await waitFor(() => {
            expect(apiClient.get).toHaveBeenCalledWith('/sanctum/csrf-cookie');
            expect(apiClient.post).toHaveBeenCalledWith('/login', {
                email: 'test@example.com',
                password: 'incorrect',
            });

            expect(setAlert).toHaveBeenCalledWith('Invalid credentials', AlertType.ERROR);
        });
    });
});
