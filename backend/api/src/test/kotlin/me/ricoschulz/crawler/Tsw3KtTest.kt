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
internal class Tsw3KtTest {

    @Test
    fun `when a valid response is given then a news object will be returned`() = runTest {
        mockkStatic(::fetch)
        coEvery { fetch(any()) } returns "tsw3_news_list.json".loadResource()

        tsw3 {
                assertEquals(NewsType.TSW3, it.newsType)
                assertEquals("2022-11-08", it.date)
                assertEquals(
                    "Birmingham Cross-City: Timetable Deep Dive | Pre-Order | Release Day Update",
                    it.title
                )
                assertEquals(
                    "In this article we shall be taking you through all the fun nuances and layers you can look forward to in the Cross-City timetable!",
                    it.description
                )
                assertEquals(
                    "https://media-cdn.dovetailgames.com/2022/112022/11/XCTTA_01.jpg",
                    it.img
                )
                assertEquals(
                    "https://live.dovetailgames.com/live/train-sim-world/articles/article/cross-city-timetable-deep-dive",
                    it.link
                )
                assertEquals("TSW3", it.tags.first())
                assertTrue(it.products.isEmpty())
                assertNull(it.subTitle)
            }
            .await()
    }
}
