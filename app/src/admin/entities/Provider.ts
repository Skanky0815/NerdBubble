type Provider = {
    id: string
    name: string
    color: string
    logoImage: string
    aggregateUrl: string
    hasProducts: boolean
    layout: 'IMG_RIGHT'|'IMG_FULL'|'PRODUCTS'
    isActive: boolean
    articleSelectorHeadline: string|null
    articleHeadline: string|null
    articleSelectorWrapper: string
    articleSelectorSubHeadline: string|null
    articleSelectorDescription: string|null
    articleSelectorImage: string|null
    articleImage: string|null
    articleSelectorLink: string|null
    articleLink: string|null
    articleSelectorDate: string
    articleSelectorDateFormat: string
    articleSelectorDateLocale: string

    productSelectorWrapper: string|null
    productSelectorName: string|null
    productSelectorImage: string|null
    productSelectorLink: string|null
}

export default Provider;
