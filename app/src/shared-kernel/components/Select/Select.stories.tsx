import React from "react";
import Select from "./Select";
import {Meta, StoryObj} from "@storybook/react";

const meta = {
    title: 'Components/Forms/Select',
    component: Select,
    tags: ['autodocs'],
} satisfies Meta<typeof Select>;

export default meta;

type Story = StoryObj<typeof meta>


export const Default: Story = {
    args: {
        lable:'Select Field',
        options: [
            {value: 'foo', lable: 'Foo'},
            {value: 'bar', lable: 'Bar'},
        ],
        error: undefined,
    },
}

export const WithError: Story = {
    args: {
        ...Default.args,
        lable: 'Error Select*',
        error: 'Upps!'
    }
}
