import {
    Card,
    CardContent,
    IconButton,
    Stack,
    Typography,
} from "@mui/material";
import { AuthContext } from "@/pages/_contexts/AuthContext";
import { useContext } from "react";
import withAuth from "@/pages/_utils/withAuth";
import { ExitToApp as ExitToAppIcon } from "@mui/icons-material";

const Settings = () => {
    const { user, signOut } = useContext(AuthContext);

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
