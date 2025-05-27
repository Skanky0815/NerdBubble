import {
    Card,
    CardContent,
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
                <Typography variant="h5" component="h1">
                    Einstellungen
                </Typography>

                <IconButton onClick={() => signOut()}>
                    <ExitToAppIcon />
                </IconButton>
            </Stack>

            <Card>
                <CardContent>
                    <Typography variant="h5" component="h2">
                        Profil
                    </Typography>

                    <Typography variant="body1">
                        {user?.name} <br />
                        {user?.email}
                    </Typography>
                </CardContent>
            </Card>
        </>
    );
};

export default withAuth(Settings);
