import {RouteObject} from "react-router-dom";
import MarkedProducts from "./pages/MarkedProducts";

const MarkedProductsRoutes: RouteObject = {
    path: 'marked-products',
    element: <MarkedProducts />
}

export default MarkedProductsRoutes;
