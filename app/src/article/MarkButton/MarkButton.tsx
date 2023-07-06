import React from "react";
import useAlert from "../../common/hook/useAlert";
import apiClient from "../../service/api";
import {AlertType} from "../../common/context/AlertContext";
import {ProductType} from "../ProductType";
import {BookmarkIcon} from "@heroicons/react/24/solid";

type MarkButtonProps = {
    product: ProductType
}

export default function MarkButton({product}: MarkButtonProps) {
    const {setAlert} = useAlert();

    const markButtonHandler = (e: React.MouseEvent<HTMLElement>) => {
        apiClient.post(`/api/products/${product.id}/mark`).then(res => {
            if (204 === res.status) {
                setAlert(`Produkt gemerkt`, AlertType.SUCCESS);
            }
        }).catch(res => {
            setAlert(res.response.data.message || res.messages, AlertType.ERROR);
        })
    }

    return (
        <>
            <button
                onClick={markButtonHandler}
                className={`inline-flex items-center justify-center w-8 h-8 transition-colors duration-150 rounded-full bg-gray-200 px-2 py-1 text-gray-500 hover:text-black`}
                data-testid="mark-button"
            >
                <BookmarkIcon className="h-4 w-4" />
            </button>
        </>
    );
}
