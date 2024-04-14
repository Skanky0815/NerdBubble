import Product from "article/entities/Product";
import Provider from "article/value-objects/Provider";
import Article from "../article/entities/Article";


export const FantasyFlightGamesArticle = {
    id: '91626c93-1c26-4358-8452-6628a7dce7fb',
    title: 'The Hand and the Eye',
    image: 'https://images-cdn.fantasyflightgames.com/filer_public/14/8d/148dcbc1-c3fc-4c76-9008-ff6ebbbc564b/mec112_preview_images_590x250.jpg',
    link: 'https://www.fantasyflightgames.com/en/news/2023/7/6/the-hand-and-the-eye/',
    date: '2023-01-01',
    provider: 'fantasy_flight_games',
    // description: 'Announcing The Two Towers Saga Expansion for The Lord of the Rings: The Card Game',
    products: [],
} as Article;

export const XboxDynastyArticle = {
    id: "9995a618-b1b2-4d8d-9961-d7239e268248",
    title: "Letzte Chance vor der Preiserh\u00f6hung",
    subTitle: "Der Xbox Game Pass wird teurer und heute ist eure letzte Chance vor der Preiserh\u00f6hung auch noch g\u00fcnstig mit Codes einzudecken.",
    link: "https://www.xboxdynasty.de/news/xbox-game-pass/letzte-chance-vor-der-preiserhoehung/",
    image: "https://www.xboxdynasty.de/wp-content/uploads/2017/02/xbox-game-pass-232-150x150.jpg.pagespeed.ce.3xwsD82r7n.jpg",
    date: "2023-07-06",
    provider: "xbox_dynasty",
    description: "",
    products: []
} as Article;

export const TSWArticle = {
    id: "9995a619-acd6-40f8-949e-2dbaae7119bc",
    title: "From Sea To Shining Sea",
    subTitle: "",
    link: "https://live.dovetailgames.com/live/train-sim-world/articles/article/from-sea-to-shining-sea",
    image: "https://media.dovetailgames.com/1688371939206_TSW_US_Article425x166.jpg",
    date: "2023-07-03",
    provider: "tsw",
    description: "Travel coast to coast in the US with an introduction to US railroad adventures in Train Sim World.",
    products: []
} as Article;

export const RailSimArticle = {
    id: '9995a617-4ecd-494d-9c49-299458c23b35',
    title: '[TSW3] Roadmap - Diskussionsthema',
    subTitle: "",
    link: 'https://rail-sim.de/forum/thread/38423-tsw3-roadmap-diskussionsthema/',
    image: 'https://www.rail-sim.de/wp-content/uploads/2016/04/rail-sim_logo.png',
    date: '2023-07-06',
    provider: 'rail_sim',
    description: '',
    products: []
} as Article;

export const AsmodeeArticle = {
    id: '2209dab2-3f24-4e91-8048-6bc32a955fa3',
    title: 'Lila Laster',
    date: '2018-09-14',
    subTitle: 'Neue Spiele sind auf dem Weg',
    image: 'https://assets.svc.asmodee.net/production-asmodeede/null/large_Lila_Laster_0cfe16d145.png',
    provider: 'asmodee',
    products: [
        {
            id: '39f34551-2f8b-428a-ba2c-8fd94445757d',
            name: 'Star Wars: Shatterpoint – You Cannot Run Duel Pack („Ihr könnt nicht entkommen“)',
            link: 'https://www.google.de',
            image: 'https://retail.asmodee.de/media/catalog/product/s/w/sw-shatterpoint-you-cannot-run-duel-pack-841333121792-3dboxl-web.jpg',
        } as Product,
        {
            id: 'f748fed1-4e0a-4fa9-9ae4-55ee4a63ac45',
            name: 'Star Wars: Shatterpoint – Jedi Hunters Squad Pack („Jedi-Jäger“)',
            link: 'https://www.amazon.de',
            image: 'https://retail.asmodee.de/media/catalog/product/s/w/sw-shatterpoint-jedi-hunters-squad-pack-841333121785-3dboxl-web.jpg',
        } as Product,
        {
            id: 'f748fed1-4e0a-4fa9-9ae4-55ee4a63ac45',
            name: 'Der Herr der Ringe: Das Kartenspiel – Traumjäger (Kampagnen-Erweiterung)',
            link: 'https://www.asmodee.de/produkte/der-herr-der-ringe-das-kartenspiel-traumjaeger-kampagnen-erweiterung',
            image: 'https://retail.asmodee.de/media/catalog/product/d/e/der-herr-der-ringe-lcg-traumjaeger-kampagne-841333122041-3dboxl-web.png',
        } as Product,
    ]
} as Article;

