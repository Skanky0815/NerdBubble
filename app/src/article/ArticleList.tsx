import React, { useEffect, useReducer } from "react";
import axios from 'axios';
import { ArticleType } from "./ArticleType";
import Article from "./Article";
import Loading from "../components/Loading";
import { ArrowPathIcon } from "@heroicons/react/24/solid";

enum ActionType {
    SUCCESS= 'SUCCESS',
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

const fetchArticles = (dispatch: React.Dispatch<any>) => {
    dispatch({type: ActionType.LOADING})
    axios.get('http://0.0.0.0/api/articles')
        .then(res => dispatch({type: ActionType.SUCCESS, payload: res.data.data}))
        .catch(() => dispatch({type: ActionType.ERROR}));
}

export default function ArticleList() {
    const [state, dispatch] = useReducer(reducer, initialState);

    useEffect(() => {
        fetchArticles(dispatch);
    }, [dispatch]);

    const articleLst = state.data.map((article: ArticleType) => <Article key={article.id} article={article} />);

    const reload = (e: React.MouseEvent<HTMLElement>) => fetchArticles(dispatch);

    return (
        <div className="container mx-auto p-5">
            <div className="flex justify-between items-center mt-2 mb-5">
                <h1 className="text-xl text-gray-500 font-bold">NerdBubble</h1>
                <button className="h-8 w-8" onClick={reload}>
                    <ArrowPathIcon className="h-6 w-6 text-gray-500 hover:text-black" />
                </button>
            </div>

            {state.loading ? <Loading /> : <div className="gap-4 columns-1 md:columns-2">{articleLst}</div>}
        </div>
    );
}