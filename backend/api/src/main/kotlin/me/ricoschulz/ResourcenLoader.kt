package me.ricoschulz

fun String.loadResource() = {}.javaClass.classLoader.getResource(this).readText()
