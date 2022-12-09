package me.ricoschulz.crawler.helper

fun String.hasKeyword() =
    listOf(
            "star wars",
            "der herr der ringe",
            "the lord of the rings",
            "aventuria",
            "das schwarze auge",
            "dsa5",
            "star trek",
        )
        .any { this.contains(it, ignoreCase = true) }
