package me.ricoschulz.newsDomain.entity

import java.util.UUID
import me.ricoschulz.newsDomain.valueObject.Product
import me.ricoschulz.newsDomain.valueObject.Provider

data class Article(
    val id: String = UUID.randomUUID().toString(),
    val provider: Provider,
    val title: String,
    val subTitle: String? = null,
    val img: String,
    val link: String,
    val description: String? = null,
    val date: String,
    val products: List<Product> = listOf(),
    val tags: List<String> = listOf()
) {
    val hash = UUID.nameUUIDFromBytes(title.toByteArray()).toString()
}
