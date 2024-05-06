import Card, {CardTitle} from "../../../shared-kernel/components/Card/Card";
import Input from "../../../shared-kernel/components/Input/Input";
import React from "react";
import {XMarkIcon} from "@heroicons/react/20/solid";
import {useMutation, useQuery, useQueryClient} from "@tanstack/react-query";
import Keywords from "../../repositories/Keywords";
import Keyword from "../../entities/Keyword";
import KeywordForm from "../KeywordForm/KeywordForm";

type KeywordPillProps = {
    keyword: Keyword
}

const KeywordPill = ({keyword}: KeywordPillProps) => {
    const queryClient = useQueryClient();

    const keywordMutation = useMutation({
        mutationFn: Keywords.remove,
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: ['keywords']});
        }
    });

    return (
        <div
            className={`flex flex-row gap-1 bg-orange-400 p-2 rounded-3xl text-xs uppercase`}
            onClick={() => keywordMutation.mutate(keyword.id)}>
            {keyword.word}
            <XMarkIcon className="h-4 w-4 rounded-3xl text-gray-500 hover:text-black bg-white"/>
        </div>
    );
}

export default function KeywordCard() {
    const {data: keywords} = useQuery({
        queryKey: ['keywords'],
        queryFn: Keywords.findAll
    });

    return (
        <Card>
            <CardTitle>Meine Suchwörter</CardTitle>

            <p className={'mb-4'}>Die Suchwörter werden zum sammeln der Inhalte genutzt.</p>

            <KeywordForm />

            <div className={`mt-4 flex flex-row flex-wrap gap-2`}>
                {keywords?.map(keyword => <KeywordPill key={keyword.id} keyword={keyword} />)}
            </div>
        </Card>
    );
}
