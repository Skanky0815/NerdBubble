package me.ricoschulz.crawler.helper

import io.ktor.client.engine.mock.*
import io.ktor.http.*
import io.ktor.utils.io.*
import kotlin.test.Test
import kotlin.test.assertEquals
import kotlinx.coroutines.ExperimentalCoroutinesApi
import kotlinx.coroutines.test.runTest

@ExperimentalCoroutinesApi
internal class HttpFetcherKtTest {

    @Test
    fun `when the call is successful then the content will returned`() = runTest {
        val mockEngin = MockEngine { request ->
            respond(content = ByteReadChannel("""Hello World"""), status = HttpStatusCode.OK)
        }

        assertEquals("Hello World", fetch(mockEngin, "www.my-url.org"))
    }
}
