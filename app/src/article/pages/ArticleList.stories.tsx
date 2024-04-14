import React from "react";
import ArticleList from "./ArticleList";
import {Meta, StoryObj} from "@storybook/react";
import {rest} from "msw";
import {
    AsmodeeArticle,
    BlueBrixxArticle,
    FantasyFlightGamesArticle, FShopArticle,
    RailSimArticle,
    TSWArticle, UlissesSpieleArticle,
    XboxDynastyArticle
} from "../../mock/data";

const meta = {
    title: 'Page/ArticleList',
    component: ArticleList,
    parameters: {
        msw: {
            handlers: [
                rest.get('*/api/articles', (req, res, ctx) => {
                    return res(
                        ctx.json({
                            data: [
                                XboxDynastyArticle,
                                BlueBrixxArticle,
                                RailSimArticle,
                                FShopArticle,
                                AsmodeeArticle,
                                TSWArticle,
                                FantasyFlightGamesArticle,
                                UlissesSpieleArticle,
                            ]
                        })
                    )
                }),
            ]
        }
    }
} satisfies Meta<typeof ArticleList>;

export default meta;

type Story = StoryObj<typeof meta>;

export const ArticleListPage: Story = {
    args: {

    }
}
