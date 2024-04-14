import {PropsWithChildren} from "react";

export default function Card({children}: PropsWithChildren) {
    return (
        <div className={`bg-white rounded-tr-3xl shadow-md p-8 border-l-8 border-gray-500`}>
            {children}
        </div>
    );
}
