import React, {useEffect, useReducer} from "react";
import PageTitle from "../components/PageTitle/PageTitle";
import Loading from "../components/Loading/Loading";
import useAlert from "../common/hook/useAlert";
import apiClient from "../service/api";
import {AlertType} from "../common/context/AlertContext";
import {ProductType} from "../article/ProductType";
import Product from "../article/Product";

enum ActionType {
    SUCCESS = 'SUCCESS',
    ERROR = 'ERROR',
    LOADING = 'LOADING',
}

const initialState = {
    loading: true,
    data: [],
    error: false
}

const reducer = (state: any, action: any) => {
    switch (action.type) {
        case ActionType.SUCCESS:
            return {
                loading: false,
                data: action.payload,
                error: false
            };
        case ActionType.ERROR:
            return {
                loading: false,
                data: [],
                error: true
            };
        case ActionType.LOADING:
            return {
                loading: true,
                data: [],
                error: false,
            };
        default:
            return state;
    }
}

export default function MarkedProducts() {
    const [state, dispatch] = useReducer(reducer, initialState);
    const {setAlert} = useAlert();

    useEffect(() => {
        dispatch({type: ActionType.LOADING})
        apiClient.get('api/marked-products').then(res => {
            if (200 === res.status) {
                dispatch({payload: res.data.data, type: ActionType.SUCCESS});
            }
        }).catch(res => {
            dispatch({type: ActionType.ERROR});
            setAlert(res.response.data.message || res.message, AlertType.ERROR);
        });
    }, [dispatch, setAlert]);

    const productList = state.data.map((product: ProductType) => <Product key={product.id} product={product} />);

    return (
        <>
            <PageTitle text={`Marked Products`} />

            {state.loading
                ? <Loading color={`green`} />
                : <div className="gap-4 columns-1 md:columns-2">{productList}</div>}
        </>
    );
}
