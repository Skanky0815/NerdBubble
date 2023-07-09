import React from "react";
import Article from "./Article";
import {Meta, StoryObj} from "@storybook/react";
import {ArticleType} from "../ArticleType";
import {
    AsmodeeArticle, BlueBrixxArticle,
    FantasyFlightGamesArticle, FShopArticle,
    RailSimArticle,
    TSWArticle, UlissesSpieleArticle,
    XboxDynastyArticle
} from "../../mock/data";

const meta = {
    title: 'Article/Article',
    component: Article,
    tags: ['autodocs'],
} satisfies Meta<typeof Article>;

export default meta;

type Story = StoryObj<typeof meta>;

export const Basic: Story = {
    args: {
        article: {
            id: '91626c93-1c26-4358-8452-6628a7dce7fb',
            title: 'Nice Article Title',
            image: 'https://picsum.photos/200',
            link: 'https://ww.google.de',
            date: '2023-01-01',
            provider: 'asmodee',
            products: [],
        } as ArticleType
    }
};

export const FantasyFlightGames: Story = {
    args: {
        article: FantasyFlightGamesArticle,
    }
};

export const XboxDynasty: Story = {
    args: {
        article: XboxDynastyArticle
    }
}

export const TSW: Story = {
    args: {
        article: TSWArticle
    }
}

export const RailSim: Story = {
    args: {
        article: RailSimArticle
    }
}

export const Asmodee: Story = {
    args: {
        article: AsmodeeArticle
    }
}

export const BlueBrixx: Story = {
    args: {
        article: BlueBrixxArticle
    }
}


export const FShop: Story = {
    args: {
        article: FShopArticle
    }
}

export const UlissesSpiele: Story = {
    args: {
        article: UlissesSpieleArticle
    }
}

