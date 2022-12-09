package me.ricoschulz.newsDomain.service

import kotlin.test.Test
import kotlin.test.assertEquals

internal class ResourcesLoaderTest {

    @Test
    fun `when file is found then the content will returned as string`() {
        val resourcesLoader = ResourcesLoader()

        assertEquals("Hello World!", resourcesLoader.load("test.txt"))
    }
}
