import {
    Box,
    Button,
    Card,
    CardContent,
    Stack,
    TextField,
    Typography,
} from "@mui/material";
import Form from "next/form";
import { FormEvent, useContext } from "react";
import { AuthContext, LoginData } from "@/pages/_contexts/AuthContext";
import D12 from "@/pages/_components/D12";

export default function Login() {
    const { signIn, isLoading } = useContext(AuthContext);

    async function onSubmit(event: FormEvent<HTMLFormElement>) {
        event.preventDefault();

        const formData = new FormData(event.currentTarget);

        const loginData: LoginData = {
            email: formData.get("email") + "",
            password: formData.get("password") + "",
        };

        signIn(loginData);
    }

    return (
        <div className={`w-auto md:w-6/12 mx-auto`}>
            <Typography variant="h1" component="h1">
                NerdBubble
            </Typography>
            <Card>
                <CardContent>
                    <Stack
                        direction={{ md: "row", xs: "column-reverse" }}
                        spacing={2}
                    >
                        <Box sx={{ flexBasis: "60%" }}>
                            <Form action="#" onSubmit={onSubmit}>
                                <Stack
                                    direction="column"
                                    spacing={4}
                                    justifyContent="center"
                                >
                                    <Typography variant="h2" component="h2">
                                        Anmeldung
                                    </Typography>
                                    <TextField
                                        label="E-Mail-Adresse"
                                        type="email"
                                        name="email"
                                        required
                                    />
                                    <TextField
                                        label="Passwort"
                                        type="password"
                                        name="password"
                                        required
                                        autoComplete="off"
                                    />
                                    <Button
                                        variant="contained"
                                        type="submit"
                                        fullWidth
                                        size="large"
                                        loading={isLoading}
                                    >
                                        Anmelden
                                    </Button>
                                </Stack>
                            </Form>
                        </Box>
                        <Box sx={{ flexBasis: "40%" }}>
                            <D12 />
                        </Box>
                    </Stack>
                </CardContent>
            </Card>
        </div>
    );
}
