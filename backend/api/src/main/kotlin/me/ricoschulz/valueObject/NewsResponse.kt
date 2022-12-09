package me.ricoschulz.valueObject

import kotlinx.serialization.Serializable

@Serializable
data class NewsResponse(
    val news: List<News>,
    val tags: List<String>,
)
