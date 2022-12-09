package me.ricoschulz.ffgCrawler

import com.azure.cosmos.ConsistencyLevel
import com.azure.cosmos.CosmosClientBuilder
import com.microsoft.azure.functions.ExecutionContext
import com.microsoft.azure.functions.annotation.*
import java.time.LocalDateTime
import java.util.logging.Level
import me.ricoschulz.ffgCrawler.repository.ArticleRepository
import me.ricoschulz.ffgCrawler.service.WebFetcher
import me.ricoschulz.newsDomain.service.Aggregator

class CrawlerFunction {

    @FunctionName("FFGCrawler")
    fun run(
        @TimerTrigger(name = "timerInfo", schedule = "0 */5 * * * *") timerInfo: String?,
        context: ExecutionContext
    ) {
        val dbClient =
            CosmosClientBuilder()
                .endpoint("https://nerd-news-db.documents.azure.com:443/")
                .key("cLoHbF3MlX5IJ0jsOfb3DLIK8jSAZHCeUYJJgkdPi6dsq9k8kDiydXCPbQdLJRa7EZt7dWsDqeRHACDbf0314w==")
                .preferredRegions(listOf("West Europe"))
                .userAgentSuffix("FFGCrawler")
                .consistencyLevel(ConsistencyLevel.EVENTUAL)
                .buildClient()

        val articles = ArticleRepository(dbClient)
        val fetcher = WebFetcher()
        val aggregator = Aggregator.build(fetcher, articles)

        try {
            aggregator.aggregate()
            context.logger.log(
                Level.INFO,
                "Timer trigger function executed at: ${LocalDateTime.now()}"
            )
        } catch (e: Throwable) {
            context.logger.log(Level.WARNING, "${e.message}")
        }
    }
}
