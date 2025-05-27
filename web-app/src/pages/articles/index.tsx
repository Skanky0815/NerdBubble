import {
    Card,
    CardContent,
    IconButton,
    Skeleton,
    Stack,
    Typography,
} from "@mui/material";
import client from "@/_libs/client";
import { ArticleResource } from "@/_libs/client/shema";
import withAuth from "@/pages/_utils/withAuth";
import { Replay as ReplayIcon } from "@mui/icons-material";
import ScrollTopButton from "@/pages/_components/ScrollTopButton";
import Article from "@/pages/articles/_components/Article";
import ArticleImgRight from "@/pages/articles/_components/ArticleImgRight";

const Articles = () => {
    const {
        data: articles,
        refetch,
        isLoading,
        isRefetching,
    } = client.useQuery("get", "/articles");

    return (
        <>
            <Stack
                direction="row"
                alignContent={"baseline"}
                justifyContent={"space-between"}
            >
                <Typography variant="h4" component="h1">
                    News
                </Typography>

                <IconButton onClick={() => refetch()} loading={isRefetching}>
                    <ReplayIcon />
                </IconButton>
            </Stack>

            <Stack direction="column" spacing={2} sx={{ mt: 2 }}>
                {isLoading && (
                    <Card>
                        <Skeleton
                            variant="rectangular"
                            width={"100%"}
                            height={200}
                        />

                        <CardContent>
                            <Typography variant="h5">
                                <Skeleton />
                            </Typography>

                            <Typography variant="subtitle1">
                                <Skeleton width="60%" />
                            </Typography>
                        </CardContent>
                    </Card>
                )}

                {articles?.data.map((article: ArticleResource) => (
                    <div key={article.id}>
                        {article.provider === "xbox_dynasty" && (
                            <ArticleImgRight article={article} />
                        )}
                        {article.provider !== "xbox_dynasty" && (
                            <Article article={article} />
                        )}
                    </div>
                ))}
            </Stack>

            <ScrollTopButton />
        </>
    );
};

export default withAuth(Articles);
