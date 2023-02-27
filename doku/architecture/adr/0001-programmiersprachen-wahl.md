# Die Backend-Services werden in der Programmiersprache Kotlin implementiert

* Status: accepted
* Deciders: Rico Schulz
* Date: 2022-11-16

## Context and Problem Statement

Die Services für das Projekt NerdBubble soll implementiert werden, dazu stehen diverse Programmiersprachen zur Verfügung.

## Considered Options

* PHP
* Java
* Kotlin
* Scalar

## Decision Outcome

Gewählte Option: "Kotlin", weil Kotlin stark typisiert ist und überflüssigen Boilerplate Code vermeidet.

### Positive Consequences

* Team ist motiviert mit einer neuen Sprache zu arbeiten

### Negative Consequences

* Team muss sich erst in alle Konzepte von Kotlin einarbeiten

## Pros and Cons of the Options

### PHP

* Gut, weil das Team am meisten Erfahrung in PHP hat

### Java

* Gut, weil das Team schon grundlegende Erfahrung in Java hat
* Gut, weil Kotlin oder Scalar Komponenten eingebunden werden können
* Schlecht, viel Boilerplate Code

### Kotlin

* Gut, weil die Klassen kleinere und _sauberere_ sind
* Gut, weil Scalar oder Java Komponenten eingebunden werden können

### Scalar

* Gut, weil Kotlin oder Java Komponenten eingebunden werden können
* Schlecht, weil das Team noch gar keine Erfahrung mit funktionaler Programmierung hat
