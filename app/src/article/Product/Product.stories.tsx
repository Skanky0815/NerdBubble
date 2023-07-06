import React from "react";
import Product from "./Product";
import {Meta, StoryObj} from "@storybook/react";
import {ProductType} from "../ProductType";

const meta = {
    title: 'Article/Product',
    component: Product,
    tags: ['autodocs'],
} satisfies Meta<typeof Product>;

export default meta;

type Story = StoryObj<typeof meta>

export const Default: Story = {
    args: {
        product: {
            id: '39f34551-2f8b-428a-ba2c-8fd94445757d',
            name: 'Nice Game',
            link: 'https://www.google.de',
            image: 'https://picsum.photos/200',
        } as ProductType
    }
}
