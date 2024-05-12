import React from "react";
import useAlert from "../../hook/useAlert";
import {AlertType} from "../../context/AlertContext";
import classNames from "classnames";

const Alert = () => {
    const {text, type} = useAlert();

    if (text && type) {
        const classes = classNames(
            'fixed top-4 left-0 right-0 z-50 mx-auto w-96 border px-4 py-3 rounded',
            {
                'bg-red-100 border-red-400 text-red-700': AlertType.ERROR === type,
                'bg-orange-100 border-orange-400 text-orange-700': AlertType.WARNING === type,
                'bg-green-100 border-green-400 text-green-700': AlertType.SUCCESS === type,
                'bg-blue-100 border-blue-400 text-blue-700': AlertType.INFO === type,
            }
        );

        return(
            <div data-testid="alert" className={classes}>
                <span className="block sm:inline">{text}</span>
            </div>
        );
    }

    return (<></>);
}

export default Alert;
