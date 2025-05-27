import { createContext, PropsWithChildren } from "react";
import { useQueryClient } from "@tanstack/react-query";
import client from "@/_libs/client";
import { useRouter } from "next/router";
import { UserResource } from "@/_libs/client/shema";
import { useSnackbar } from "notistack";

export type LoginData = {
    email: string;
    password: string;
};

type AuthContextType = {
    user?: UserResource;
    signIn: (loginData: LoginData) => void;
    isLoading: boolean;
    isError: boolean;
    signOut: () => void;
};

export const AuthContext = createContext<AuthContextType>({
    user: undefined,
    isLoading: false,
    isError: false,
    signIn: () => {},
    signOut: () => {},
});

export const AuthContextProvider = ({ children }: PropsWithChildren) => {
    const { enqueueSnackbar } = useSnackbar();
    const queryClient = useQueryClient();
    const router = useRouter();

    const { data: user, isPending } = client.useQuery("get", "/me", {
        queryKey: ["me"],
    }, {
        retry: false
    });
    client.useQuery("get", "/csrf-cookie", { queryKey: ["csrf"] });

    const loginMutation = client.useMutation("post", "/login", {
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: ["me"] }).then(() => {
                router.push("/articles");
            });
        },
        onError: (error: {
            readonly message: string;
            readonly errors: { readonly [key: string]: readonly string[] };
        }) => {
            console.error(error.message);
            enqueueSnackbar(error.message, { variant: "error" });
        },
    });

    const logoutMutation = client.useMutation("post", "/logout", {
        onSuccess: () => {
            queryClient.clear();
            router.push("/");
            console.debug("Logout successfull");
        },
    });

    const signIn = (loginData: LoginData) => {
        loginMutation.mutate({ body: loginData });
    };

    const signOut = () => {
        logoutMutation.mutate({});
    };

    const value: AuthContextType = {
        user: user?.data,
        isLoading: loginMutation.isPending || isPending,
        isError: loginMutation.isError,
        signIn,
        signOut,
    };

    return (
        <AuthContext.Provider value={value}>{children}</AuthContext.Provider>
    );
};
