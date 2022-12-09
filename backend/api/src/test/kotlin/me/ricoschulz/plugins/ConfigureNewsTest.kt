package me.ricoschulz.plugins

import io.ktor.client.plugins.websocket.*
import io.ktor.client.request.*
import io.ktor.server.testing.*

class ConfigureNewsTest {

    fun testGetNews() = testApplication {
        application { configureNews() }
        client.get("/news").apply { TODO("Please write your test here") }
    }
}
