package me.ricoschulz.newsDomain.service

import me.ricoschulz.newsDomain.entity.Article
import me.ricoschulz.newsDomain.valueObject.Interest

interface Fetcher {
    fun loadArticles(allInterests: List<Interest>): List<Article>
}
