package me.ricoschulz.helper

import kotlin.test.Test
import kotlin.test.assertFalse
import kotlin.test.assertTrue

internal class StringKeywordCheckKtTest {

    @Test
    fun `when string contains keywords then true will return`() {
        assertTrue("Foo Star Wars Bar".hasKeyword())
    }

    @Test
    fun `when string contains a complete keyword then false will return`() {
        assertFalse("Foo Star Bar".hasKeyword())
    }
}
