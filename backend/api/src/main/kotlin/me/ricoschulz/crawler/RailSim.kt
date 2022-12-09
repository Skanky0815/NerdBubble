package me.ricoschulz.crawler

import kotlinx.coroutines.DelicateCoroutinesApi
import kotlinx.coroutines.GlobalScope
import kotlinx.coroutines.async
import me.ricoschulz.helper.content
import me.ricoschulz.helper.date
import me.ricoschulz.helper.fetch
import me.ricoschulz.helper.link
import me.ricoschulz.helper.newsForEach
import me.ricoschulz.valueObject.News
import me.ricoschulz.valueObject.Provider

@DelicateCoroutinesApi
suspend fun railSim(callback: (News) -> Unit) =
    GlobalScope.async {
        val response: String = fetch("https://rail-sim.de/forum/wcf/")

        newsForEach(response, "section.box:eq(1) ol.wbbThread", take = 6, hasFilter = false) {
            try {
                callback(
                    News(
                        newsType = Provider.RAIL_SIM,
                        title = it.content("h3 a"),
                        link = it.link("h3 a"),
                        date =
                            date(it.select(".messageGroupLastPostTimeMobile time").attr("data-date"), "d. MMMM yyyy", "de"),
                        img = "https://rail-sim.de/forum/wcf/images/style-12/pageLogo-c61b728c.png",
                        tags = listOf("TSW3")
                    )
                )
            } catch (e: Throwable) {
                println("%s: %s \n %s".format(Provider.RAIL_SIM, e.message, it))
            }
        }
    }
