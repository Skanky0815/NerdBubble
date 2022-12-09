package me.ricoschulz.crawler

import me.ricoschulz.valueObject.News

val dndWizard: (String, (News) -> Unit) -> Unit = { response, callback -> println(response) }
