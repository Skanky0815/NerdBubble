import React, { PropsWithChildren } from "react";

type PageTitleProps = {
    text: string
}

export default function PageTitle({text, children}: PropsWithChildren<PageTitleProps>) {
    return (
        <>
            <div className="flex justify-between items-center mt-2 mb-5">
                <h1 className="text-xl text-gray-500 font-bold">{text}</h1>
                {children}
            </div>
        </>
    );
}
