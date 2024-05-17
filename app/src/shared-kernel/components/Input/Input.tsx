import React, {ComponentProps, ComponentPropsWithRef} from "react";
import classNames from "classnames";

type InputProps = ComponentProps<'input'> & {
    lable: string
    error: string|undefined
}

const Input = ({lable, error, ...props}: InputProps) => {
    const wrapperClasses = classNames('mb-4', {
        'flex flex-row-reverse justify-end items-center gap-4': 'checkbox' === props.type
    });

    const lableClasses = classNames('block text-sm font-medium text-gray-900 transition-all', {
        'text-red-500': error,
        'mb-2': 'checkbox' !== props.type,
        'mb-0': 'checkbox' === props.type
    });
    const inputClasses = classNames('focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all', {
        'border-red-500': error,
        'w-full px-4 py-2 border border-gray-300 rounded-md': 'color' !== props.type && 'checkbox' !== props.type,
        'p-1 h-10 w-16 block border border-gray-300 rounded-md bg-white cursor-pointer': 'color' === props.type,
        'relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-blue-600 disabled:opacity-50 disabled:pointer-events-none checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 before:inline-block before:size-6 before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow before:transform before:ring-0 before:transition before:ease-in-out before:duration-200': 'checkbox' === props.type
    });

    return (
        <div className={wrapperClasses}>
            <label htmlFor={props.name} className={lableClasses}>
                {lable}
            </label>
            <input id={props.name} className={inputClasses}{...props} />
            {error && <span className="text-red-500 text-xs">{error}</span>}
        </div>
    );
}

export default Input;
