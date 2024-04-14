import {RouteObject} from "react-router-dom";
import ArticleList from "./pages/ArticleList";

const ArticleRoutes: RouteObject = {
    path: '/articles',
    element: <ArticleList />,
}

export default ArticleRoutes;
