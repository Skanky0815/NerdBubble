import type { AppProps } from "next/app";
import { QueryClient } from "@tanstack/query-core";
import { QueryClientProvider } from "@tanstack/react-query";
import theme from "@/theme";
import { CssBaseline, ThemeProvider } from "@mui/material";
import Head from "next/head";

export default function App({ Component, pageProps }: AppProps) {
    const client = new QueryClient();

    return (
        <>
            <Head>
                <meta name="viewport" content="initial-scale=1, width=device-width" />
            </Head>
            <QueryClientProvider client={client}>
                <ThemeProvider theme={theme}>
                    <CssBaseline />
                    <Component {...pageProps} />
                </ThemeProvider>
            </QueryClientProvider>
        </>
    );
}
