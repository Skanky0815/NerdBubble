plugins {
    kotlin("multiplatform") version "1.7.21"

    id("com.diffplug.spotless") version "6.4.2"

    // id("org.sonarqube") version "3.3"

    id("maven-publish")
}

group = "me.ricoschulz"

version = "1.0-SNAPSHOT"

repositories {
    mavenCentral()
    mavenLocal()
}

spotless {
    kotlin {
        target("**/*.kts", "**/*.kt")
        ktfmt().kotlinlangStyle()
    }
}

kotlin {
    jvm {
        compilations.all { kotlinOptions.jvmTarget = "11" }
        withJava()
        testRuns["test"].executionTask.configure { useJUnitPlatform() }
    }

    sourceSets {
        val jvmMain by getting {
            dependencies {
                implementation("io.ktor:ktor-client-core:2.1.3")
                api("io.ktor:ktor-client-cio:2.1.3")
                implementation("io.ktor:ktor-client-content-negotiation:2.1.3")
                api("me.ricoschulz:news-domain:1.0-SNAPSHOT")
                api("io.ktor:ktor-serialization-kotlinx-json-jvm:2.1.3")
                api("org.jsoup:jsoup:1.15.3")
            }
        }
        val jvmTest by getting {
            dependencies {
                implementation(kotlin("test"))
                implementation("org.jetbrains.kotlinx:kotlinx-coroutines-test:1.6.4")
                implementation("io.ktor:ktor-client-mock:2.1.3")
                implementation("io.mockk:mockk:1.13.2")
            }
        }
    }
}
