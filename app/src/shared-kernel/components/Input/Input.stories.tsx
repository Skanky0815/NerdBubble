import React from "react";
import Input from "./Input";
import {Meta, StoryObj} from "@storybook/react";

const meta = {
    title: 'Components/Forms/Input',
    component: Input,
    tags: ['autodocs'],
} satisfies Meta<typeof Input>;

export default meta;

type Story = StoryObj<typeof meta>

export const Default: Story = {
    args: {
        type: 'text',
        lable: 'Some Field*',
        error: undefined
    },
}

export const WithError: Story = {
    args: {
        type: 'text',
        lable: 'Error Field*',
        error: 'Upps!'
    }
}

export const Checkbox: Story = {
    args: {
        type: 'checkbox',
        lable: 'Is Active',
        error: undefined
    }
}

export const Color: Story = {
    args: {
        type: 'color',
        lable: 'Color',
        error: undefined
    }
}
