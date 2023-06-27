import React from "react";
import PageTitle from "./PageTitle";
import {Meta, StoryObj} from "@storybook/react";

const meta = {
    title: 'Page Title',
    component: PageTitle,
    tags: ['autodocs'],
} satisfies Meta<typeof PageTitle>;

export default meta;

type Story = StoryObj<typeof meta>;

export const OnlyTitle: Story = {
    args: {
        text: 'Page Title',
    },
}
export const WithChild: Story = {
    args: {
        text: 'Page Title',
        children: <b>Child Text</b>,
    },
};
