import User from "../../authentication/entities/User";
import {createContext, PropsWithChildren, useEffect} from "react";
import {useMutation, useQuery, useQueryClient} from "@tanstack/react-query";
import Users from "../../authentication/repositories/Users";
import {useNavigate} from "react-router-dom";
import apiClient from "../../service/api";
import {AlertType} from "../../common/context/AlertContext";
import LoginData from "../../authentication/value-objects/LoginData";
import useAlert from "../../common/hook/useAlert";

type AuthContextType = {
    user?: User
    signIn: (loginData: LoginData) => void
    signOut: () => void
}

export const AuthContext = createContext<AuthContextType>({
    user: undefined,
    signIn: (loginData: LoginData) => {},
    signOut: () => {},
});

export const AuthContextProvider = ({ children }: PropsWithChildren) => {
    const queryClient = useQueryClient();
    const navigate = useNavigate();
    const {setAlert} = useAlert();

    const { data: user, ...userQuery} = useQuery({
        queryKey: ['me'],
        queryFn: Users.me,
        retry: false,
    });

    useQuery({
        queryKey: ['csrf'],
        queryFn: () => apiClient.get('/csrf-cookie'),
    });

    const loginMutation = useMutation({
        mutationFn: Users.authenticate,
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: ['me'] }).then(() => {
                navigate('/articles');
            });
        },
        onError: (error: any) => {
            setAlert(error.response.data.message || error.message, AlertType.ERROR);
        }
    });

    const logoutMutation = useMutation({
        mutationFn: Users.logout,
        onSuccess: () => {
            queryClient.clear();
            navigate('/login');
        }
    });

    useEffect(() => {
        if (!user) {
            navigate('/login');
        }
    }, [user])

    const signIn = (loginData: LoginData) => {
        loginMutation.mutate(loginData);
    }

    const signOut = () => {
        logoutMutation.mutate();
    }

    const value: AuthContextType = {
        user,
        signIn,
        signOut
    }

    return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}
