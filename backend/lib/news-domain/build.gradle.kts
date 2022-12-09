plugins {
    kotlin("multiplatform") version "1.7.20"

    id("com.diffplug.spotless") version "6.4.2"
    id("maven-publish")

    id("org.jetbrains.kotlin.plugin.serialization") version "1.7.20"

    //    id("org.sonarqube") version "3.3"
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
        compilations.all { kotlinOptions.jvmTarget = "1.8" }
        withJava()
        testRuns["test"].executionTask.configure { useJUnitPlatform() }
    }

    sourceSets {
        val jvmMain by getting {
            dependencies {
                implementation("io.ktor:ktor-serialization-kotlinx-json-jvm:2.1.3")
                implementation("io.github.serpro69:kotlin-faker:1.12.0")
            }
        }
        val jvmTest by getting {
            dependencies {
                implementation(kotlin("test"))
                implementation("io.mockk:mockk:1.13.2")
            }
        }
    }
}
