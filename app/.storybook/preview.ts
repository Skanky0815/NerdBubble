import type { Preview } from "@storybook/react";
import '../src/index.css'
import withAxiosDecorator from 'storybook-axios';
import {withThemeByDataAttribute} from "@storybook/addon-styling";
import apiClient from "../src/service/api";
import {initialize, mswDecorator} from "msw-storybook-addon";

initialize();

const preview: Preview = {
  parameters: {
    actions: { argTypesRegex: "^on[A-Z].*" },
    controls: {
      matchers: {
        color: /(background|color)$/i,
        date: /Date$/,
      },
    },
  },
};

export const decorators = [
    mswDecorator,
    withAxiosDecorator(apiClient),
    withThemeByDataAttribute({
        themes: {
            light: 'light',
            dark: 'dark',
        },
        defaultTheme: 'light',
        attributeName: 'data-mode',
    }),
];

export default preview;
