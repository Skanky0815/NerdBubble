package me.ricoschulz.ffgCrawler

enum class AccountSettings(val value: String) {
    MASTER_KEY(
        System.getProperty(
            "ACCOUNT_KEY",
            System.getenv()["ACCOUNT_KEY"]
                ?: "cLoHbF3MlX5IJ0jsOfb3DLIK8jSAZHCeUYJJgkdPi6dsq9k8kDiydXCPbQdLJRa7EZt7dWsDqeRHACDbf0314w=="
        )
    ),
    HOST(
        System.getProperty(
            "ACCOUNT_HOST",
            System.getenv()["ACCOUNT_HOST"] ?: "https://nerd-news-db.documents.azure.com:443/"
        )
    )
}
