package me.ricoschulz.crawler.helper

import java.time.LocalDate
import java.time.format.DateTimeFormatter
import java.util.*

fun date(dateString: String, pattern: String, language: String) =
    LocalDate.parse(dateString, DateTimeFormatter.ofPattern(pattern, Locale(language))).toString()
