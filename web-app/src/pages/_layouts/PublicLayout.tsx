import { PropsWithChildren } from "react";
import { Box, Stack } from "@mui/material";
import Footer from "@/pages/_components/Footer";

export default function PublicLayout({ children }: PropsWithChildren) {
    return (
        <Stack
            direction="column"
            sx={{
                minHeight: "100vh",
                justifyContent: "space-between",
                backgroundColor: "grey.100",
            }}
        >
            <Box sx={{ mx: 2, my: 4 }}>{children}</Box>
            <Footer />
        </Stack>
    );
}
