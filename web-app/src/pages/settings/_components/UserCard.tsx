import {
    Card,
    CardContent,
    CardHeader,
    IconButton,
    Typography,
} from "@mui/material";
import useAuth from "@/_hooks/useAuth";
import { ExitToApp as ExitToAppIcon } from "@mui/icons-material";

export default function UserCard() {
    const { user, signOut } = useAuth();

    return (
        <Card>
            <CardHeader
                title="Profil"
                action={
                    <IconButton onClick={() => signOut()}>
                        <ExitToAppIcon />
                    </IconButton>
                }
            />
            <CardContent>
                <Typography variant="body1">
                    {user?.name} <br />
                    {user?.email}
                </Typography>
            </CardContent>
        </Card>
    );
}
