package me.ricoschulz.newsDomain.service

class ResourcesLoader {
    fun load(fileName: String) = javaClass.classLoader.getResource(fileName).readText()
}
