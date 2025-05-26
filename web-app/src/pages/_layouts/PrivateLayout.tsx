import { PropsWithChildren } from "react";
import {
    BottomNavigation,
    BottomNavigationAction,
    Box,
    Paper,
} from "@mui/material";
import {
    Feed as FeedIcon,
    Settings as SettingsIcon,
} from "@mui/icons-material";
import { useRouter } from "next/router";
import { usePathname } from "next/navigation";

export default function PrivateLayout({ children }: PropsWithChildren) {
    const router = useRouter();
    const pathname = usePathname();

    const handleChange = (event: React.SyntheticEvent, newValue: string) => {
        router.push(newValue);
    };

    return (
        <Box
            sx={{
                px: 2,
                pb: 8,
                minHeight: "100vh",
                backgroundColor: "grey.100",
            }}
        >
            {children}

            <Paper
                sx={{ position: "fixed", bottom: 0, left: 0, right: 0 }}
                elevation={3}
            >
                <BottomNavigation value={pathname} onChange={handleChange}>
                    <BottomNavigationAction
                        label="News"
                        value="/articles"
                        icon={<FeedIcon />}
                    />
                    <BottomNavigationAction
                        label="Settings"
                        value="/settings"
                        icon={<SettingsIcon />}
                    />
                </BottomNavigation>
            </Paper>
        </Box>
    );
}
