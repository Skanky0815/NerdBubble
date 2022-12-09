package me.ricoschulz.crawler

import kotlinx.coroutines.DelicateCoroutinesApi
import kotlinx.coroutines.GlobalScope
import kotlinx.coroutines.async
import kotlinx.serialization.Serializable
import kotlinx.serialization.decodeFromString
import me.ricoschulz.helper.fetch
import me.ricoschulz.helper.hasKeyword
import me.ricoschulz.helper.json
import me.ricoschulz.helper.selectTags
import me.ricoschulz.valueObject.News
import me.ricoschulz.valueObject.Product
import me.ricoschulz.valueObject.Provider
import me.ricoschulz.valueObject.allNames
import org.jsoup.Jsoup

@Serializable internal data class SmallDto(val url: String)

@Serializable internal data class FormatsDto(val small: SmallDto)

@Serializable
internal data class TileImageDto(val formats: FormatsDto? = null, val url: String? = null)

@Serializable internal data class FacetsDto(val image: String)

@Serializable
internal data class ProductDto(val name: String, val facets: FacetsDto, val slug: String) {
    fun toProductDto() =
        Product(name = name, img = facets.image, link = "https://www.asmodee.de/produkte/${slug}")
}

@Serializable
internal data class ContentDto(val text: String? = null, val product: ProductDto? = null)

@Serializable
internal data class ArticleDto(
    val headline: String,
    val subHeadline: String,
    val creationDate: String,
    val tileImage: TileImageDto,
    val slug: String,
    val content: List<ContentDto> = listOf()
) {
    fun product(contentFilter: (ContentDto) -> Boolean) =
        this.content.filter(contentFilter).map { it.product!!.toProductDto() }

    fun image() = tileImage.formats?.small?.url ?: tileImage.url ?: throw Throwable("missing image")
}

@Serializable internal data class PagePropsDto(val articles: List<ArticleDto>)

@Serializable
internal data class AsmodeeResponseDto(val pageProps: PagePropsDto) {
    fun articleForEach(articleFilter: (ArticleDto) -> Boolean, callback: (ArticleDto) -> Unit) {
        pageProps.articles.filter(articleFilter).forEach(callback)
    }
}

@DelicateCoroutinesApi
suspend fun asmodee(callback: (News) -> Unit) =
    GlobalScope.async {
        fun contentFilter(content: ContentDto) =
            content.product != null && content.product.name.hasKeyword()

        fun articleFilter(article: ArticleDto) =
            article.headline.plus(article.subHeadline).hasKeyword() ||
                article.content.any(::contentFilter)

        suspend fun loadHash(): String {
            val (hash) =
                "/_next/static/(.*)/_buildManifest.js"
                        .toRegex()
                        .find(
                            Jsoup.parse(fetch("https://www.asmodee.de"))
                                .select("script[src$=_buildManifest.js]")
                                .attr("src")
                        )!!
                    .destructured
            return hash
        }

        val response: String = fetch("https://www.asmodee.de/_next/data/${loadHash()}/news.json")
        json.decodeFromString<AsmodeeResponseDto>(response).articleForEach(::articleFilter) {
            val products = it.product(::contentFilter)

            callback(
                News(
                    title = it.headline,
                    newsType = Provider.ASMODEE,
                    subTitle = it.subHeadline,
                    link = "https://www.asmodee.de/news/${it.slug}",
                    img = it.image(),
                    date = it.creationDate,
                    products = products,
                    tags = selectTags(products.allNames(), "Asmodee")
                )
            )
        }
    }
