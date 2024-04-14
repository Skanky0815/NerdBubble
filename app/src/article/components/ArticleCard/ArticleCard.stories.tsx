import React from "react";
import ArticleCard from "./ArticleCard";
import {Meta, StoryObj} from "@storybook/react";
import {
    AsmodeeArticle, BlueBrixxArticle,
    FantasyFlightGamesArticle, FShopArticle,
    RailSimArticle,
    TSWArticle, UlissesSpieleArticle,
    XboxDynastyArticle
} from "../../../mock/data";
import Article from "article/entities/Article";

const meta = {
    title: 'Article/Components/ArticleCard',
    component: ArticleCard,
    tags: ['autodocs'],
} satisfies Meta<typeof ArticleCard>;

export default meta;

type Story = StoryObj<typeof meta>;

export const Basic: Story = {
    args: {
        article: {
            id: '91626c93-1c26-4358-8452-6628a7dce7fb',
            title: 'Nice ArticleCard Title',
            image: 'https://picsum.photos/200',
            link: 'https://ww.google.de',
            date: '2023-01-01',
            provider: 'asmodee',
            products: [],
        } as Article
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

