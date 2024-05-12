import {Outlet} from "react-router-dom";
import { QueryClient, QueryClientProvider } from "@tanstack/react-query";
import React from "react";
import Alert from "./components/Alert/Alert";
import {AlertProvider} from "./context/AlertContext";
import {AuthContextProvider} from "../authentication/contexts/AuthContext";
import Footer from "./components/footer/Footer";

const Root = () => {
    const queryClient = new QueryClient({
        defaultOptions: {
            queries: {
                refetchOnMount: false,
                refetchOnWindowFocus: false,
            }
        }
    });

    return (
        <QueryClientProvider client={queryClient}>
            <AlertProvider>
                <AuthContextProvider>
                    <div className="flex flex-col justify-between content-between w-full h-screen">
                        <div className="grow container mx-auto p-5 overflow-y-scroll">
                            <Alert />
                            <Outlet />
                        </div>
                        <Footer />
                    </div>
                </AuthContextProvider>
            </AlertProvider>
        </QueryClientProvider>
    );
}

export default Root;
