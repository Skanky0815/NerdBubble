import React, {ComponentProps, ComponentPropsWithRef} from "react";
import classNames from "classnames";

type InputProps = ComponentProps<'input'> & {
    lable: string
    error: string|undefined
}

const Input = ({lable, error, ...props}: InputProps) => {
    const lableClasses = classNames('block mb-2 text-sm font-medium text-gray-900 transition-all', {
        'text-red-500': error
    });
    const inputClasses = classNames('w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all', {
        'border-red-500': error
    });

    return (
        <div>
            <label htmlFor={props.name} className={lableClasses}>
                {lable}
            </label>
            <input id={props.name} className={inputClasses}{...props} />
            {error && <span className="text-red-500 text-xs">{error}</span>}
        </div>
    );
}

export default Input;
