import PageTitle from "../../shared-kernel/components/PageTitle/PageTitle";
import Card, {CardTitle} from "../../shared-kernel/components/Card/Card";
import {NavLink, useParams} from "react-router-dom";
import {useMutation, useQuery} from "@tanstack/react-query";
import Providers from "admin/repositories/Providers";
import {Controller, SubmitHandler, useForm} from "react-hook-form";
import ProviderData from "../value-objects/ProviderData";
import Input from "../../shared-kernel/components/Input/Input";
import Button from "../../shared-kernel/components/Button/Button";
import React, {useEffect} from "react";
import Select from "../../shared-kernel/components/Select/Select";
import useAlert from "../../application/hook/useAlert";
import {AlertType} from "../../application/context/AlertContext";
import ArticleCard from "../../article/components/ArticleCard/ArticleCard";
import Provider from "../../article/value-objects/Provider";
import Loading from "../../shared-kernel/components/Loading/Loading";

const LayoutOptions = [
    {value: 'IMG_RIGHT', lable: 'Bild rechts'},
    {value: 'IMG_FULL', lable: 'Vollbild'},
]

const ProviderEdit = () => {
    const {id} = useParams();
    const {setAlert} = useAlert();

    const {data: provider} = useQuery({
        queryKey: ['provider', id],
        queryFn: () => Providers.find(id!!),
        enabled: !!id
    });

    const storeMutation = useMutation({
        mutationFn: Providers.save,
        onSuccess: () => {
            setAlert('Provider Gespeichert.', AlertType.SUCCESS);
        },
        onError: (error: any) => {
            setAlert(error.response.data.message || error.message, AlertType.ERROR);
        }
    });

    const testMutation = useMutation({
        mutationFn: Providers.test,
        onSuccess: () => {
            setAlert('Inhalte wurden gefunden.', AlertType.SUCCESS);
        },
        onError: (error: any) => {
            setAlert(error.response.data.message || error.message, AlertType.ERROR);
        }
    });

    const {control, handleSubmit, formState: {errors}, watch, setValue, getValues } = useForm<ProviderData>({
        defaultValues: {
            name: undefined,
            color: '#000000',
            logoImage: undefined,
            aggregateUrl: undefined,
            isActive: 'false',
            hasProducts: 'false',
            layout: 'IMG_FULL',
            articleSelectorWrapper: undefined,
            articleSelectorHeadline: undefined,
            articleHeadline: undefined,
            articleSelectorSubHeadline: undefined,
            articleSelectorDescription: undefined,
            articleSelectorImage: undefined,
            articleImage: undefined,
            articleSelectorLink: undefined,
            articleLink: undefined,
            articleSelectorDate: undefined,
            articleSelectorDateFormat: undefined,
            articleSelectorDateLocale: undefined,
            productSelectorWrapper: undefined,
            productSelectorLink: undefined,
            productSelectorImage: undefined,
            productSelectorName: undefined
        },
    });

    const submitHandler: SubmitHandler<ProviderData> = (providerData: ProviderData) => {
        providerData.id = id;
        storeMutation.mutate(providerData);
    };

    const hasProducts = watch('hasProducts', 'false');

    useEffect(() => {
        if ('true' === hasProducts) {
            setValue('layout', 'PRODUCTS');
        }
    }, [hasProducts, setValue]);

    useEffect(() => {
        if (provider) {
            setValue('name', provider.name);
            setValue('color', provider.color);
            setValue('logoImage', provider.logoImage);
            setValue('aggregateUrl', provider.aggregateUrl);
            setValue('isActive', String(provider.isActive));
            setValue('hasProducts', String(provider.hasProducts));
            setValue('layout', provider?.layout);
            setValue('articleSelectorWrapper', provider.articleSelectorWrapper);
            setValue('articleSelectorHeadline', provider.articleSelectorHeadline ?? undefined);
            setValue('articleHeadline', provider.articleHeadline ?? undefined);
            setValue('articleSelectorSubHeadline', provider.articleSelectorSubHeadline ?? undefined);
            setValue('articleSelectorDescription', provider.articleSelectorDescription ?? undefined);
            setValue('articleSelectorImage', provider.articleSelectorImage ?? undefined);
            setValue('articleImage', provider.articleImage ?? undefined);
            setValue('articleSelectorLink', provider.articleSelectorLink ?? undefined);
            setValue('articleLink', provider.articleLink ?? undefined);
            setValue('articleSelectorDate', provider.articleSelectorDate);
            setValue('articleSelectorDateFormat', provider.articleSelectorDateFormat);
            setValue('articleSelectorDateLocale', provider.articleSelectorDateLocale);
            setValue('productSelectorWrapper', provider.productSelectorWrapper ?? undefined);
            setValue('productSelectorLink', provider.productSelectorLink ?? undefined);
            setValue('productSelectorImage', provider.productSelectorImage ?? undefined);
            setValue('productSelectorName', provider.productSelectorName ?? undefined);
        }

    }, [provider, setValue]);

    const testArticleSelector = () => {
        const values = getValues();
        testMutation.mutate({
            aggregateUrl: values.aggregateUrl,
            articleSelector: {
                wrapper: values.articleSelectorWrapper,
                headline: values.articleSelectorHeadline,
                subHeadline: values.articleSelectorSubHeadline,
                description: values.articleSelectorDescription,
                image: values.articleSelectorImage,
                link: values.articleSelectorLink,
                dateSelector: {
                    date: values.articleSelectorDate,
                    format: values.articleSelectorDateFormat,
                    locale: values.articleSelectorDateLocale,
                    attribute: undefined
                },
            },
            productSelectorWrapper: values.productSelectorWrapper,
            productSelectorLink: values.productSelectorLink,
            productSelectorImage: values.productSelectorImage,
            productSelectorName: values.productSelectorName,
        });
    }

    return (
        <form onSubmit={handleSubmit(submitHandler)}>
            <PageTitle text='Provider'>
                <div>
                    <NavLink to='/admin/provider'>
                        <Button btnType='default'>
                            Abbrechen
                        </Button>
                    </NavLink>
                    <Button btnType='primary' type='submit'>
                        Anlegen
                    </Button>
                </div>
            </PageTitle>
            <div className='columns-1 md:columns-2 gap-4'>
                <Card>
                    <CardTitle>Provider Daten</CardTitle>

                    <Controller
                        name='name'
                        control={control}
                        rules={{
                            required: 'Bitte gib ein Name ein.'
                        }}
                        render={({field}) => (
                            <Input
                                lable='Name*' {...field}
                                ref={null}
                                error={errors.name?.message}
                                data-testid='name'/>
                        )}
                    />

                    <Controller
                        name='color'
                        control={control}
                        rules={{
                            required: 'Bitte wähle ein Farbe.'
                        }}
                        render={({field}) => (
                            <Input
                                lable='Farbe*' {...field}
                                type='color'
                                ref={null}
                                error={errors.color?.message}
                                data-testid='color'/>
                        )}
                    />

                    <Controller
                        name='logoImage'
                        control={control}
                        rules={{
                            required: 'Bitte gibt eine URL zum Logo ein.'
                        }}
                        render={({field}) => (
                            <Input
                                lable='Logo URL*' {...field}
                                type='url'
                                placeholder='https://example.com/logo.png'
                                ref={null}
                                error={errors.logoImage?.message}
                                data-testid='logoImage'/>
                        )}
                    />

                    <Controller
                        name='aggregateUrl'
                        control={control}
                        rules={{
                            required: 'Bitte gibt eine URL der Seite ein.'
                        }}
                        render={({field}) => (
                            <Input
                                lable='Aggregate URL*' {...field}
                                type='url'
                                placeholder='https://example.com'
                                ref={null}
                                error={errors.aggregateUrl?.message}
                                data-testid='aggregateUrl'/>
                        )}
                    />

                    <Controller
                        name='isActive'
                        control={control}
                        render={({field}) => (
                            <Input
                                lable='Aktive*' {...field}
                                type='checkbox'
                                checked={provider?.isActive}
                                ref={null}
                                error={undefined}
                                data-testid='isActive'/>
                        )}
                    />

                    <Controller
                        name='hasProducts'
                        control={control}
                        render={({field}) => (
                            <Input
                                lable='Mit Produkten*' {...field}
                                type='checkbox'
                                checked={'true' === String(provider?.hasProducts ?? 'false')}
                                ref={null}
                                error={undefined}
                                data-testid='hasProducts' />
                        )}
                    />

                    {'false' === hasProducts && (
                        <Controller
                            name='layout'
                            control={control}
                            render={({field}) => (
                                <Select lable='Layout*' options={LayoutOptions} error={undefined} {...field}/>
                            )}
                        />
                    )}
                </Card>

                <Card>
                    <CardTitle>Article Selector</CardTitle>

                    <Controller
                        name='articleSelectorWrapper'
                        control={control}
                        rules={{
                            required: 'Bitte gibt einen Selector für den Wrapper an.'
                        }}
                        render={({field}) => (
                            <Input
                                lable='Artikelwrapper Selector*' {...field}
                                type='text'
                                placeholder='.//*/div'
                                ref={null}
                                error={errors.articleSelectorWrapper?.message}
                                data-testid='articleSelectorWrapper'/>
                        )}
                    />

                    <Controller
                        name='articleSelectorHeadline'
                        control={control}
                        rules={{
                            required: 'Bitte gibt einen Selector für die Headline an.'
                        }}
                        render={({field}) => (
                            <Input
                                lable='Headline Selector*' {...field}
                                type='text'
                                placeholder='.//*/h2'
                                ref={null}
                                error={errors.articleSelectorHeadline?.message}
                                data-testid='articleSelectorHeadline'/>
                        )}
                    />

                    {'true' === hasProducts && (
                        <Controller
                            name='articleHeadline'
                            control={control}
                            render={({field}) => (
                                <Input
                                    lable='Artikelheadline' {...field}
                                    type='text'
                                    placeholder='Example headline'
                                    ref={null}
                                    error={errors.articleHeadline?.message}
                                    data-testid='articleHeadline'/>
                            )}
                        />
                    )}

                    <Controller
                        name='articleSelectorSubHeadline'
                        control={control}
                        render={({field}) => (
                            <Input
                                lable='SubHeadline Selector*' {...field}
                                type='text'
                                placeholder='.//*/h3'
                                ref={null}
                                error={undefined}
                                data-testid='articleSelectorSubHeadline'/>
                        )}
                    />

                    <Controller
                        name='articleSelectorDescription'
                        control={control}
                        render={({field}) => (
                            <Input
                                lable='Beschreibungstext Selector*' {...field}
                                type='text'
                                placeholder='.//*/p'
                                ref={null}
                                error={undefined}
                                data-testid='articleSelectorDescription'/>
                        )}
                    />

                    <Controller
                        name='articleSelectorImage'
                        control={control}
                        rules={{
                            required: 'Bitte gibt einen Selector für Artikelbild an.'
                        }}
                        render={({field}) => (
                            <Input
                                lable='Bild Selector*' {...field}
                                type='text'
                                placeholder='.//*/img'
                                ref={null}
                                error={errors.articleSelectorImage?.message}
                                data-testid='articleSelectorImage'/>
                        )}
                    />

                    {'true' === hasProducts && (
                        <Controller
                            name='articleImage'
                            control={control}
                            render={({field}) => (
                                <Input
                                    lable='Artikelbild UR' {...field}
                                    type='url'
                                    placeholder='https://www.exmpale.com/image.png'
                                    ref={null}
                                    error={errors.articleImage?.message}
                                    data-testid='articleImage'/>
                            )}
                        />
                    )}

                    <Controller
                        name='articleSelectorLink'
                        control={control}
                        rules={{
                            required: 'Bitte gibt einen Selector für den Link zum Artikel an.'
                        }}
                        render={({field}) => (
                            <Input
                                lable='Artikellink Selector*' {...field}
                                type='text'
                                placeholder='.//*/a'
                                ref={null}
                                error={errors.articleSelectorLink?.message}
                                data-testid='articleSelectorLink'/>
                        )}
                    />

                    {'true' === hasProducts && (
                        <Controller
                            name='articleLink'
                            control={control}
                            render={({field}) => (
                                <Input
                                    lable='Artikel URL' {...field}
                                    type='url'
                                    placeholder='https://www.example.com'
                                    ref={null}
                                    error={errors.articleLink?.message}
                                    data-testid='articleLink'/>
                            )}
                        />
                    )}

                    <Controller
                        name='articleSelectorDate'
                        control={control}
                        rules={{
                            required: 'Bitte gibt einen Selector für das Datum an.'
                        }}
                        render={({field}) => (
                            <Input
                                lable='Datum Selector*' {...field}
                                type='text'
                                placeholder='.//*/span'
                                ref={null}
                                error={errors.articleSelectorDate?.message}
                                data-testid='articleSelectorDate'/>
                        )}
                    />

                    <div className="flex columns-2 gap-4">
                        <Controller
                            name='articleSelectorDateFormat'
                            control={control}
                            rules={{
                                required: 'Bitte gibt einen Format für das Datum an.'
                            }}
                            render={({field}) => (
                                <Input
                                    lable='Datum Format*' {...field}
                                    type='text'
                                    placeholder='Y-m-d'
                                    ref={null}
                                    error={errors.articleSelectorDateFormat?.message}
                                    data-testid='articleSelectorDateFormat'/>
                            )}
                        />

                        <Controller
                            name='articleSelectorDateLocale'
                            control={control}
                            render={({field}) => (
                                <Select
                                    options={[{value: 'de_DE', lable: 'Deutsch'}, { value:'en_EN', lable:'English'}]}
                                    lable='Datum Sprache*'
                                    {...field}
                                    error={undefined}
                                    ref={null}
                                    data-testid='articleSelectorDateFormat'
                                />
                            )}
                        />
                    </div>

                    <Button btnType='default' type='button' onClick={() => { testArticleSelector() }}>Article Selector testen</Button>
                </Card>

                {testMutation.isPending && (
                    <Loading color='grey' />
                )}

                {testMutation.isSuccess && (
                    <div>
                        Anzahl gefundener Artikel: <span className='font-bold'>{testMutation.data?.countArticle ?? 0}</span>
                        <ArticleCard article={{
                            id: 'test-data',
                            title: testMutation.data?.article.headline ?? 'No Headline',
                            subTitle: testMutation.data?.article.subHeadline ?? 'No SubHeadline',
                            image: testMutation.data?.article.image ?? 'No Image',
                            date: testMutation.data?.article.date ?? 'No Date',
                            provider: Provider.DEFAULT,
                            link: testMutation.data?.article.link ?? 'No Link',
                            description: testMutation.data?.article.description ?? 'No Description',
                            products: [],
                        }} />
                    </div>
                )}

                {'true' === hasProducts && (
                    <Card>
                        <CardTitle>Product Selector</CardTitle>

                        <Controller
                            name='productSelectorWrapper'
                            control={control}
                            rules={{
                                required: 'Bitte gibt einen Selector für den Produktwrapper an.'
                            }}
                            render={({field}) => (
                                <Input
                                    lable='Produktwrapper Selector*' {...field}
                                    type='text'
                                    placeholder='.//*/div'
                                    ref={null}
                                    error={errors.productSelectorWrapper?.message}
                                    data-testid='productSelectorWrapper'/>
                            )}
                        />

                        <Controller
                            name='productSelectorName'
                            control={control}
                            rules={{
                                required: 'Bitte gibt einen Selector für den Produktname an.'
                            }}
                            render={({field}) => (
                                <Input
                                    lable='Produktname Selector*' {...field}
                                    type='text'
                                    placeholder='.//*/h2'
                                    ref={null}
                                    error={errors.productSelectorName?.message}
                                    data-testid='productSelectorName'/>
                            )}
                        />

                        <Controller
                            name='productSelectorImage'
                            control={control}
                            rules={{
                                required: 'Bitte gibt einen Selector für das Produktbild ein.'
                            }}
                            render={({field}) => (
                                <Input
                                    lable='Produktbild Selector*' {...field}
                                    type='text'
                                    placeholder='.//*/img'
                                    ref={null}
                                    error={errors.productSelectorImage?.message}
                                    data-testid='productSelectorImage' />
                            )}
                        />

                        <Controller
                            name='productSelectorLink'
                            control={control}
                            rules={{
                                required: 'Bitte gibt einen Selector für den Produktlink an.'
                            }}
                            render={({field}) => (
                                <Input
                                    lable='Produktlink Selector*' {...field}
                                    type='text'
                                    placeholder='.//*/a'
                                    ref={null}
                                    error={errors.productSelectorLink?.message}
                                    data-testid='productSelectorLink'/>
                            )}
                        />

                        <Button btnType='default'>Prüfen</Button>
                    </Card>
                )}
            </div>
        </form>
    );
}

export default ProviderEdit;
