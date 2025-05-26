"use client";

import { createTheme } from "@mui/material/styles";
import { Montserrat } from "next/font/google";

const montserrat = Montserrat({
    weight: ["300", "400", "500", "700"],
    subsets: ["latin"],
    display: "swap",
    variable: "--font-montserrat",
});

const theme = createTheme({
    colorSchemes: { light: true, dark: false },
    cssVariables: true,
    typography: {
        fontFamily: montserrat.style.fontFamily,
    },
    palette: {
        mode: "light",
        primary: {
            light: "#337c80",
            main: "#005C61",
            dark: "#004043",
            contrastText: "#fff",
        },
        secondary: {
            light: "#fce286",
            main: "#FCDB68",
            dark: "#b09948",
            contrastText: "#000",
        },
        error: {
            main: "#ba1a1a",
        },
    },
});

export default theme;
