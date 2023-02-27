# 4. Lösungsstrategie

Dieser Abschnitt enthält einen stark verdichteten Architekturüberblick. Eine Gegenüberstellung der wichtigsten Ziele
und Lösungsansätze.

## 4.1 Einstieg in die Lösungsstrategie

Die folgende Tabelle stellt die Qualitätsziele von NerdBubble (siehe [Abschnitt 1.2](1_Einfuehrung_Ziele.md#12-qualittsziele)) passenden Architekturansätzen gegenüber, und erleichtert
so einen Einstieg in die Lösung.

| Qualitätsziel   | Dem zuträgliche Ansätze in der Architektur                                                                                               |
|-----------------|------------------------------------------------------------------------------------------------------------------------------------------|
| Benutzbarkeit   | - vereinfachte GUI in Material Design<br> - GUI ist Responsive<br>                                                                       |
| Erweiterbarkeit | - Module werden lose gekoppelt<br> - Frontend Umsetzung mit Next.js<br> - API First Ansatz<br> - evolutionäre REST Full API zum Frontend |