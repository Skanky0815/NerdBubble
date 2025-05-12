import { Box, Link, Typography } from "@mui/material";

export default function Footer() {
    return (
        <Box
            component="footer"
            sx={{
                borderTop: "2px solid",
                borderColor: "grey.200",
                backgroundColor: "white",
                py: 2,
                px: 4,
            }}
        >
            <Box
                sx={{
                    display: "flex",
                    flexDirection: { xs: "column-reverse", md: "row" },
                    alignItems: "center",
                    justifyContent: "space-between",
                }}
            >
                <Typography variant="body2">
                    &copy; {new Date().getFullYear()}, NerdBubble.de by Rico
                    Schulz
                </Typography>
                <Link href="/imprint" variant="body2">
                    Impressum
                </Link>
            </Box>
        </Box>
    );
}
