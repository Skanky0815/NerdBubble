package me.ricoschulz.newsDomain.factory

import me.ricoschulz.newsDomain.repository.Articles
import me.ricoschulz.newsDomain.service.Aggregator
import me.ricoschulz.newsDomain.service.Fetcher

abstract class AggregatorFactory {
    abstract fun build(fetcher: Fetcher, articles: Articles): Aggregator
}
