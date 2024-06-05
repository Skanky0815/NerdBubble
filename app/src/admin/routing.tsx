import {RouteObject} from "react-router-dom";
import ProviderIndex from "./pages/ProviderIndex";
import ProviderEdit from "./pages/ProviderEdit";

const AdminRoutes: RouteObject = {
    path: '/admin',
    children: [
        {
            path: '/admin/provider',
            element: <ProviderIndex />
        },
        {
            path: '/admin/provider/new',
            element: <ProviderEdit />
        },
        {
            path: '/admin/provider/:id',
            element: <ProviderEdit />
        }
    ]

}

export default AdminRoutes;
