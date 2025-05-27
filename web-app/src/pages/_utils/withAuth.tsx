import { useRouter } from "next/router";
import React, { useContext, useEffect } from "react";
import { AuthContext } from "@/_contexts/AuthContext";
import PrivateLayout from "@/pages/_layouts/PrivateLayout";
import Loading from "@/pages/_components/Loading";
import theme from "@/_libs/theme";

/* eslint-disable react/display-name */
export default function withAuth(WrappedComponent: React.FC) {
    return (props: React.HTMLProps<HTMLDivElement>) => {
        const router = useRouter();
        const { user, isLoading } = useContext(AuthContext);

        useEffect(() => {
            if (!user && !isLoading) {
                router.push("/login");
            }
        }, [user, isLoading]);

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
