import React, {PropsWithChildren} from "react";

export default function Card({children}: PropsWithChildren) {
    return (
        <div className={`bg-white rounded-tr-3xl shadow-md p-8 border-l-8 border-gray-500`}>
            {children}
        </div>
    );
}

const CardTitle = ({children}: PropsWithChildren) => {
    return <h2 className={`text-gray-500 font-bold mb-3`}>{children}</h2>
}

export {CardTitle};
