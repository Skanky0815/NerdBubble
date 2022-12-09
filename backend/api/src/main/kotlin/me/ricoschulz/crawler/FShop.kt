package me.ricoschulz.crawler

import java.time.LocalDate
import kotlinx.coroutines.DelicateCoroutinesApi
import kotlinx.coroutines.GlobalScope
import kotlinx.coroutines.async
import me.ricoschulz.helper.fetch
import me.ricoschulz.helper.newsMap
import me.ricoschulz.helper.selectTags
import me.ricoschulz.helper.toProduct
import me.ricoschulz.valueObject.News
import me.ricoschulz.valueObject.Provider
import me.ricoschulz.valueObject.allNames

@DelicateCoroutinesApi
suspend fun fShop(callback: (News) -> Unit) =
    GlobalScope.async {
        val response: String = fetch("https://www.f-shop.de/neuheiten/")

        val products =
            newsMap(response, ".product--info", 4) { it.toProduct(".product--title", "srcset") }

        if (products.isNotEmpty()) {
            callback(
                News(
                    title = "F-Shop",
                    link = "https://www.f-shop.de/neuheiten/",
                    newsType = Provider.F_SHOP,
                    img = "https://www.f-shop.de/media/image/37/53/7c/logo_website_F_Shop_2.png",
                    date = LocalDate.now().toString(),
                    products = products,
                    tags = selectTags(products.allNames(), "Ulisses"),
                )
            )
        }
    }
