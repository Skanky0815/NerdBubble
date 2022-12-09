package me.ricoschulz.newsDomain.repository

import me.ricoschulz.newsDomain.entity.Article

interface Articles {
    fun hashExists(hash: String): Boolean
    fun addAll(newArticle: List<Article>)
    fun all(): List<Article>
}
