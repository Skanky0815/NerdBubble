import React, {PropsWithChildren} from "react";

type ButtonProps = {
    type: 'primary'|'default'
    onClick: () => void
}

export default function Button({onClick, type, children}: PropsWithChildren<ButtonProps>) {
    let btnClasses = 'justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 transform transition-all duration-300 ';

    switch (type) {
        case "primary":
            btnClasses += 'text-white bg-blue-500 hover:bg-blue-600 focus:ring-blue-500';
            break;
        default:
            btnClasses += 'text-gray-700 bg-gray-100 hover:bg-gray-200 focus:ring-gray-500 ';
            break;
    }

    return(
        <button
            className={btnClasses}
            onClick={onClick}
        >
            {children}
        </button>
    );
}
