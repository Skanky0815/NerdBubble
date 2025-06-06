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
import { Add as AddIcon, ArrowBack as ArrowBackIcon, Link as LinkIcon } from "@mui/icons-material";
import { ProviderResource } from "@/_libs/client/shema";
import Link from "next/link";

const Provides = () => {
    const { data: providers } = client.useQuery("get", "/providers");

    return (
        <>
            <Stack
                direction="row"
                alignContent={"baseline"}
                justifyContent={"space-between"}
            >
                <Typography variant="h4" component="h1">
                    Anbieter
                </Typography>
                <IconButton href="/settings" component={Link}>
                    <ArrowBackIcon />
                </IconButton>
            </Stack>

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
                            sx={{ bgcolor: "lightgrey", p: 1 }}
                        >
                            <CardMedia
                                component="img"
                                image={provider.logoImage}
                                alt={provider.name}
                                sx={{
                                    height: 140,
                                    objectFit: "contain",
                                }}
                            />
                        </CardActionArea>
                        <CardHeader
                            title={provider.name}
                            action={
                                <IconButton href={provider.aggregateUrl} sx={{ backgroundColor: provider.color}}>
                                    <LinkIcon sx={{ color: 'white' }} />
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
