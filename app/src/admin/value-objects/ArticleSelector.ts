import DateSelector from "./DateSelector";

type ArticleSelector = {
    wrapper: string
    headline: string|undefined
    subHeadline: string|undefined
    description: string|undefined
    image: string|undefined
    link: string|undefined
    dateSelector: DateSelector|undefined
}

export default ArticleSelector;
