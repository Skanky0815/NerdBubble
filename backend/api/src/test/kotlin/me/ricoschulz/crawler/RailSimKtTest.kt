package me.ricoschulz.crawler

import io.mockk.coEvery
import io.mockk.mockkStatic
import kotlin.test.Test
import kotlin.test.assertEquals
import kotlin.test.assertNull
import kotlin.test.assertTrue
import kotlinx.coroutines.ExperimentalCoroutinesApi
import kotlinx.coroutines.test.runTest
import me.ricoschulz.helper.fetch
import me.ricoschulz.loadResource
import me.ricoschulz.valueObject.NewsType

@ExperimentalCoroutinesApi
internal class RailSimKtTest {

    @Test
    fun `when a valid response is given then a news object with products will be returned`() =
        runTest {
            mockkStatic(::fetch)
            coEvery { fetch(any()) } returns "railSim_news.html".loadResource()

            railSim {
                    assertEquals(NewsType.RAIL_SIM, it.newsType)
                    assertEquals(
                        "Justus-Soundmod Projekte. TSW2 Projekt Liste erster Beitrag Seite 1",
                        it.title
                    )
                    assertEquals("2022-11-12", it.date)
                    assertEquals(
                        "https://rail-sim.de/forum/wcf/images/style-12/pageLogo-c61b728c.png",
                        it.img
                    )
                    assertEquals(
                        "https://rail-sim.de/forum/thread/36695-justus-soundmod-projekte-tsw2-projekt-liste-erster-beitrag-seite-1/",
                        it.link
                    )
                    assertTrue(it.products.isEmpty())
                    assertNull(it.description)
                    assertNull(it.subTitle)
                    assertEquals("TSW3", it.tags.first())
                }
                .await()
        }
}
