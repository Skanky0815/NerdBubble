import React from "react";
import useAlert from "../common/hook/useAlert";
import {AlertType} from "../common/context/AlertContext";

export default function Alert() {
    const {text, type} = useAlert();

    if (text && type) {
        let typeColor = '';
        switch (type) {
            case AlertType.ERROR:
                typeColor = 'bg-red-100 border-red-400 text-red-700';
                break;
            case AlertType.WARNING:
                typeColor = 'bg-orange-100 border-orange-400 text-orange-700';
                break;
            case AlertType.SUCCESS:
                typeColor = 'bg-green-100 border-green-400 text-green-700';
                break;
            case AlertType.INFO:
                typeColor = 'bg-blue-100 border-blue-400 text-blue-700';
                break;
        }

        return(
            <>
                <div className={`fixed top-4 left-0 right-0 z-50 mx-auto w-96 ${typeColor} border px-4 py-3 rounded`}>
                    <span className="block sm:inline">{text}</span>
                </div>
            </>
        );
    }

    return (<></>);
}
