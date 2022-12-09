package me.ricoschulz.helper

import me.ricoschulz.INTERESTS
import org.jsoup.nodes.Element

fun selectTags(content: String, tag: String) =
    INTERESTS
        .filter { interest -> interest.keywords.any { content.contains(it, ignoreCase = true) } }
        .map { it.name }
        .plus(tag)

fun selectTags(content: Element, tag: String) = selectTags(content.text(), tag)
