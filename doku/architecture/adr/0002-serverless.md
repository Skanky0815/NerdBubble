# Das Backend wird als FaaS System implementiert

* Status: in progress
* Deciders: Rico Schulz
* Date: 2022-11-17

## Context and Problem Statement

Das Backend für die App muss über das Internet erreichbar sein. Mit den aktuellen Hosting Möglichkeiten gibt ergeben sich verschieden Architektur ansätze.     

## Considered Options

* Serverless
* Monolith

## Decision Outcome

Das Backend soll als FaaS in einer Serverless Umgebung gehostet werden.   

### Positive Consequences

* Geringere Kosten im Betrieb
* Modulare erweiterbarkeit
* Geringerer Aufwand bei Wartung und Deployment

### Negative Consequences

* neue Technologie und längere Einarbeitungszeiten
* aufwändigeres Testing
* besondere Herausforderungen bei Abhängigkeiten zwischen den Funktionen 

## Pros and Cons of the Options

### Serverless

* Gut, Kosten fallen nur für die tatsächliche Nutzung an
* Gut, das Backend kann beliebig erweitert werden, ohne das vorhandene Funktionen beeinflusst werden
* Gut, geringer Wartungsaufwand bei der Betreibung
* Gut, deployment via GitHub Pipeline möglich
* Gut, 
* Schlecht, neues System hohe Einarbeitungszeit
* Schlecht, variable und unvorhersehbare Kosten 
* Schlecht, Komplexität durch verteiltes System 
* Schlecht, 

### Monolith

* Gut, feste, gleichbleibende Kosten
* Gut, geringerer Komplexität in der Implementierung
* Gut, einfacheres lokales Testen 
* Gut,
* Schlecht, hohe Kosten
* Schlecht, 