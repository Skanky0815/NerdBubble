import {RouteObject} from "react-router-dom";
import Login from "./pages/Login";

const AuthenticationRoutes: RouteObject = {
    path: 'login',
    element: <Login />
}

export default AuthenticationRoutes;
