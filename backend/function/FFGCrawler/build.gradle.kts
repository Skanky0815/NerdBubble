import com.microsoft.azure.gradle.configuration.GradleRuntimeConfig

plugins {
    kotlin("jvm") version "1.7.21"
    kotlin("plugin.serialization") version "1.7.21"

    id("com.diffplug.spotless") version "6.4.2"
    id("com.microsoft.azure.azurefunctions") version "1.11.1"
}

repositories {
    mavenCentral()
    mavenLocal()
}

version = "1.0.0"

dependencies {
    implementation(platform("org.jetbrains.kotlin:kotlin-bom"))
    implementation("org.jetbrains.kotlin:kotlin-stdlib-jdk8")
    implementation("org.jetbrains.kotlinx:kotlinx-serialization-json:1.4.1")

    implementation("com.microsoft.azure.functions:azure-functions-java-library:2.2.0")
    implementation("com.azure:azure-cosmos:4.39.0")

    implementation("me.ricoschulz:crawler:1.0-SNAPSHOT")
}

spotless {
    kotlin {
        target("**/*.kts", "**/*.kt")
        ktfmt().kotlinlangStyle()
    }
}

testing {
    suites {
        val test by getting(JvmTestSuite::class) { useKotlinTest() }
    }
}

azurefunctions {
    subscription = "30d92437-2478-40b1-b524-f05cf519b960"
    resourceGroup = "nerdnews2"
    appName = "FFGCrawler"
    pricingTier = "Consumption" // refers
    // https://github.com/microsoft/azure-maven-plugins/tree/develop/azure-functions-maven-plugin#supported-pricing-tiers for all valid values
    region = "WestEurope"
    setRuntime(
        closureOf<GradleRuntimeConfig> {
            os("Linux")
            javaVersion("11")
        }
    )
    setAppSettings(
        closureOf<MutableMap<String, String>> {
            put("MAIN_CLASS", "me.ricoschulz.ffgCrawler.CrawlerFunction")
        }
    )
}
