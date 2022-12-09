package me.ricoschulz.newsDomain.service

import me.ricoschulz.newsDomain.factory.AggregatorFactory
import me.ricoschulz.newsDomain.repository.Articles
import me.ricoschulz.newsDomain.repository.Interests

class Aggregator(
    private val fetcher: Fetcher,
    private val interests: Interests,
    private val articles: Articles,
) {
    fun aggregate() {
        val newArticles =
            fetcher.loadArticles(interests.all()).filter { !articles.hashExists(it.hash) }

        articles.addAll(newArticles)
    }

    companion object Factory : AggregatorFactory() {
        override fun build(fetcher: Fetcher, articles: Articles): Aggregator {
            return Aggregator(fetcher, Interests.build(), articles)
        }
    }
}
