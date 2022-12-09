package me.ricoschulz

import io.ktor.http.*
import io.ktor.serialization.kotlinx.json.*
import io.ktor.server.application.*
import io.ktor.server.engine.*
import io.ktor.server.netty.*
import io.ktor.server.plugins.contentnegotiation.*
import io.ktor.server.plugins.cors.routing.*
import kotlinx.serialization.decodeFromString
import me.ricoschulz.helper.json
import me.ricoschulz.plugins.configureNews
import me.ricoschulz.plugins.configureRouting
import me.ricoschulz.valueObject.Interest

val INTERESTS = json.decodeFromString<List<Interest>>("interests.json".loadResource())

fun main() {
    embeddedServer(Netty, port = 8080, host = "0.0.0.0", module = Application::module)
        .start(wait = true)
}

fun Application.module() {
    install(CORS) {
        allowHost("localhost:57017")
        allowHost("localhost:3000")
        allowHeader(HttpHeaders.ContentType)
    }
    install(ContentNegotiation) { json() }
    configureRouting()
    configureNews()
}
