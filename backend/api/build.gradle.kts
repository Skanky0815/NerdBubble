val ktor_version: String by project
val kotlin_version: String by project
val logback_version: String by project

plugins {
    application
    jacoco
    kotlin("jvm") version "1.7.20" apply true

    id("io.ktor.plugin") version "2.1.3"
    id("org.jetbrains.kotlin.plugin.serialization") version "1.7.20"
    id("com.diffplug.spotless") version "6.4.2"

    id("org.sonarqube") version "3.3"
    id("maven-publish")
}

group = "me.ricoschulz"

version = "0.0.1"

application {
    mainClass.set("me.ricoschulz.ApplicationKt")

    val isDevelopment: Boolean = project.ext.has("development")
    applicationDefaultJvmArgs = listOf("-Dio.ktor.development=$isDevelopment")
}

repositories {
    mavenLocal()
    mavenCentral()
}

dependencies {
    implementation("io.ktor:ktor-server-core-jvm:$ktor_version")
    implementation("io.ktor:ktor-server-content-negotiation-jvm:$ktor_version")
    implementation("io.ktor:ktor-serialization-kotlinx-json-jvm:$ktor_version")
    implementation("io.ktor:ktor-server-netty-jvm:$ktor_version")
    implementation("io.ktor:ktor-server-cors:$ktor_version")

    implementation("io.ktor:ktor-client-core:$ktor_version")
    implementation("io.ktor:ktor-client-cio:$ktor_version")
    implementation("io.ktor:ktor-client-content-negotiation:$ktor_version")
    implementation("org.jsoup:jsoup:1.15.3")

    implementation("ch.qos.logback:logback-classic:$logback_version")
    testImplementation("io.ktor:ktor-server-tests-jvm:$ktor_version")
    testImplementation("org.jetbrains.kotlin:kotlin-test-junit:$kotlin_version")
    testImplementation("org.jetbrains.kotlinx:kotlinx-coroutines-test:1.6.4")
    testImplementation("org.testng:testng:7.6.1")
    testImplementation("io.mockk:mockk:1.13.2")
    testImplementation("org.junit.jupiter:junit-jupiter:5.9.0")
}

tasks.withType<Test> {
    // useJUnitPlatform()
    finalizedBy(tasks.jacocoTestReport)
}

spotless {
    kotlin {
        target("**/*.kts", "**/*.kt")
        ktfmt().kotlinlangStyle()
    }
}

sonarqube {
    properties {
        property("sonar.projectKey", "Skanky0815_myGame")
        property("sonar.organization", "skanky0815")
        property("sonar.host.url", "https://sonarcloud.io")
        property(
            "sonar.exclusions",
            "./**/src/test/**,./src/main/kotlin/org/playtime/system/SystemApplication.kt"
        )
        property(
            "sonar.coverage.jacoco.xmlReportPaths",
            "build/reports/jacoco/test/jacocoTestReport.xml"
        )
    }
}

tasks.jacocoTestReport {
    dependsOn(tasks.test)
    reports { xml.required.set(true) }
}
