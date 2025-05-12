import { useContext } from "react";
import { AuthContext } from "@/pages/_hooks/AuthContext";
import { Typography } from "@mui/material";

export default function Articles() {
    const { user } = useContext(AuthContext);

    return (
        <Typography variant="h1" component="h1">
            Hallo {user?.name}
        </Typography>
    );
}
