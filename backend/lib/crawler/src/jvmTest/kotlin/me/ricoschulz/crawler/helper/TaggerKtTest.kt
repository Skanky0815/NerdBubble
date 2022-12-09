package me.ricoschulz.crawler.helper

import io.mockk.confirmVerified
import io.mockk.every
import io.mockk.mockk
import io.mockk.verify
import kotlin.test.Test
import kotlin.test.assertEquals
import me.ricoschulz.newsDomain.valueObject.Interest
import org.jsoup.nodes.Element

internal class TaggerKtTest {

    @Test
    fun `when keyword is in string then tag the will added to the list`() {
        val interests = listOf(Interest("foo", listOf("keyword")))

        assertEquals(listOf("foo", "bar"), selectTags(interests, "das keyword", "bar"))
    }

    @Test
    fun `when keyword is not in string then the tag will added to the list`() {
        val interests = listOf(Interest("foo", listOf("not")))

        assertEquals(listOf("bar"), selectTags(interests, "das keyword", "bar"))
    }

    @Test
    fun `when one keyword is in string then the tag will added to the list`() {
        val interests = listOf(Interest("foo", listOf("not", "keyword")))
        val element = mockk<Element>()

        every { element.text() } returns "das keyword"

        assertEquals(listOf("foo", "bar"), selectTags(interests, element, "bar"))

        verify { element.text() }

        confirmVerified(element)
    }
}
