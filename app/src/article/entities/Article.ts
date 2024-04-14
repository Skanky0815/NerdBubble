import Provider from "article/value-objects/Provider";
import Product from "./Product";

type Article = {
    id: string
    title: string
    subTitle?: string
    date: string
    link: string
    image: string

    description?: string
    provider: Provider
    products: Product[]
}

export default Article;
