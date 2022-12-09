package me.ricoschulz.crawler

import io.mockk.coEvery
import io.mockk.mockkStatic
import kotlin.test.Test
import kotlin.test.assertEquals
import kotlin.test.assertNull
import kotlinx.coroutines.ExperimentalCoroutinesApi
import kotlinx.coroutines.test.runTest
import me.ricoschulz.helper.fetch
import me.ricoschulz.loadResource
import me.ricoschulz.valueObject.NewsType

@ExperimentalCoroutinesApi
internal class AsmodeeKtTest {

    @Test
    fun `when a valid response is given then a news object with products will be returned`() =
        runTest {
            mockkStatic(::fetch)
            coEvery { fetch("https://www.asmodee.de") } returns
                "<html><script src=\"/_next/static/7tXb0PpAu7QfRz2jnvnIo/_buildManifest.js\"</html>"
            coEvery {
                fetch(eq("https://www.asmodee.de/_next/data/7tXb0PpAu7QfRz2jnvnIo/news.json"))
            } returns "asmodee_news_list_with_products.json".loadResource()

            asmodee {
                    assertEquals(NewsType.ASMODEE, it.newsType)
                    assertEquals("2022-10-26", it.date)
                    assertEquals("Lila Laster", it.title)
                    assertEquals("Neue Spiele sind auf dem Weg", it.subTitle)
                    assertEquals(
                        "https://assets.svc.asmodee.net/production-asmodeede/null/small_Lila_Laster_0cfe16d145.png",
                        it.img
                    )
                    assertEquals(
                        "https://www.asmodee.de/news/neue-spiele-sind-auf-dem-weg-67",
                        it.link
                    )
                    val product = it.products.first()
                    assertEquals(
                        "Der Herr der Ringe: Das Kartenspiel – Die Gefährten",
                        product.name
                    )
                    assertEquals(
                        "https://www.asmodee.de/produkte/der-herr-der-ringe-das-kartenspiel-die-gefaehrten",
                        product.link
                    )
                    assertEquals(
                        "https://retail.asmodee.de/media/catalog/product/d/e/der-herr-der-ringe-lcg-die-gefaehrten-841333117900-3dboxl-web.png",
                        product.img
                    )
                    // assertEquals("Asmodee", it.tags.first())
                    assertNull(it.description)
                }
                .await()
        }
}
