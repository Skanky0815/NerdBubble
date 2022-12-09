package me.ricoschulz.newsDomain.valueObject

import kotlin.test.Test
import kotlin.test.assertEquals

internal class ProductListKtTest {

    @Test
    fun `allNames should join all product names into one string`() {
        val list: List<Product> = listOf(makeProduct("foo"), makeProduct("bar"))

        assertEquals("foo bar", list.allNames())
    }

    private fun makeProduct(name: String) = Product(name = name, img = "", link = "")
}
