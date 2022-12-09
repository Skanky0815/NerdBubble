package me.ricoschulz.ffgCrawler.repository

import com.azure.cosmos.CosmosClient
import com.azure.cosmos.CosmosContainer
import com.azure.cosmos.CosmosDatabase
import com.azure.cosmos.models.CosmosContainerProperties
import com.azure.cosmos.models.CosmosContainerResponse
import com.azure.cosmos.models.CosmosItemRequestOptions
import com.azure.cosmos.models.CosmosQueryRequestOptions
import com.azure.cosmos.models.PartitionKey
import com.azure.cosmos.util.CosmosPagedIterable
import me.ricoschulz.newsDomain.entity.Article
import me.ricoschulz.newsDomain.repository.Articles

class ArticleRepository(
    private val client: CosmosClient,
) : Articles {

    private val databaseName = "NerdNews"
    private val containerName = "Articles"

    private lateinit var container: CosmosContainer
    private lateinit var database: CosmosDatabase

    init {
        createDatabaseIfNotExists()
        createContainerIfNotExists()
    }

    override fun addAll(newArticle: List<Article>) {
        newArticle.forEach {
            container.createItem(it, PartitionKey(it.hash), CosmosItemRequestOptions())
        }
    }

    override fun all(): List<Article> {
        TODO("Not yet implemented")
    }

    override fun hashExists(hash: String): Boolean {
        val articlesPagedIterable: CosmosPagedIterable<Article> =
            container.queryItems(
                "SELECT * FROM Articles WHERE Articles.hash = $hash",
                CosmosQueryRequestOptions(),
                Article::class.java
            )

        return 0 <= articlesPagedIterable.iterableByPage(1).count()
    }

    private fun createDatabaseIfNotExists() {
        val databaseResponse = client.createDatabaseIfNotExists(databaseName)
        database = client.getDatabase(databaseResponse.properties.id)
    }

    private fun createContainerIfNotExists() {
        val containerProperties = CosmosContainerProperties(containerName, "/hash")
        val containerResponse: CosmosContainerResponse =
            database.createContainerIfNotExists(containerProperties)
        container = database.getContainer(containerResponse.properties.id)
    }
}
