package me.ricoschulz.newsDomain.service

import io.mockk.every
import io.mockk.impl.annotations.InjectMockKs
import io.mockk.impl.annotations.MockK
import io.mockk.junit5.MockKExtension
import io.mockk.justRun
import io.mockk.slot
import kotlin.test.Test
import kotlin.test.assertEquals
import kotlin.test.assertTrue
import me.ricoschulz.newsDomain.entity.Article
import me.ricoschulz.newsDomain.repository.Articles
import me.ricoschulz.newsDomain.repository.Interests
import me.ricoschulz.newsDomain.test.fakeArticle
import me.ricoschulz.newsDomain.test.fakeInterest
import org.junit.jupiter.api.extension.ExtendWith

@ExtendWith(MockKExtension::class)
internal class AggregatorTest {

    @MockK lateinit var fetcher: Fetcher
    @MockK lateinit var articles: Articles
    @MockK lateinit var interests: Interests

    @InjectMockKs lateinit var aggregator: Aggregator

    @Test
    fun `when a new article is loaded then the new article will be added in the repository`() {
        val allInterest = listOf(fakeInterest())
        val article = fakeArticle()
        val allArticleSlot = slot<List<Article>>()

        every { fetcher.loadArticles(allInterest) } returns listOf(article)
        every { interests.all() } returns allInterest
        every { articles.hashExists(article.hash) } returns false
        justRun { articles.addAll(capture(allArticleSlot)) }

        aggregator.aggregate()

        assertEquals(article, allArticleSlot.captured.first())
    }

    @Test
    fun `when a existing article is loaded then the nothing is added to the articles`() {
        val allInterest = listOf(fakeInterest())
        val article = fakeArticle()
        val allArticleSlot = slot<List<Article>>()

        every { fetcher.loadArticles(allInterest) } returns listOf(article)
        every { interests.all() } returns allInterest
        every { articles.hashExists(article.hash) } returns true
        justRun { articles.addAll(capture(allArticleSlot)) }

        aggregator.aggregate()

        assertTrue(allArticleSlot.captured.isEmpty())
    }
}
