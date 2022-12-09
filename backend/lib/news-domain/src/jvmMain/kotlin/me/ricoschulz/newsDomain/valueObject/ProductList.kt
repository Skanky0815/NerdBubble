package me.ricoschulz.newsDomain.valueObject

fun List<Product>.allNames() = joinToString(" ") { it.name }
