package me.ricoschulz.valueObject

import kotlinx.serialization.Serializable

@Serializable data class Interest(val name: String, val keywords: List<String>)
