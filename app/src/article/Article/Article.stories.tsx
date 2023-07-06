import React from "react";
import Article from "./Article";
import {Meta, StoryObj} from "@storybook/react";
import {ArticleType} from "../ArticleType";
import {ProductType} from "../ProductType";

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
        article: {
            id: '91626c93-1c26-4358-8452-6628a7dce7fb',
            title: 'The Hand and the Eye',
            image: 'https://images-cdn.fantasyflightgames.com/filer_public/14/8d/148dcbc1-c3fc-4c76-9008-ff6ebbbc564b/mec112_preview_images_590x250.jpg',
            link: 'https://www.fantasyflightgames.com/en/news/2023/7/6/the-hand-and-the-eye/',
            date: '2023-01-01',
            provider: 'fantasy_flight_games',
            // description: 'Announcing The Two Towers Saga Expansion for The Lord of the Rings: The Card Game',
            products: [],
        } as ArticleType
    }
};

export const XboxDynasty: Story = {
    args: {
        article: {
            id: "9995a618-b1b2-4d8d-9961-d7239e268248",
            title: "Letzte Chance vor der Preiserh\u00f6hung",
            subTitle: "Der Xbox Game Pass wird teurer und heute ist eure letzte Chance vor der Preiserh\u00f6hung auch noch g\u00fcnstig mit Codes einzudecken.",
            link: "https://www.xboxdynasty.de/news/xbox-game-pass/letzte-chance-vor-der-preiserhoehung/",
            image: "https://www.xboxdynasty.de/wp-content/uploads/2017/02/xbox-game-pass-232-150x150.jpg.pagespeed.ce.3xwsD82r7n.jpg",
            date: "2023-07-06",
            provider: "xbox_dynasty",
            description: "",
            products: []
        } as ArticleType
    }
}

export const TSW: Story = {
    args: {
        article: {
            id: "9995a619-acd6-40f8-949e-2dbaae7119bc",
            title: "From Sea To Shining Sea",
            subTitle: "",
            link: "https://live.dovetailgames.com/live/train-sim-world/articles/article/from-sea-to-shining-sea",
            image: "https://media.dovetailgames.com/1688371939206_TSW_US_Article425x166.jpg",
            date: "2023-07-03",
            provider: "tsw",
            description: "Travel coast to coast in the US with an introduction to US railroad adventures in Train Sim World.",
            products: []
        } as ArticleType
    }
}

export const RailSim: Story = {
    args: {
        article: {
            id: '9995a617-4ecd-494d-9c49-299458c23b35',
            title: '[TSW3] Roadmap - Diskussionsthema',
            subTitle: "",
            link: 'https://rail-sim.de/forum/thread/38423-tsw3-roadmap-diskussionsthema/',
            image: 'https://www.rail-sim.de/wp-content/uploads/2016/04/rail-sim_logo.png',
            date: '2023-07-06',
            provider: 'rail_sim',
            description: '',
            products: []
        } as ArticleType,
    }
}

export const Asmodee: Story = {
    args: {
        article: {
            ...Basic.args.article,
            provider: 'asmodee',
            products: [
                {
                    id: '39f34551-2f8b-428a-ba2c-8fd94445757d',
                    name: 'Nice Game',
                    link: 'https://www.google.de',
                    image: 'https://picsum.photos/200',
                } as ProductType,
                {
                    id: 'f748fed1-4e0a-4fa9-9ae4-55ee4a63ac45',
                    name: 'Nice Set',
                    link: 'https://www.amazon.de',
                    image: 'https://picsum.photos/200',
                } as ProductType,
            ]
        } as ArticleType,
    }
}

export const BlueBrixx: Story = {
    args: {
        article: {
            ...Basic.args.article,
            provider: 'blue_brixx',
            products: [
                {
                    id: '39f34551-2f8b-428a-ba2c-8fd94445757d',
                    name: 'Nice Game',
                    link: 'https://www.google.de',
                    image: 'https://picsum.photos/200',
                } as ProductType,
                {
                    id: 'f748fed1-4e0a-4fa9-9ae4-55ee4a63ac45',
                    name: 'Nice Set',
                    link: 'https://www.amazon.de',
                    image: 'https://picsum.photos/200',
                } as ProductType,
            ]
        } as ArticleType,
    }
}


export const FShop: Story = {
    args: {
        article: {
            ...Basic.args.article,
            provider: 'f_shop',
            products: [
                {
                    id: '39f34551-2f8b-428a-ba2c-8fd94445757d',
                    name: 'Nice Game',
                    link: 'https://www.google.de',
                    image: 'https://picsum.photos/200',
                } as ProductType,
                {
                    id: 'f748fed1-4e0a-4fa9-9ae4-55ee4a63ac45',
                    name: 'Nice Set',
                    link: 'https://www.amazon.de',
                    image: 'https://picsum.photos/200',
                } as ProductType,
            ]
        } as ArticleType,
    }
}


