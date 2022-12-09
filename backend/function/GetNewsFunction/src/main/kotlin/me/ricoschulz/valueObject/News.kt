package me.ricoschulz.valueObject

import java.util.UUID
import kotlinx.serialization.Serializable

@Serializable
data class News(
    val id: String = UUID.randomUUID().toString(),
    val newsType: Provider,
    val title: String,
    val subTitle: String? = null,
    val img: String,
    val link: String,
    val description: String? = null,
    val date: String,
    val products: List<Product> = listOf(),
    val tags: List<String> = listOf()
)
