package me.ricoschulz.crawler.helper

import me.ricoschulz.newsDomain.valueObject.Interest
import org.jsoup.nodes.Element

fun selectTags(interests: List<Interest>, content: String, tag: String) =
    interests
        .filter { interest -> interest.keywords.any { content.contains(it, ignoreCase = true) } }
        .map { it.name }
        .plus(tag)

fun selectTags(interests: List<Interest>, content: Element, tag: String) =
    selectTags(interests, content.text(), tag)
