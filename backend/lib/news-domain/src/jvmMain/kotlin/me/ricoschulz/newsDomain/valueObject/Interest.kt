package me.ricoschulz.newsDomain.valueObject

import kotlinx.serialization.Serializable

@Serializable data class Interest(val name: String, val keywords: List<String>)
