import {
    Card,
    CardContent,
    CardHeader,
    IconButton,
    Stack,
    Typography,
} from "@mui/material";
import withAuth from "@/pages/_utils/withAuth";
import { ExitToApp as ExitToAppIcon } from "@mui/icons-material";
import useAuth from "@/_hooks/useAuth";

const Settings = () => {
    const { user, signOut } = useAuth();

    return (
        <>
            <Stack
                direction="row"
                alignContent={"baseline"}
                justifyContent={"space-between"}
            >
                <Typography variant="h4" component="h1">
                    Einstellungen
                </Typography>

                <IconButton onClick={() => signOut()}>
                    <ExitToAppIcon />
                </IconButton>
            </Stack>

            <Card sx={{ mt: 2 }}>
                <CardHeader title="Profil" />
                <CardContent>
                    <Typography variant="body1">
                        {user?.name} <br />
                        {user?.email}
                    </Typography>
                </CardContent>
            </Card>

            <Card sx={{ mt: 2 }}>
                <CardHeader
                    title="NerdBubble"
                    subheader={`Version: ${process.env.NEXT_PUBLIC_VERSION}`}
                />
            </Card>
        </>
    );
};

export default withAuth(Settings);
