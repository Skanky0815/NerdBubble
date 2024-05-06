import {Controller, SubmitHandler, useForm} from "react-hook-form";
import KeywordData from "../../value-objects/KeywordData";
import Input from "../../../shared-kernel/components/Input/Input";
import Button from "../../../shared-kernel/components/Button/Button";
import React from "react";
import {useMutation, useQueryClient} from "@tanstack/react-query";
import Keywords from "../../repositories/Keywords";
import {PlusIcon} from "@heroicons/react/20/solid";

export default function KeywordForm() {
    const queryClient = useQueryClient();
    const { control, handleSubmit, formState: { errors }, reset } = useForm<KeywordData>({
        defaultValues: {
            word: '',
        }
    });

    const addKeyword = useMutation({
        mutationFn: Keywords.add,
        onSuccess: () => {
            queryClient.invalidateQueries({ queryKey: ['keywords'] }).then(() => {
                reset();
            });
        }
    });

    const submitHandler: SubmitHandler<KeywordData> = (keywordData: KeywordData) => {
        addKeyword.mutate(keywordData);
    }

    return (
        <form className={`flex flex-row`} onSubmit={handleSubmit(submitHandler)}>
            <Controller
                name={'word'}
                control={control}
                rules={{
                    required: 'Bitte gib ein Suchwort ein.'
                }}
                render={({field}) => <Input
                    lable={'Suchwort*'} {...field}
                    className={'w-full px-4 py-2 border border-gray-300 rounded-l-md focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition-all'}
                    ref={null}
                    error={errors.word?.message}
                    data-testid={'word'}/>}
            />
            <Button className={'flex-none self-end border border-l-0 border-gray-300 rounded-r-md hover:text-white hover:bg-blue-500 focus:ring-blue-500'} btnType={'primary'} type={'submit'}>
                <PlusIcon className={'size-10'} />
            </Button>
        </form>
    );
}
