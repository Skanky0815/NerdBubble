import React, {useEffect} from "react";
import PrivateLayout from "@/pages/_layouts/PrivateLayout";
import Loading from "@/pages/_components/Loading";
import theme from "@/_libs/theme";
import useAuth from "@/_hooks/useAuth";
import { useRouter } from "next/router";

/* eslint-disable react/display-name */
export default function withAuth(WrappedComponent: React.FC) {
    return (props: React.HTMLProps<HTMLDivElement>) => {
        const router = useRouter();
        const { isLoading, user } = useAuth();

        useEffect(() => {
            if (!isLoading && !user) {
                router.push("/")
            }
        }, [isLoading, user]);

        if (isLoading) {
            return <Loading color={theme.palette.primary.main} />;
        }

        return (
            <PrivateLayout>
                <WrappedComponent {...props} />
            </PrivateLayout>
        );
    };
}
