import React from "react";
import Loading from "./Loading";
import {Meta, StoryObj} from "@storybook/react";

const meta = {
    title: 'Loading',
    component: Loading,
    tags: ['autodocs'],
} satisfies Meta<typeof Loading>;

export default meta;

type Story = StoryObj<typeof meta>

export const Green: Story = {
    args: {
        color: 'green',
    },
};

export const Red: Story = {
    args: {
        color: 'red',
    },
};
