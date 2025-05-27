import PublicLayout from "@/pages/_layouts/PublicLayout";
import React from "react";

/* eslint-disable react/display-name */
export default function withPublic(WrappedComponent: React.FC) {
    return (props: React.HTMLProps<HTMLDivElement>) => {
        return (
            <PublicLayout>
                <WrappedComponent {...props} />
            </PublicLayout>
        );
    };
}
