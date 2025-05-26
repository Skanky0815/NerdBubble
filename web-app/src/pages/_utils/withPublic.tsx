import PublicLayout from "@/pages/_layouts/PublicLayout";

export default function withPublic(WrappedComponent: any) {
    return (props: any) => {
        return (
            <PublicLayout>
                <WrappedComponent {...props} />
            </PublicLayout>
        );
    };
}
