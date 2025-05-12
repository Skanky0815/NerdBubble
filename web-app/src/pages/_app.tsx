import type { AppProps } from "next/app";
import { QueryClient } from "@tanstack/query-core";
import { QueryClientProvider } from "@tanstack/react-query";
import theme from "@/theme";
import { Box, CssBaseline, Stack, ThemeProvider } from "@mui/material";
import Head from "next/head";
import Footer from "@/pages/_components/Footer";
import { AuthContextProvider } from "./_hooks/AuthContext";

export default function App({ Component, pageProps }: AppProps) {
    const client = new QueryClient();

    return (
        <>
            <Head>
                <meta
                    name="viewport"
                    content="initial-scale=1, width=device-width"
                />
            </Head>
            <QueryClientProvider client={client}>
                <ThemeProvider theme={theme}>
                    <CssBaseline />
                    <AuthContextProvider>
                        <Stack
                            direction="column"
                            sx={{
                                minHeight: "100vh",
                                justifyContent: "space-between",
                                backgroundColor: "grey.100",
                            }}
                        >
                            <Box sx={{ mx: 2, my: 4 }}>
                                <Component {...pageProps} />
                            </Box>
                            <Footer />
                        </Stack>
                    </AuthContextProvider>
                </ThemeProvider>
            </QueryClientProvider>
        </>
    );
}
