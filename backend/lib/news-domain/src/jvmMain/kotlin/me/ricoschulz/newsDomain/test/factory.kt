package me.ricoschulz.newsDomain.test

import io.github.serpro69.kfaker.Faker
import java.util.UUID
import me.ricoschulz.newsDomain.entity.Article
import me.ricoschulz.newsDomain.valueObject.Interest
import me.ricoschulz.newsDomain.valueObject.Product
import me.ricoschulz.newsDomain.valueObject.Provider

internal val faker = Faker()

fun fakeArticle(
    id: String? = null,
    provider: Provider? = null,
    title: String? = null,
    subTitle: String? = null,
    img: String? = null,
    link: String? = null,
    description: String? = null,
    date: String? = null,
    products: List<Product> = listOf(),
    tags: List<String> = listOf()
) =
    Article(
        id ?: UUID.randomUUID().toString(),
        provider ?: Provider.values().random(),
        title ?: faker.starWars.characters(),
        subTitle ?: faker.starWars.planets(),
        img ?: faker.internet.domain(),
        link ?: faker.internet.domain(),
        description ?: faker.lorem.supplemental(),
        date ?: "2022-12-02",
        products,
        tags
    )

fun fakeInterest(name: String? = null, keywords: List<String>? = null): Interest {
    val usedName = name ?: faker.company.name()
    return Interest(usedName, keywords ?: usedName.split(" "))
}
