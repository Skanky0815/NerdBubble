<?php

declare(strict_types=1);

use App\Models\Article;
use App\Models\ArticleLayout;
use App\Models\Provider;
use App\Models\ProviderType;
use Domains\Article\ValueObjects\ArticleSelector;
use Domains\Article\ValueObjects\DateSelector;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $providerList = [
            ProviderType::BLUE_BRIXX->value => $this->blueBrixx(),
            ProviderType::F_SHOP->value => $this->fShop(),
            ProviderType::ASMODEE->value => $this->asmodee(),
            ProviderType::RAIL_SIM->value => $this->railSim(),
            ProviderType::TSW->value => $this->tsw(),
            ProviderType::ULISSES_SPIELE->value => $this->ulissesSpiele(),
            ProviderType::XBOX_DYNASTY->value => $this->xboxDynasty(),
            ProviderType::FANTASY_FLIGHT_GAMES->value => $this->fantasyFlightGames(),
        ];

        Schema::table('articles', function (Blueprint $table) {
            $table->uuid('provider_id')->nullable()->after('id');
        });

        foreach ($providerList as $providerType => $provider) {
            Article::where('provider', $providerType)
                ->update(['provider_id' => $provider->id]);
        }

        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('provider');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('provider_id');
        });
    }

    private function blueBrixx(): Provider
    {
        $provider = new Provider();

        $provider->name = 'BlueBrixx';
        $provider->color = '#193153';
        $provider->logoImage = 'https://www.bluebrixx.com/img/new_design/logo_mitSteinen-min.png';
        $provider->aggregateUrl = 'https://www.bluebrixx.com/de/ankuendigungen?limit=32';
        $provider->hasProducts = true;
        $provider->layout = ArticleLayout::PRODUCTS;
        $provider->articleSelector = new ArticleSelector(
            wrapper: '',
            headline: '',
            image: '',
            dateSelector: new DateSelector(
                date: '',
                format: '',
                locale: '',
                attribute: '',
            ),
            link: '',
            subHeadline: '',
            description: '',
        );
        $provider->isActive = false;
        $provider->productSelectorWrapper = '//div[@class="category"]';
        $provider->productSelectorName = './/div[@class="searchItemTitle"]';
        $provider->productSelectorImage = './/*/img';
        $provider->productSelectorLink = './/*/a';
        $provider->articleHeadline = 'BlueBrixx';
        $provider->articleLink = 'https://www.bluebrixx.com/de/neuheiten?limit=32';
        $provider->articleImage = 'https://www.bluebrixx.com/img/new_design/logo_mitSteinen-min.png';

        $provider->save();

        return $provider;
    }

    private function fShop(): Provider
    {
        $provider = new Provider();

        $provider->name = 'F-Shop';
        $provider->color = '#00C100';
        $provider->logoImage = 'https://www.f-shop.de/media/image/37/53/7c/logo_website_F_Shop_2.png';
        $provider->aggregateUrl = 'https://www.f-shop.de/neuheiten/';
        $provider->hasProducts = true;
        $provider->layout = ArticleLayout::PRODUCTS;
        $provider->isActive = false;
        $provider->articleSelector = new ArticleSelector(
            wrapper: '',
            headline: '',
            image: '',
            dateSelector: new DateSelector(
                date: '',
                format: '',
                locale: '',
                attribute: '',
            ),
            link: '',
            subHeadline: '',
            description: '',
        );
        $provider->articleHeadline = 'F-Shop';
        $provider->articleLink = 'https://www.f-shop.de/neuheiten/';
        $provider->articleImage = 'https://www.f-shop.de/media/image/37/53/7c/logo_website_F_Shop_2.png';
        $provider->productSelectorWrapper = './/div[contains(@class, "product--box")]';
        $provider->productSelectorName = './/a[@class="product--title"]';
        $provider->productSelectorImage = './/*/a';
        $provider->productSelectorLink = './/span[@class="image--media"]/img';

        $provider->save();

        return $provider;
    }

    private function asmodee(): Provider
    {
        $provider = new Provider();

        $articleSelector = new ArticleSelector(
            wrapper: '',
            headline: '',
            image: '',
            dateSelector: new DateSelector(
                date: '',
                format: '',
                locale: '',
                attribute: '',
            ),
            link: '',
            subHeadline: '',
            description: '',
        );

        $provider->name = 'Asmodee';
        $provider->color = '#FFBC00';
        $provider->logoImage = 'https://assets.svc.asmodee.net/production-asmodeede/undefined/PNG_72_DPI_Logotype_Asmodee_Tagline_Registred_Positif_RVB_1aeae0655f.png';
        $provider->aggregateUrl = 'https://www.asmodee.de/news';
        $provider->hasProducts = true;
        $provider->layout = ArticleLayout::PRODUCTS;
        $provider->isActive = false;
        $provider->articleSelector = $articleSelector;
        $provider->productSelectorWrapper = '';
        $provider->productSelectorName = '';
        $provider->productSelectorImage = '';
        $provider->productSelectorLink = '';

        $provider->save();

        return $provider;
    }

    private function xboxDynasty(): Provider
    {
        $provider = new Provider();

        $provider->name = 'Xbox Dynasty';
        $provider->color = '#00ff00';
        $provider->logoImage = 'https://www.xboxdynasty.de/wp-content/themes/xd7/images/logo.svg';
        $provider->aggregateUrl = 'https://www.xboxdynasty.de/';
        $provider->hasProducts = false;
        $provider->layout = ArticleLayout::IMG_RIGHT;
        $provider->isActive = false;
        $provider->articleSelector = new ArticleSelector(
            wrapper: '//article',
            headline: './/div/div/header/h1/a',
            image: './/div/a/img',
            dateSelector: new DateSelector(
                date: './/div/div/header/div/time',
                format: 'd. M Y',
                locale: 'de_DE',
                attribute: '',
            ),
            link: './/div/div/header/h1/a',
            subHeadline: './/div/div/div[@class="entry-content"]',
        );

        $provider->save();

        return $provider;
    }

    private function railSim(): Provider
    {
        $provider = new Provider();

        $provider->name = 'RailSim';
        $provider->color = '#A7001C';
        $provider->logoImage = 'https://rail-sim.de/forum/wcf/images/style-12/pageLogo-07c54ba9.png';
        $provider->aggregateUrl = 'https://rail-sim.de/forum/wcf/train-sim-world-neuigkeiten/';
        $provider->articleImage = 'https://www.rail-sim.de/wp-content/uploads/2016/04/rail-sim_logo.png';
        $provider->hasProducts = true;
        $provider->layout = ArticleLayout::IMG_FULL;
        $provider->isActive = false;
        $provider->articleSelector = new ArticleSelector(
            wrapper: '//li[@class="tabularListRow"]',
            headline: './/li[@class="columnSubject"]/h3/a',
            image: null,
            dateSelector: new DateSelector(
                date: './/li[@class="columnLastPost"]/div/div/small/time',
                format: DATE_ISO8601_EXPANDED,
                attribute: 'datetime',
            ),
            link: './/li[@class="columnSubject"]/h3/a',
            subHeadline: '',
            description: '',
        );

        $provider->save();

        return $provider;
    }

    private function tsw(): Provider
    {
        $provider = new Provider();

        $articleSelector = new ArticleSelector(
            wrapper: '',
            headline: '',
            image: '',
            dateSelector: new DateSelector(
                date: '',
                format: '',
                locale: '',
                attribute: '',
            ),
            link: '',
            subHeadline: '',
            description: '',
        );

        $provider->name = 'Train Sim World';
        $provider->color = '';
        $provider->logoImage = 'https://dovetailgames.com/themes/base/assets/images/front-elements/dovetail-white-logo.png';
        $provider->aggregateUrl = 'https://cms.dovetailgames.com/api/v1/ghost/hub/tsw/web?limit=24&page=1';
        $provider->hasProducts = true;
        $provider->layout = ArticleLayout::IMG_FULL;
        $provider->isActive = false;
        $provider->articleSelector = $articleSelector;
        $provider->productSelectorWrapper = '';
        $provider->productSelectorName = '';
        $provider->productSelectorImage = '';
        $provider->productSelectorLink = '';

        $provider->save();

        return $provider;
    }

    private function ulissesSpiele(): Provider
    {
        $provider = new Provider();

        $provider->name = 'Ulisses Spiele';
        $provider->color = '#008000';
        $provider->logoImage = 'https://ulisses-spiele.de/wp-content/themes/ulisses-redesign/gfx/ulisses-logo.png';
        $provider->aggregateUrl = 'https://ulisses-spiele.de/news/';
        $provider->hasProducts = true;
        $provider->layout = ArticleLayout::IMG_RIGHT;
        $provider->isActive = false;
        $provider->articleSelector = new ArticleSelector(
            wrapper: '//article[contains(@class, "post")]',
            headline: './/*[contains(@class, "entry-title")]',
            image: './/*/img',
            dateSelector: new DateSelector(
                date: './/*[contains(@class, "entry-meta-date")]',
                format: 'd. M Y',
                locale: 'de',
            ),
            link: './/*/a',
            description: './/*[contains(@class, "entry-content")]/p',
        );

        $provider->save();

        return $provider;
    }

    private function fantasyFlightGames(): Provider
    {
        $provider = new Provider();

        $articleSelector = new ArticleSelector(
            wrapper: '',
            headline: '',
            image: '',
            dateSelector: new DateSelector(
                date: '',
                format: '',
                locale: '',
                attribute: '',
            ),
            link: '',
            subHeadline: '',
            description: '',
        );

        $provider->name = 'FantasyFlight Games';
        $provider->color = '#093156';
        $provider->logoImage = 'https://www.fantasyflightgames.com/static/images/logo_ffgdiamond_blk.png';
        $provider->aggregateUrl = 'https://www.fantasyflightgames.com/en/news/';
        $provider->hasProducts = true;
        $provider->layout = ArticleLayout::PRODUCTS;
        $provider->isActive = false;
        $provider->articleSelector = $articleSelector;

        $provider->save();

        return $provider;
    }
};
