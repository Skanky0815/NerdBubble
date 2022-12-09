package me.ricoschulz.newsDomain.valueObject

import java.util.*

data class Product(
    val name: String,
    val img: String,
    val link: String,
) {
    val hash = UUID.nameUUIDFromBytes(name.toByteArray()).toString()
}
