import { useContext } from "react";
import { AuthContext } from "@/pages/_hooks/AuthContext";
import { Card, CardActionArea, CardContent, CardMedia, Stack, Typography } from "@mui/material";
import client from "@/_libs/client";
import {components} from "@/_libs/client/shema";

export default function Articles() {
    const { user } = useContext(AuthContext);

    const {data: articles} = client.useQuery("get", "/articles")

    return (
        <>
            <Typography variant="h1" component="h1">
                Hallo {user?.name}
            </Typography>

            <Stack direction="column" spacing={2}>
                {articles?.data.map((article: components["schemas"]["Article"]) => (
                    <Card key={article.id}>
                        <CardActionArea href={article.link}>
                            <CardMedia
                                component="img"
                                image={article.image}
                                alt={article.title}
                            />
                            <CardContent>
                                <Typography variant="h5">{article.title}</Typography>
                                <Typography variant="subtitle1">{article.subTitle}</Typography>
                                {article.description && <Typography variant="body1">{article.description}</Typography>}
                            </CardContent>
                        </CardActionArea>
                    </Card>
                ))}
            </Stack>
        </>
    );
}
