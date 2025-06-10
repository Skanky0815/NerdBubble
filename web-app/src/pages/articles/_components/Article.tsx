import {
    Card,
    CardActionArea,
    CardContent,
    CardHeader,
    CardMedia,
    Skeleton,
    Typography,
} from "@mui/material";
import { ArticleResource } from "@/_libs/client/shema";
import useImagePreload from "@/_hooks/useImagePreload";

type Props = {
    article: ArticleResource;
};

export default function Article({ article }: Props) {
    const { loaded: imageLoaded } = useImagePreload(article?.image);

    return (
        <Card sx={{ borderLeft: `solid 8px ${article?.color}` }}>
            <CardActionArea href={article?.link}>
                {imageLoaded && (
                    <CardMedia
                        component="img"
                        image={article?.image}
                        alt={article?.title}
                        sx={{ maxHeight: 300 }}
                    />
                )}
                {!imageLoaded && (
                    <Skeleton
                        variant="rectangular"
                        width={"100%"}
                        sx={{ minHeight: 160, width: 1 }}
                    />
                )}
                <CardHeader title={article?.title} subheader={article?.date} />
                {article?.subTitle ||
                    (article?.description && (
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
                    ))}
            </CardActionArea>
        </Card>
    );
}
