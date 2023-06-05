import React from "react";
import useAlert from "../common/hook/useAlert";
import apiClient from "../service/api";
import {AlertType} from "../common/context/AlertContext";
import {ProductType} from "./ProductType";

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
                className={`rounded bg-gray-100 px-2 py-1 text-grey-800`}
                data-testid="mark-button"
            >
                #
            </button>
        </>
    );
}
