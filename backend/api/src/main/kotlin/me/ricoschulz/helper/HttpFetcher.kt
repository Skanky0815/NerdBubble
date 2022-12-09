package me.ricoschulz.helper

import io.ktor.client.*
import io.ktor.client.call.*
import io.ktor.client.engine.cio.*
import io.ktor.client.request.*

suspend fun fetch(uri: String): String = HttpClient(CIO).get(uri).body()
