# 2. Randbedingung

Beim Lösungsentwurf waren zu Beginn verschiedene Randbedingungen zu beachten, sie wirken in der Lösung fort. Dieser
Abschnitt stellt sie dar und erklärt auch – wo nötig – deren Motivation.

## 2.1 Technisch

| Randbedingung                  | Erläuterungen, Hintergrund                                          |
|--------------------------------|---------------------------------------------------------------------|
| Backend implementierung in PHP | Die Backend Services werden in PHP implementiert                    |
| App implementierung mit react  | Die App soll als WeApp mit dem react Framework implementiert werden |
| Testabdeckung                  | Die Testabdeckung mit UnitTest soll mindestens 90% sein             |

## 2.2 Organisatorisch

| Randbedingung                           | Erläuterungen, Hintergrund                                                                                                          |
|-----------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------|
| Team                                    | One-Man-Show :D                                                                                                                     |
| Vorgehensmodell                         | Die Entwicklung wird Iterativ erfolgen und inkrementell                                                                             |
| Entwicklungswerkzeuge                   | Entwickelt mit in IntelliJ, die Architektur wird via Markdown und DrawIo dokumentiert                                               |
| Konfigurations- und Versionsverwaltung  | Der Code wird auf GitHub verwaltet                                                                                                  | 

## 2.3 Konventionen

| Randbedingung      | Erläuterungen, Hintergrund                                                              |
|--------------------|-----------------------------------------------------------------------------------------|
| Sprache            | Der Code wird komplett in Englisch verfasst und die Dokumentation in Deutsch.           |
| Coding conventions | Der Code wird nach den PSR12 von [php-fig.org](https://www.php-fig.org/psr/) formatiert |
| DDD                | Das Projekt wird frei nach DDD umgesetzt.                                               |