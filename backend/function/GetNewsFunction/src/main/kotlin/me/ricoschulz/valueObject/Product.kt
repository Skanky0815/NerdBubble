package me.ricoschulz.valueObject

import java.util.*
import kotlinx.serialization.Serializable

@Serializable
data class Product(
    val id: String = UUID.randomUUID().toString(),
    val name: String,
    val img: String,
    val link: String,
)