export const BlueBrixxArticle = {
    id: '01e4b91c-b044-4002-a6ea-d429d3bef99f',
    title: 'BlueBrixx',
    date: '2023-01-01',
    image: 'https://www.bluebrixx.com/img/new_design/logo_mitSteinen-min.png',
    link: 'https://www.bluebrixx.com/de/neuheiten?limit=32',
    provider: 'blue_brixx',
    products: [
        {
            id: '39f34551-2f8b-428a-ba2c-8fd94445757d',
            name: 'Star Trek Gemälde in Picards Bereitschaftsraum',
            link: 'https://www.bluebrixx.com/de/star-trek/105420/Star-Trek-Gemaelde-in-Picards-Bereitschaftsraum-BlueBrixx-Pro',
            image: 'https://www.bluebrixx.com/img/items/105/105420/300/105420_1.jpg',
        } as Product,
        {
            id: 'f748fed1-4e0a-4fa9-9ae4-55ee4a63ac45',
            name: 'Star Trek USS Voyager NCC-74656',
            link: 'https://www.bluebrixx.com/de/star-trek/104966/Star-Trek-USS-Voyager-NCC-74656-BlueBrixx-Pro',
            image: 'https://www.bluebrixx.com/img/items/104/104966/300/104966_4.jpg',
        } as Product,
    ]
} as Article;

export const FShopArticle = {
    id: 'e94f55ec-25ee-438d-b03d-f61c84c77042',
    title: 'F-Shop',
    provider: 'f_shop',
    image: 'https://www.f-shop.de/media/image/37/53/7c/logo_website_F_Shop_2.png',
    link: 'https://www.f-shop.de/neuheiten/',
    date: '2023-01-01',
    products: [
        {
            id: '39f34551-2f8b-428a-ba2c-8fd94445757d',
            name: 'DSA5 - Archiv der Dämonen',
            link: 'https://www.f-shop.de/das-schwarze-auge/rollenspiel/regel-und-quellenbaende/3598/dsa5-archiv-der-daemonen',
            image: 'https://www.f-shop.de/media/image/b8/01/62/US25977_0_0999_200x200.jpg',
        } as Product,
        {
            id: 'f748fed1-4e0a-4fa9-9ae4-55ee4a63ac45',
            name: 'DSA5 - Schicksal und Verdammnis - Gottheit Swafnir',
            link: 'https://www.f-shop.de/das-schwarze-auge/rollenspiel/zubehoer/3583/dsa5-schicksal-und-verdammnis-gottheit-swafnir',
            image: 'https://www.f-shop.de/media/image/f6/27/fe/US25897_0_0999_200x200.jpg',
        } as Product,
        {
            id: 'f748fed1-4e0a-4fa9-9ae4-55ee4a63ac45',
            name: 'VVK DSA5 - Späte Bronnjarin + PDFs',
            link: 'https://www.f-shop.de/das-schwarze-auge-die-winterwacht-das-bornland-und-die-walberge-late-pledge/3574/vvk-dsa5-spaete-bronnjarin-pdfs',
            image: 'https://www.f-shop.de/media/image/ff/6c/c5/US25161VVK_0_0999_200x200.jpg',
        } as Product,
    ]
} as Article;

export const UlissesSpieleArticle = {
    id: '922fbd3c-aeb3-4165-a0d8-3087ca05c8fb',
    title: 'Das Archiv der Dämonen',
    description: 'Die Arbeiten am Archiv der Dämonen für Das Schwarze Auge 5 sind in vollem Gange. Zeit für Redakteur Alex, um dir zu berichten, welche Inhalte im Band auf dich warten. Dämonologen, horcht auf!',
    link: 'https://ulisses-spiele.de/das-archiv-der-daemonen/',
    image: 'https://ulisses-spiele.de/wp-content/uploads/2023/06/Beitragsbild-Blogartikel-Archiv-der-Daemonen-256x143.jpg',
    date: '2023-01-01',
    provider: Provider.ULISSES_SPIELE,
    products: [],
} as Article;
