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
suspend fun fantasyFlightGames(callback: (News) -> Unit) =
    GlobalScope.async {
        val response: String = fetch("https://www.fantasyflightgames.com/en/news/?page=1")

        newsForEach(response, ".blog-item") {
            callback(
                News(
                    title = it.content(".blog-lead"),
                    subTitle = it.content(".meta-productline"),
                    link = "https://www.fantasyflightgames.com/${it.link(".blog-img a")}",
                    newsType = Provider.FANTASY_FLIGHT_GAMES,
                    img = it.image(),
                    date = date(it.content(".meta-date"), "d MMMM yyyy", "en"),
                    tags = selectTags(it, "Fantasy Flight Games")
                )
            )
        }
    }
