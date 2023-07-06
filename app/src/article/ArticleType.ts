import {ProductType} from "./ProductType";

enum Provider {
    RAIL_SIM = 'rail_sim',
    ASMODEE = 'asmodee',
    XBOX_DYNASTY = 'xbox_dynasty',
    TSW = 'tsw',
    BLUE_BRIXX = 'blue_brixx',
    F_SHOP = 'f_shop',
    FANTASY_FLIGHT_GAMES = 'fantasy_flight_games',
    ULISSES_SPIELE = 'ulisses_spiele',
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
