import React, {ComponentProps, PropsWithChildren} from "react";
import classNames from "classnames";

type ButtonProps = ComponentProps<'button'> & {
    btnType: 'primary'|'default'
}

export default function Button({btnType, children, ...props}: PropsWithChildren<ButtonProps>) {
    const classes = classNames(
        'justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 transform transition-all duration-300',
         {
            'text-white bg-blue-500 hover:bg-blue-600 focus:ring-blue-500': 'primary' === btnType,
            'text-gray-700 bg-gray-100 hover:bg-gray-200 focus:ring-gray-500': 'default' === btnType,
        }
    );

    return(
        <button className={classes} {...props}>
            {children}
        </button>
    );
}
