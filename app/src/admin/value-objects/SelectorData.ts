import ArticleSelector from "./ArticleSelector";

type SelectorData = {
    aggregateUrl: string
    articleSelector: ArticleSelector

    productSelectorWrapper: string|undefined
    productSelectorLink: string|undefined
    productSelectorImage: string|undefined
    productSelectorName: string|undefined
}

export default SelectorData;
