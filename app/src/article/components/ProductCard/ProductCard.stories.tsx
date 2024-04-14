import React from "react";
import ProductCard from "./ProductCard";
import {Meta, StoryObj} from "@storybook/react";
import Product from "article/entities/Product";

const meta = {
    title: 'Article/Components/ProductCard',
    component: ProductCard,
    tags: ['autodocs'],
} satisfies Meta<typeof ProductCard>;

export default meta;

type Story = StoryObj<typeof meta>

export const Default: Story = {
    args: {
        product: {
            id: '39f34551-2f8b-428a-ba2c-8fd94445757d',
            name: 'Nice Game',
            link: 'https://www.google.de',
            image: 'https://picsum.photos/200',
        } as Product
    }
}
