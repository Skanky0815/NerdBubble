import withAuth from "@/pages/_utils/withAuth";
import {
    Card,
    CardActionArea,
    CardHeader,
    CardMedia,
    IconButton,
    Stack,
    Typography,
} from "@mui/material";
import client from "@/_libs/client";
import { Add as AddIcon, Link as LinkIcon } from "@mui/icons-material";
import { ProviderResource } from "@/_libs/client/shema";
import Link from "next/link";

const Provides = () => {
    const { data: providers } = client.useQuery("get", "/providers");

    return (
        <>
            <Typography variant="h4" component="h1">
                Anbieter
            </Typography>

            <Stack direction="column" sx={{ mt: 2, gap: 2, flexWrap: "wrap" }}>
                <Card>
                    <CardActionArea
                        href="/settings/providers/create"
                        component={Link}
                    >
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

                {providers?.data.map((provider: ProviderResource) => (
                    <Card key={provider.id}>
                        <CardActionArea
                            href={`/settings/providers/${provider.id}`}
                            component={Link}
                        >
                            <CardMedia
                                component="img"
                                image={provider.logoImage}
                                alt={provider.name}
                                sx={{
                                    height: 140,
                                    objectFit: "cover",
                                }}
                            />
                        </CardActionArea>
                        <CardHeader
                            title={provider.name}
                            action={
                                <IconButton href={provider.aggregateUrl}>
                                    <LinkIcon />
                                </IconButton>
                            }
                        />
                    </Card>
                ))}
            </Stack>
        </>
    );
};

export default withAuth(Provides);
