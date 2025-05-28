import { Stack, Typography } from "@mui/material";
import withAuth from "@/pages/_utils/withAuth";
import UserCard from "@/pages/settings/_components/UserCard";
import AppCard from "@/pages/settings/_components/AppCard";
import NavigationCard from "@/pages/settings/_components/NavigationCard";

const Settings = () => {
    return (
        <Stack spacing={2}>
            <Typography variant="h4" component="h1">
                Einstellungen
            </Typography>

            <UserCard />

            <NavigationCard />

            <AppCard />
        </Stack>
    );
};

export default withAuth(Settings);
