package me.ricoschulz.value.`object`

import kotlin.test.Test
import kotlin.test.assertEquals
import me.ricoschulz.valueObject.Product
import me.ricoschulz.valueObject.allNames

internal fun Product.Companion.make(name: String): Product =
    Product(name = name, img = "", link = "")

internal class ProductListKtTest {

    @Test
    fun `allNames should join all product names into one string`() {
        val list: List<Product> = listOf(Product.make("foo"), Product.make("bar"))

        assertEquals("foo bar", list.allNames())
    }
}
