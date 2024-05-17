import React, {ComponentProps} from "react";
import classNames from "classnames";

type Option = {
    value: string
    lable: string
}

type SelectProps = ComponentProps<'select'> & {
    lable: string
    options: Option[]
    error: string|undefined
}

const Select = ({lable, options, error, ...props}: SelectProps) => {
    const lableClasses = classNames('block mb-2 text-sm font-medium text-gray-900 transition-all', {
        'text-red-500': error,
    });

    const selectClasses = classNames('fw-full px-4 py-2 pe-9 block border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all', {
        'border-red-500': error,
    });

    return (
        <div className='mb-4'>
            <label htmlFor={props.name} className={lableClasses}>
                {lable}
            </label>
            <select
                id={props.name}
                className={selectClasses}
                {...props}
            >
                {options.map(option => (
                    <option key={option.value} value={option.value}>{option.lable}</option>
                ))}
            </select>
            {error && <span className="text-red-500 text-xs">{error}</span>}
        </div>
)
    ;
}

export default Select;
