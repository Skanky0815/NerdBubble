package me.ricoschulz.helper

import kotlinx.serialization.json.Json
import me.ricoschulz.valueObject.Product
import org.jsoup.Jsoup
import org.jsoup.nodes.Element

val json = Json { ignoreUnknownKeys = true }

fun <T> newsMap(
    response: String,
    query: String,
    take: Int = 10,
    hasFilter: Boolean = true,
    callback: (Element) -> T
) = newsFromResponse(response, query, take, hasFilter).map(callback)

fun newsForEach(
    response: String,
    query: String,
    take: Int = 10,
    hasFilter: Boolean = true,
    callback: (Element) -> Unit
) = newsFromResponse(response, query, take, hasFilter).forEach(callback)

private fun newsFromResponse(response: String, query: String, take: Int, hasFilter: Boolean) =
    Jsoup.parse(response)
        .select(query)
        .toList()
        .filter { if (hasFilter) it.text().hasKeyword() else true }
        .take(take)

fun Element.image(query: String = "img", attr: String = "src"): String =
    this.select(query).attr(attr)

fun Element.link(query: String = "a"): String = this.select(query).attr("href")

fun Element.content(query: String): String = this.select(query).text()

fun Element.toProduct(titleQuery: String, imgAttr: String = "src") =
    Product(name = this.content(titleQuery), img = this.image(attr = imgAttr), link = this.link())
