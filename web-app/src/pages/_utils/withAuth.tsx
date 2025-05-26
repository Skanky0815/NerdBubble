import { useRouter } from "next/router";
import { useContext, useEffect } from "react";
import { AuthContext } from "@/pages/_contexts/AuthContext";
import PrivateLayout from "@/pages/_layouts/PrivateLayout";
import Loading from "@/pages/_components/Loading";
import theme from "@/_libs/theme";

export default function withAuth(WrappedComponent: any) {
    return (props: any) => {
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
