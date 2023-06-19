import React, {useReducer} from "react";
import {AlertType} from "../context/AlertContext";
import apiClient from "../../service/api";
import useAlert from "./useAlert";

export enum ActionType {
    SUCCESS = 'SUCCESS',
    ERROR = 'ERROR',
    LOADING = 'LOADING',
}


const useApiLoad = () => {

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

    const [state, dispatch] = useReducer(reducer, initialState);
    const {setAlert} = useAlert();
    const {loading, data} = state;

    const fetchData = (url: string) => {
        dispatch({type: ActionType.LOADING})
        apiClient.get(url)
            .then(res => dispatch({type: ActionType.SUCCESS, payload: res.data.data}))
            .catch(res => {
                dispatch({type: ActionType.ERROR})
                setAlert(res.response.data.message || res.message, AlertType.ERROR);
            });
    }

    return {
        loading,
        data,
        fetchData,
    };
}

export default useApiLoad;
