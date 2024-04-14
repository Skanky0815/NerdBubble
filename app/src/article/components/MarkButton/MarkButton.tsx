import React from "react";
import {AlertType} from "../../../common/context/AlertContext";
import {BookmarkIcon} from "@heroicons/react/24/solid";
import {useMutation} from "@tanstack/react-query";
import Product from "article/entities/Product";
import Products from "article/repositories/Products";
import useAlert from "../../../common/hook/useAlert";

type MarkButtonProps = {
    product: Product
}

const MarkButton = ({product}: MarkButtonProps) => {
    const {setAlert} = useAlert();
    const markMutation = useMutation({
        mutationFn: Products.markAsFavourite,
        onSuccess: () => {
            setAlert(`Produkt gemerkt`, AlertType.SUCCESS);
        },
        onError: (error: any) => {
            setAlert(error.response.data.message || error.message, AlertType.ERROR);
        }
    });

    const markButtonHandler = () => {
        markMutation.mutate(product.id);
    }

    return (
        <button
            onClick={markButtonHandler}
            className={`inline-flex items-center justify-center w-8 h-8 transition-colors duration-150 rounded-full bg-gray-200 px-2 py-1 text-gray-500 hover:text-black`}
            data-testid="mark-button"
        >
            <BookmarkIcon className="h-4 w-4" />
        </button>
    );
}

export default MarkButton;
