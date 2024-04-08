# 5. Bausteinsicht

> Dieser Abschnitt beschreibt die Zerlegung von NerdBubble in Services. Jeder Service wird als FaaS bereitgestellt.

```mermaid
C4Context
    Container_Boundary(neadBubble, "NerdBubble") {
        Component(app, "App")
        Component(newsStreamApi, "News Stream API")
        Component(crawler, "Crawler")

        ContainerDb(db, "Database")
    }
    
    System_Ext(newsProvider, "Neuigkeiten Anbieter")
    
    Rel(app, newsStreamApi, "")
    Rel(newsStreamApi, db, "")
    Rel(crawler, db, "")
    Rel(crawler, newsProvider, "")

    UpdateLayoutConfig($c4ShapeInRow="3", $c4BoundaryInRow="1")
```

| Module          | Kurzbeschreibung                                                          |
|-----------------|---------------------------------------------------------------------------|
| App             | Native Mobile App                                                         |
| News Stream API | Rest API zum laden aller Neuigkeiten                                      |
| crawler         | Service welcher die Daten eines Neuigkeiten Anbieter lädt und aufarbeitet |
