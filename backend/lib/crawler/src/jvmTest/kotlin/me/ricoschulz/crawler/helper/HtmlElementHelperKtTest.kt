package me.ricoschulz.crawler.helper

import kotlin.test.Test
import kotlin.test.assertEquals
import org.jsoup.Jsoup

internal class HtmlElementHelperKtTest {

    @Test
    fun `when filter is active then only the filtered elements are mapped to the list`() {
        val html =
            """
            <div>
                <div>not in list</div>
                <div>Star Wars</div>
                <div>not in list</div>
            </div>
            """.trimIndent()

        val elementList =
            newsMap(
                html,
                "div > div",
            ) { it.text() }

        assertEquals("Star Wars", elementList[0])
    }

    @Test
    fun `when take not set then ten elements are mapped to the list`() {
        val html =
            """
            <div>
                <div>1</div>
                <div>2</div>
                <div>3</div>
                <div>4</div>
                <div>5</div>
                <div>6</div>
                <div>7</div>
                <div>8</div>
                <div>9</div>
                <div>10</div>
                <div>not in list</div>
                <div>not in list</div>
            </div>
            """.trimIndent()

        val elementList = newsMap(html, "div > div", hasFilter = false) { it.text() }

        assertEquals(10, elementList.size)
    }

    @Test
    fun `when take is set to 2 then two elements are mapped to the list`() {
        val html =
            """
            <div>
                <div>Foo</div>
                <div>Bar</div>
                <div>Not found</div>
            </div>
            """.trimIndent()

        val elementList = newsMap(html, "div > div", 2, false) { it.text() }

        assertEquals("Foo", elementList[0])
        assertEquals("Bar", elementList[1])
    }

    @Test
    fun `when filter is active then only the filtered elements are looped`() {
        val html =
            """
            <div>
                <div>not in list</div>
                <div>Star Wars</div>
                <div>not in list</div>
            </div>
            """.trimIndent()

        newsForEach(html, "div > div") { assertEquals("Star Wars", it.text()) }
    }

    @Test
    fun `when take not set then ten elements are looped`() {
        val html =
            """
            <div>
                <div>1</div>
                <div>2</div>
                <div>3</div>
                <div>4</div>
                <div>5</div>
                <div>6</div>
                <div>7</div>
                <div>8</div>
                <div>9</div>
                <div>10</div>
                <div>not in list</div>
                <div>not in list</div>
            </div>
            """.trimIndent()

        var str = ""
        newsForEach(html, "div > div", hasFilter = false) { str += it.text() }

        assertEquals("12345678910", str)
    }

    @Test
    fun `when take is set to 2 then two elements are looped`() {
        val html =
            """
            <div>
                <div>Foo</div>
                <div>Bar</div>
                <div>Not found</div>
            </div>
            """.trimIndent()

        var str = ""
        newsForEach(html, "div > div", 2, false) { str += it.text() }

        assertEquals("FooBar", str)
    }

    @Test
    fun `when html element has a link then the href will returned`() {
        val element =
            makeElement(
                """
                <div>
                    <a href='my.url.test'>Text</a>
                </div>
                """.trimIndent()
            )

        assertEquals("my.url.test", element.link())
    }

    @Test
    fun `when html element match query then the href will returned`() {
        val element =
            makeElement(
                """
                <div>
                    <div></div>
                    <div id='my-link'>
                        <a href='my.url.test'>Text</a>
                    </div>
                </div>
                """.trimIndent()
            )

        assertEquals("my.url.test", element.link("#my-link a"))
    }

    @Test
    fun `when html element has text then the text will returned`() {
        val element =
            makeElement(
                """
                <div>
                    <h1>My test Text.</h1>
                    <p>Should not found!</<p>
                </div>
                """.trimIndent()
            )

        assertEquals("My test Text.", element.content("h1"))
    }

    @Test
    fun `when element has a image then the src will returned`() {
        val element =
            makeElement(
                """
                <div>
                    <img src="my.image.url" />
                </div>
                """.trimIndent()
            )

        assertEquals("my.image.url", element.image())
    }

    @Test
    fun `when element from query has a image then the src will returned`() {
        val element =
            makeElement(
                """
                <div>
                    <img src="wrong.url" />
                    <img id="should-found" src="my.image.url" />
                </div>
                """.trimIndent()
            )

        assertEquals("my.image.url", element.image("#should-found"))
    }

    @Test
    fun `when element contains all needed information for a product a product instance is returned`() {
        val element =
            makeElement(
                """
                <div>
                    <h1>Product Name</h1>
                    <img src="product.image.url" />
                    <a href="product.url">Product Link</a>
                </div>
                """.trimIndent()
            )

        val product = element.toProduct("h1")

        assertEquals("Product Name", product.name)
        assertEquals("product.image.url", product.img)
        assertEquals("product.url", product.link)
    }

    private fun makeElement(html: String) = Jsoup.parse(html).allElements.first()!!
}
