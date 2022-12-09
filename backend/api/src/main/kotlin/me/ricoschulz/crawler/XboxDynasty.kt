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
import me.ricoschulz.valueObject.News
import me.ricoschulz.valueObject.Provider

@DelicateCoroutinesApi
suspend fun xboxDynasty(callback: (News) -> Unit) =
    GlobalScope.async {
        val response: String = fetch("https://www.xboxdynasty.de/game/xbox-game-pass/")

        newsForEach(response, ".post", 4, false) {
            callback(
                News(
                    title = it.content(".entry-title").replace("Xbox Game Pass: ", ""),
                    img = it.image(),
                    date = date(it.content(".entry-date"), "d. MMMM yyyy", "de"),
                    tags = listOf("Xbox"),
                    link = it.link(),
                    newsType = Provider.XBOX_DYNASTY,
                )
            )
        }
    }
