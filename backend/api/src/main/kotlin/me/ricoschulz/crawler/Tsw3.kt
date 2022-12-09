package me.ricoschulz.crawler

import kotlinx.coroutines.DelicateCoroutinesApi
import kotlinx.coroutines.GlobalScope
import kotlinx.coroutines.async
import kotlinx.serialization.Serializable
import kotlinx.serialization.decodeFromString
import me.ricoschulz.helper.date
import me.ricoschulz.helper.fetch
import me.ricoschulz.helper.json
import me.ricoschulz.valueObject.News
import me.ricoschulz.valueObject.Provider

@Serializable
internal data class ImagesDto(
    val thumbWide: String? = null,
    val thumbSqr: String? = null,
    val ghostFeatured: String? = null
)

@Serializable
internal data class ItemDto(
    val title: String,
    val date: String,
    val images: ImagesDto,
    val excerpt: String? = null,
    val slug: String
)

@Serializable internal data class PostDto(val items: List<ItemDto>)

@Serializable
internal data class Tsw3ResponseDto(val posts: PostDto) {
    fun itemsForEach(take: Int, callback: (ItemDto) -> Unit) {
        posts.items.take(take).forEach(callback)
    }
}

@DelicateCoroutinesApi
suspend fun tsw3(callback: (News) -> Unit) =
    GlobalScope.async {
        val response: String =
            fetch("https://cms.dovetailgames.com/api/v1/ghost/hub/tsw/web?limit=24&page=1")

        fun selectImage(img: ImagesDto) =
            img.thumbSqr ?: img.thumbWide ?: img.ghostFeatured ?: throw Throwable("missing image")

        json.decodeFromString<Tsw3ResponseDto>(response).itemsForEach(4) {
            callback(
                News(
                    title = it.title,
                    img = selectImage(it.images),
                    link =
                        "https://live.dovetailgames.com/live/train-sim-world/articles/article/${it.slug}",
                    newsType = Provider.TSW3,
                    date = date(it.date, "yyyy-MM-dd'T'HH:mm:ss.SSS'Z'", "en"),
                    description = it.excerpt,
                    tags = listOf("TSW3"),
                )
            )
        }
    }
