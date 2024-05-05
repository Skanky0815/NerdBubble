import {RouteObject} from "react-router-dom";
import Root from "./Root";
import AuthenticationRoutes from "../authentication/routing";
import ArticleRoutes from "../article/routing";
import SettingRoutes from "../setting/routing";
import Error from "./pages/Error";
import Imprint from "./pages/Imprint";
import MarkedProductsRoutes from "../markedProducts/routing";

const AppRoutes: RouteObject[] = [
    {
        path: '',
        element: <Root />,
        children: [
            AuthenticationRoutes,
            ArticleRoutes,
            MarkedProductsRoutes,
            SettingRoutes,
            {
                path: '/imprint',
                element: <Imprint />
            }
        ],
        errorElement: <Error />
    }
];

export default AppRoutes;
