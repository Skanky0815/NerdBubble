import {ProductType} from "./ProductType";

enum Provider {
    RAIL_SIM = 'rail_sim',
    ASMODEE = 'asmodee',
    XBOX_DYNASTY = 'xbox_dynasty',
    TSW = 'tsw',
}

type ArticleType = {
    id: string,
    title: string,
    subTitle?: string,
    date: string,
    link: string,
    image: string,

    description?: string;
    provider: Provider
    products: ProductType[],
}

export type { ArticleType };
export { Provider };