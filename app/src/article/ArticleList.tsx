import React, {useEffect, useReducer} from "react";
import {ArticleType} from "./ArticleType";
import Article from "./Article";
import Loading from "../components/Loading";
import {ArrowPathIcon} from "@heroicons/react/24/solid";
import PageTitle from "../components/PageTitle";
import apiClient from "../service/api";
import useAlert from "../common/hook/useAlert";
import {AlertType} from "../common/context/AlertContext";

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

const fetchArticles = (dispatch: React.Dispatch<any>, setAlert: (text: string, type: AlertType) => void) => {
    dispatch({type: ActionType.LOADING})
    apiClient.get('/api/articles')
        .then(res => dispatch({type: ActionType.SUCCESS, payload: res.data.data}))
        .catch(res => {
            dispatch({type: ActionType.ERROR})
            setAlert(res.response.data.message || res.message, AlertType.ERROR);
        });
}

export default function ArticleList() {
    const [state, dispatch] = useReducer(reducer, initialState);
    const {setAlert} = useAlert();

    useEffect(() => {
        fetchArticles(dispatch, setAlert);
    }, [dispatch, setAlert]);

    const articleLst = state.data.map((article: ArticleType) => <Article key={article.id} article={article} />);

    const reload = (e: React.MouseEvent<HTMLElement>) => fetchArticles(dispatch, setAlert);

    return (
        <>
            <PageTitle text={`NerdBubble`}>
                <button className="h-8 w-8" data-testid={`reload-button`} onClick={reload}>
                    <ArrowPathIcon className="h-6 w-6 text-gray-500 hover:text-black" />
                </button>
            </PageTitle>

            {state.loading ? <Loading color={`red`} /> : <div className="gap-4 columns-1 md:columns-2">{articleLst}</div>}
        </>
    );
}
