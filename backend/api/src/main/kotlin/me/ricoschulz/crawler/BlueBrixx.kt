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
suspend fun blueBrixx(callback: (News) -> Unit) =
    GlobalScope.async {
        val response: String = fetch("https://www.bluebrixx.com/de/neuheiten?limit=32")

        val products = newsMap(response, ".category") { it.toProduct(".searchItemTitle") }

        if (products.isNotEmpty()) {
            callback(
                News(
                    title = "BlueBrixx",
                    newsType = Provider.BLUE_BRIXX,
                    img = "https://www.bluebrixx.com/img/new_design/logo_mitSteinen-min.png",
                    date = LocalDate.now().toString(),
                    link = "https://www.bluebrixx.com/de/neuheiten?limit=32",
                    products = products,
                    tags = selectTags(products.allNames(), "BlueBrixx")
                )
            )
        }
    }
