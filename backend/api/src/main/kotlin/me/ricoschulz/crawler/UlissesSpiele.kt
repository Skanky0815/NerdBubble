package me.ricoschulz.crawler

import kotlinx.coroutines.DelicateCoroutinesApi
import kotlinx.coroutines.GlobalScope
import kotlinx.coroutines.async
import me.ricoschulz.helper.content
import me.ricoschulz.helper.date
import me.ricoschulz.helper.fetch
import me.ricoschulz.helper.image
import me.ricoschulz.helper.link
import me.ricoschulz.helper.newsForEach
import me.ricoschulz.helper.selectTags
import me.ricoschulz.valueObject.News
import me.ricoschulz.valueObject.Provider

@DelicateCoroutinesApi
suspend fun ulissesSpiele(callback: (News) -> Unit) =
    GlobalScope.async {
        val response: String = fetch("https://ulisses-spiele.de/news/")

        newsForEach(response, "article.post") {
            callback(
                News(
                    title = it.content(".entry-title"),
                    link = it.link(),
                    newsType = Provider.ULISSES_SPIELE,
                    img = it.image(),
                    date = date(it.content(".entry-meta-date"), "d. MMMM yyyy", "de"),
                    description = it.content(".entry-content p").trim(),
                    tags = selectTags(it, "Ulisses")
                )
            )
        }
    }
