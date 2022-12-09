package me.ricoschulz.crawler.helper

import kotlin.test.Test
import kotlin.test.assertEquals

internal class DateFormatterKtTest {

    @Test
    fun `date should convert dateformat`() {
        assertEquals("2022-11-11", date("11 November 2022", "d MMMM yyyy", "en"))
    }
}
