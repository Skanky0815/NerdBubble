type ProviderData = {
    id: string|undefined
    name: string
    color: string
    logoImage: string
    aggregateUrl: string
    hasProducts: string
    layout: 'IMG_RIGHT'|'IMG_FULL'|'PRODUCTS'
    isActive: string

    articleSelectorWrapper: string
    articleSelectorHeadline: string|undefined
    articleHeadline: string|undefined
    articleSelectorSubHeadline: string|undefined
    articleSelectorDescription: string|undefined
    articleSelectorImage: string|undefined
    articleImage: string|undefined
    articleSelectorLink: string|undefined
    articleLink: string|undefined
    articleSelectorDate: string|undefined
    articleSelectorDateFormat: string|undefined
    articleSelectorDateLocale: string|undefined

    productSelectorWrapper: string|undefined
    productSelectorLink: string|undefined
    productSelectorImage: string|undefined
    productSelectorName: string|undefined
}

export default ProviderData;
