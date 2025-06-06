import { ArticleResource } from "@/_libs/client/shema";
import useImagePreload from "@/_hooks/useImagePreload";
import {
    Box,
    Card,
    CardActionArea,
    CardContent,
    CardMedia,
    Skeleton,
    Typography,
} from "@mui/material";

type Props = {
    article: ArticleResource;
};

export default function ArticleImgRight({ article }: Props) {
    const { loaded: imageLoaded } = useImagePreload(article?.image);

    return (
        <Card sx={{ borderLeft: "solid 8px lime" }}>
            <CardActionArea href={article?.link}>
                <Box sx={{ display: "flex" }}>
                    <CardContent>
                        <Typography variant="h5">{article?.title}</Typography>
                        <Typography variant="subtitle1">{article?.date}</Typography>
                    </CardContent>

                    {imageLoaded && (
                        <CardMedia
                            component="img"
                            image={article?.image}
                            alt={article?.title}
                            sx={{ maxWidth: 250 }}
                        />
                    )}
                    {!imageLoaded && (
                        <Skeleton
                            variant="rectangular"
                            width={"100%"}
                            height={200}
                        />
                    )}
                </Box>

                <CardContent>
                    <Typography variant="subtitle1">
                        {article?.subTitle}
                    </Typography>
                    {article?.description && (
                        <Typography variant="body1">
                            {article?.description}
                        </Typography>
                    )}
                </CardContent>
            </CardActionArea>
        </Card>
    );
}
