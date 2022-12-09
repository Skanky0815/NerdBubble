package me.ricoschulz.crawler.helper

import io.ktor.client.*
import io.ktor.client.call.*
import io.ktor.client.engine.*
import io.ktor.client.request.*

suspend fun fetch(engine: HttpClientEngine, uri: String): String =
    HttpClient(engine).get(uri).body()
