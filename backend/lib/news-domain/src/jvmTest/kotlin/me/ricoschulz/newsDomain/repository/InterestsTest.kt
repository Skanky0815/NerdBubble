package me.ricoschulz.newsDomain.repository

import io.mockk.every
import io.mockk.impl.annotations.InjectMockKs
import io.mockk.impl.annotations.MockK
import io.mockk.junit5.MockKExtension
import kotlin.test.Test
import kotlin.test.assertEquals
import me.ricoschulz.newsDomain.service.ResourcesLoader
import org.junit.jupiter.api.extension.ExtendWith

@ExtendWith(MockKExtension::class)
internal class InterestsTest {

    @MockK lateinit var resourcesLoader: ResourcesLoader

    @InjectMockKs lateinit var interests: Interests

    @Test
    fun `when then`() {
        every { resourcesLoader.load("interests.json") } returns
            """[{"name": "FooBar", "keywords": ["foo", "bar"]}]"""

        val allInterests = interests.all()

        assertEquals(1, allInterests.size)

        val interest = allInterests.first()
        assertEquals("FooBar", interest.name)
        assertEquals(listOf("foo", "bar"), interest.keywords)
    }
}
