import React from "react";
import {BrowserRouter, Route, Routes} from "react-router-dom";
import ArticleList from "./article/ArticleList";
import BottomNavigation from "./components/BottomNavigation";
import LoginForm from "./login/LoginForm";
import useLoggedIn from "./common/hook/useLoggedIn";
import Setting from "./setting/Setting";
import Alert from "./components/Alert";
import MarkedProducts from "./markedProducts/MarkedProducts";

export default function App() {
    const {loggedIn, login, logout} = useLoggedIn();

    if (!loggedIn) {
        return (
            <>
                <div className="container mx-auto p-5">
                    <Alert />
                    <LoginForm login={login} />
                </div>
            </>
        );
    }

    return(
        <BrowserRouter>
            <div className="container mx-auto p-5">
                <Alert />
                <Routes>
                    <Route path="/" element={<ArticleList />} />
                    <Route path="/marked-products" element={<MarkedProducts />} />
                    <Route path="/settings" element={<Setting logout={logout} />} />
                </Routes>
            </div>
            <BottomNavigation />
        </BrowserRouter>
    );
}
