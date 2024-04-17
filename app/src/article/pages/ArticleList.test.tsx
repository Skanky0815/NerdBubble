import React, {PropsWithChildren} from 'react';
import { rest } from 'msw';
import { setupServer } from 'msw/node';
import { render, screen, waitFor } from '@testing-library/react';
import ArticleList from './ArticleList';
import {QueryClient, QueryClientProvider} from "@tanstack/react-query";

jest.mock("../components/ArticleCard/ArticleCard", () => ({ article }: any) => {
    // @ts-ignore
    return <mock-article data-testid={article.id} />;
});

describe('<ArticleList />', () => {
    const server = setupServer(
        rest.get('/articles', (req, res, ctx) => {
            return res(
                ctx.delay(500),
                ctx.json({
                    data: [
                        {
                            id: 'fc0f1aa5-be91-4762-88e8-726755cb95b8'
                        }
                    ]
                })
            )
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

    test('when Articles successful loaded then render the <ArticleCard> component', async () => {
        render(<ArticleList/>, {wrapper});

        expect(screen.getByText('NerdBubble')).toBeInTheDocument();
        expect(screen.getByText('Loading...')).toBeInTheDocument();

        await waitFor(() => {
            expect(screen.queryByText('Loading...')).not.toBeInTheDocument();
            expect(screen.getByTestId('fc0f1aa5-be91-4762-88e8-726755cb95b8')).toBeInTheDocument();
        });
    });
});
