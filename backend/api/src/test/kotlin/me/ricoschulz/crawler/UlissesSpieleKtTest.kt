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
internal class UlissesSpieleKtTest {

    @Test
    fun `when a valid response is given then a news object will be returned`() = runTest {
        mockkStatic(::fetch)
        coEvery { fetch(any()) } returns "ulissesSpiele_news_list.html".loadResource()

        ulissesSpiele {
                assertEquals(NewsType.ULISSES_SPIELE, it.newsType)
                assertEquals("Aventuria Stories und Legends", it.title)
                assertEquals(
                    "Heute mal ein kleinerer Artikel in eigener Sache: Es war ein gutes Stück Arbeit, aber international tut sich nun was – wir machen einen neuen großen englischen Aventuria Kickstarter!",
                    it.description
                )
                assertEquals("2022-11-10", it.date)
                assertEquals("https://ulisses-spiele.de/aventuria-stories-legends/", it.link)
                assertEquals(
                    "https://ulisses-spiele.de/wp-content/uploads/2022/11/01_Aventuria_Allgemein-256x143.webp",
                    it.img
                )
                assertNull(it.subTitle)
            }
            .await()
    }
}
