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
import { blue, deepPurple, orange, green, red } from "@mui/material/colors";

type Props = {
    article: ArticleResource;
};

const map: { [key: string]: string } = {
    asmodee: deepPurple[700],
    tsw: orange[500],
    rail_sim: red[900],
    f_shop: green[600],
    blue_brixx: blue[500],
    fantasy_flight_games: blue[600],
    ulisses_spiele: green[600],
};

export default function Article({ article }: Props) {
    const { loaded: imageLoaded } = useImagePreload(article?.image);

    return (
        <Card sx={{ borderLeft: `solid 8px ${map[article?.provider]}` }}>
            <CardActionArea href={article?.link}>
                {imageLoaded && (
                    <CardMedia
                        component="img"
                        image={article?.image}
                        alt={article?.title}
                    />
                )}
                {!imageLoaded && (
                    <Skeleton
                        variant="rectangular"
                        width={"100%"}
                        height={160}
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
