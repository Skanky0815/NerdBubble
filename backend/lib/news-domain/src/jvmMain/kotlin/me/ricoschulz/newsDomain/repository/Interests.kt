package me.ricoschulz.newsDomain.repository

import kotlinx.serialization.decodeFromString
import kotlinx.serialization.json.Json
import me.ricoschulz.newsDomain.factory.InterestsFactory
import me.ricoschulz.newsDomain.service.ResourcesLoader
import me.ricoschulz.newsDomain.valueObject.Interest

class Interests(private val resourcesLoader: ResourcesLoader) {
    fun all(): List<Interest> = Json.decodeFromString(resourcesLoader.load("interests.json"))

    companion object Factory : InterestsFactory() {
        override fun build(): Interests = Interests(ResourcesLoader())
    }
}
