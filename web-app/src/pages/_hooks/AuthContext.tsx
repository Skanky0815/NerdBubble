import { createContext, PropsWithChildren, useEffect } from "react";
import { useQueryClient } from "@tanstack/react-query";
import client from "@/_libs/client";
import { useRouter } from "next/router";
import { components } from "@/_libs/client/shema";

export type LoginData = {
    email: string;
    password: string;
};

type AuthContextType = {
    user?: components["schemas"]["User"];
    signIn: (loginData: LoginData) => void;
    signOut: () => void;
};

export const AuthContext = createContext<AuthContextType>({
    user: undefined,
    signIn: (loginData: LoginData) => {},
    signOut: () => {},
});

export const AuthContextProvider = ({ children }: PropsWithChildren) => {
    const queryClient = useQueryClient();
    const router = useRouter();

    const { data: user } = client.useQuery("get", "/me", {
        queryKey: ["me"],
        retry: false,
    });

    client.useQuery("get", "/csrf-cookie", { queryKey: ["csrf"] });

    const loginMutation = client.useMutation("post", "/login", {
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: ["me"] }).then(() => {
                router.push("/sec/articles");
            });
        },
        onError: (error: any) => {
            console.error(error);
            // setAlert(error.response.data.message || error.message, AlertType.ERROR);
        },
    });

    const logoutMutation = client.useMutation("post", "/logout", {
        onSuccess: () => {
            queryClient.clear();
            router.push("/login");
        },
    });

    useEffect(() => {
        if (!user?.data) {
            router.push("/login");
        }
    }, [user]);

    const signIn = (loginData: LoginData) => {
        loginMutation.mutate({ body: loginData });
    };

    const signOut = () => {
        logoutMutation.mutate();
    };

    const value: AuthContextType = {
        user: user?.data,
        signIn,
        signOut,
    };

    return (
        <AuthContext.Provider value={value}>{children}</AuthContext.Provider>
    );
};
