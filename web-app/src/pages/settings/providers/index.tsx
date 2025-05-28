import withAuth from "@/pages/_utils/withAuth";
import {
    Card,
    CardActionArea,
    CardHeader,
    CardMedia,
    Stack,
    Typography,
} from "@mui/material";
import client from "@/_libs/client";
import { Add as AddIcon } from "@mui/icons-material";

const Provides = () => {
    const { data: providers } = client.useQuery("get", "/providers");

    return (
        <>
            <Typography variant="h4" component="h1">
                Anbieter
            </Typography>

            <Stack direction="row" sx={{ mt: 2, gap: 2, flexWrap: "wrap" }}>
                <Card>
                    <CardActionArea href="/settings/providers/create">
                        <CardMedia
                            sx={{
                                backgroundColor: "primary.main",
                                height: 140,
                                display: "flex",
                                alignItems: "center",
                                justifyContent: "center",
                            }}
                        >
                            <AddIcon sx={{ fontSize: 48, color: "grey.100" }} />
                        </CardMedia>
                        <CardHeader title="Anlegen" />
                    </CardActionArea>
                </Card>

                {providers?.data.map((provider) => (
                    <Card key={provider.id}>
                        <CardActionArea
                            href={`/settings/providers/${provider.id}`}
                        >
                            <CardMedia
                                component="img"
                                image={provider.logoImage}
                                alt={provider.name}
                            />
                            <CardHeader title={provider.name} />
                        </CardActionArea>
                    </Card>
                ))}
            </Stack>
        </>
    );
};

export default withAuth(Provides);
