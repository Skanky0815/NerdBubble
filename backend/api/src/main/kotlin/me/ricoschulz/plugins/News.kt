package me.ricoschulz.plugins

import io.ktor.server.application.*
import io.ktor.server.response.*
import io.ktor.server.routing.*
import kotlinx.coroutines.Deferred
import kotlinx.coroutines.DelicateCoroutinesApi
import kotlinx.coroutines.awaitAll
import me.ricoschulz.valueObject.News
import me.ricoschulz.valueObject.NewsResponse
import me.ricoschulz.valueObject.Provider

internal fun MutableList<News>.prepareForResponse(): List<String> {
    this.shuffle()
    this.sortByDescending { it.date }
    return this.map { it.tags }.flatten().distinct().sorted()
}

@DelicateCoroutinesApi
fun Application.configureNews() {
    routing {
        get("/news") {
            val allNews = mutableListOf<News>()
            val requests = mutableListOf<Deferred<Unit>>()

            Provider.values().forEach { requests.add(it.crawler(allNews::add)) }

            requests.awaitAll()

            val allTags = allNews.prepareForResponse()

            call.respond(NewsResponse(allNews, allTags))
        }
    }
}
