import React from "react";
import ArticleCard from "../components/ArticleCard/ArticleCard";
import {ArrowPathIcon} from "@heroicons/react/24/solid";
import useAlert from "../../common/hook/useAlert";
import {AlertType} from "../../common/context/AlertContext";
import {useQuery} from "@tanstack/react-query";
import Articles from "../repositories/Articles";
import PageTitle from "../../shared-kernel/components/PageTitle/PageTitle";
import Loading from "../../shared-kernel/components/Loading/Loading";
import Article from "../entities/Article";

export default function ArticleList() {
    const {setAlert} = useAlert();
    const {isError, isLoading, data: articles, error, refetch} = useQuery<Article[], Error>({
        queryKey: ['articles'],
        queryFn: Articles.findAll,
    });

    if (isError) {
        setAlert(error.message, AlertType.ERROR);
    }

    const articleElements = articles?.map((article: Article) => <ArticleCard key={article.id} article={article} />);

    const reloadHandler = () => {
        refetch();
    }

    return (
        <>
            <PageTitle text={`NerdBubble`}>
                <button className="h-8 w-8" data-testid={`reload-button`} onClick={reloadHandler}>
                    <ArrowPathIcon className="h-6 w-6 text-gray-500 hover:text-black" />
                </button>
            </PageTitle>

            {isLoading ? <Loading color={`red`} />
                : <div className="gap-4 columns-1 md:columns-2">{articleElements}</div>}
        </>
    );
}
