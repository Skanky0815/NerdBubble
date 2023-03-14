import React from 'react';
import { rest } from 'msw';
import { setupServer } from 'msw/node';
import { render, screen, waitFor } from '@testing-library/react';
import ArticleList from './ArticleList';

const server = setupServer(
    rest.get('http://0.0.0.0/api/articles', (req, res, ctx) => {
        return res(ctx.json({
            data: [
                {
                    id: 'fc0f1aa5-be91-4762-88e8-726755cb95b8'
                }
            ]
        }))
    }),
)

beforeAll(() => server.listen())
afterEach(() => server.resetHandlers())
afterAll(() => server.close())

jest.mock("./Article", () => ({ article }: any) => {
    // @ts-ignore
    return <mock-article data-testid={article.id} />;
});

test('when Articles successful loaded then render the <Article> component', async () => {
    render(<ArticleList />);

    expect(screen.getByText('NerdBubble')).toBeInTheDocument();

    await waitFor(() => {
        expect(screen.getByText('Loading...')).not.toBeInTheDocument();
    });

    expect(screen.getByTestId('fc0f1aa5-be91-4762-88e8-726755cb95b8')).toBeInTheDocument();
});