package me.ricoschulz

import kotlin.test.Test
import kotlin.test.assertEquals

class AppTest {
    @Test
    fun appHasAGreeting() {
        val app = App()
        val result = app.handleRequest(null, null)

        assertEquals("okay", result)
    }
}
