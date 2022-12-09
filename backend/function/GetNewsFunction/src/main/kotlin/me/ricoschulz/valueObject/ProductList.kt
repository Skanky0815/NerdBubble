package me.ricoschulz.valueObject

fun List<Product>.allNames() = joinToString(" ") { it.name }
