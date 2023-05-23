# 4. Lösungsstrategie

Dieser Abschnitt enthält einen stark verdichteten Architekturüberblick. Eine Gegenüberstellung der wichtigsten Ziele
und Lösungsansätze.

## 4.1 Einstieg in die Lösungsstrategie

Die folgende Tabelle stellt die Qualitätsziele von NerdBubble (siehe [Abschnitt 1.2](1_Einfuehrung_Ziele.md#12-qualittsziele)) passenden Architekturansätzen gegenüber, und erleichtert
so einen Einstieg in die Lösung.

| Qualitätsziel   | Dem zuträgliche Ansätze in der Architektur                                                                                                              |
|-----------------|---------------------------------------------------------------------------------------------------------------------------------------------------------|
| Benutzbarkeit   | - GUI ist Mobile First zu entwickeln                                                                                                                    |
| Erweiterbarkeit | - Domain ist von dem Framework zu entkoppeln<br> - Frontend Umsetzung mit react.js<br> - API First Ansatz<br> - evolutionäre REST Full API zum Frontend |