package me.ricoschulz.ffgCrawler.service

import io.ktor.client.engine.cio.*
import kotlinx.coroutines.runBlocking
import me.ricoschulz.crawler.helper.content
import me.ricoschulz.crawler.helper.date
import me.ricoschulz.crawler.helper.fetch
import me.ricoschulz.crawler.helper.image
import me.ricoschulz.crawler.helper.link
import me.ricoschulz.crawler.helper.newsMap
import me.ricoschulz.crawler.helper.selectTags
import me.ricoschulz.newsDomain.entity.Article
import me.ricoschulz.newsDomain.service.Fetcher
import me.ricoschulz.newsDomain.valueObject.Interest
import me.ricoschulz.newsDomain.valueObject.Provider

class WebFetcher : Fetcher {
    override fun loadArticles(allInterests: List<Interest>) =
        newsMap(loadHtml(), ".blog-item") {
            Article(
                title = it.content(".blog-lead"),
                subTitle = it.content(".meta-productline"),
                link = "https://www.fantasyflightgames.com/${it.link(".blog-img a")}",
                provider = Provider.FANTASY_FLIGHT_GAMES,
                img = it.image(),
                date = date(it.content(".meta-date"), "d MMMM yyyy", "en"),
                tags = selectTags(allInterests, it, "Fantasy Flight Games")
            )
        }

    private fun loadHtml() = runBlocking {
        fetch(CIO.create(), "https://www.fantasyflightgames.com/en/news/?page=1")
    }
}
