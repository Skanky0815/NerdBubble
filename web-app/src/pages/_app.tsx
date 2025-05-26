import type { AppProps } from "next/app";
import { QueryClient } from "@tanstack/query-core";
import { QueryClientProvider } from "@tanstack/react-query";
import theme from "@/_libs/theme";
import { CssBaseline, ThemeProvider } from "@mui/material";
import Head from "next/head";
import { AuthContextProvider } from "@/pages/_contexts/AuthContext";
import { SnackbarProvider } from "notistack";

export default function App({ Component, pageProps }: AppProps) {
    const client = new QueryClient();

    return (
        <>
            <Head>
                <meta
                    name="viewport"
                    content="initial-scale=1.0, width=device-width"
                />
            </Head>
            <QueryClientProvider client={client}>
                <ThemeProvider theme={theme}>
                    <CssBaseline />
                    <AuthContextProvider>
                        <SnackbarProvider maxSnack={3}>
                            <Component {...pageProps} />
                        </SnackbarProvider>
                    </AuthContextProvider>
                </ThemeProvider>
            </QueryClientProvider>
        </>
    );
}
