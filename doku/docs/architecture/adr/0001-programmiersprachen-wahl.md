---
title: 0001 Programmiersprachen Wahl
---

# Die Backend-Services werden in der Programmiersprache PHP implementiert

* Status: accepted
* Deciders: Rico Schulz
* Date: 2023-05-20

## Context and Problem Statement

Die Services für das Projekt NerdBubble soll implementiert werden, dazu stehen diverse Programmiersprachen zur Verfügung.

## Considered Options

* PHP
* Java
* Kotlin
* Scalar

## Decision Outcome

Gewählte Option: "PHP", weil PHP einfach und kostengünstig zu hosten ist.

### Positive Consequences

* Es lässt sich leicht ein hoster für das Projekt finden.

### Negative Consequences

* Leider kein Kotlin.

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
