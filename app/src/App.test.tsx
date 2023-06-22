import React from 'react';
import { render, screen } from '@testing-library/react';
import App from './App';
import useLoggedIn from './common/hook/useLoggedIn';

jest.mock('./common/hook/useLoggedIn', () => jest.fn());

jest.mock("./article/ArticleList", () => () => {
    // @ts-ignore
    return <mock-article-list data-testid="article-list" />;
});

jest.mock("./components/BottomNavigation", () => () => {
    // @ts-ignore
    return <mock-bottom-navigation data-testid="bottom-navigation" />;
});

describe('<App />', () => {
    test('renders LoginForm when not logged in', () => {
        (useLoggedIn as jest.Mock).mockReturnValue({ loggedIn: false, login: jest.fn(), logout: jest.fn() });

        render(<App />);

        expect(screen.getByTestId('login-form')).toBeInTheDocument();
    });

    test('renders ArticleList and BottomNavigation when logged in', () => {
        (useLoggedIn as jest.Mock).mockReturnValue({ loggedIn: true, login: jest.fn(), logout: jest.fn() });

        render(<App />);

        expect(screen.getByTestId('article-list')).toBeInTheDocument();
        expect(screen.getByTestId('bottom-navigation')).toBeInTheDocument();
    });
});
