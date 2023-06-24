# NerdBubble

[![Server QA](https://github.com/Skanky0815/NerdBubble/actions/workflows/server_qa.yml/badge.svg)](https://github.com/Skanky0815/NerdBubble/actions/workflows/server_qa.yml)
[![App QA](https://github.com/Skanky0815/NerdBubble/actions/workflows/app_qa.yml/badge.svg)](https://github.com/Skanky0815/NerdBubble/actions/workflows/app_qa.yml)

**App**

[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=NerdBubble_app&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=NerdBubble_app)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=NerdBubble_app&metric=vulnerabilities)](https://sonarcloud.io/summary/new_code?id=NerdBubble_app)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=NerdBubble_app&metric=bugs)](https://sonarcloud.io/summary/new_code?id=NerdBubble_app)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=NerdBubble_app&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=NerdBubble_app)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=NerdBubble_app&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=NerdBubble_app)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=NerdBubble_app&metric=coverage)](https://sonarcloud.io/summary/new_code?id=NerdBubble_app_app)


**Server**

[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=NerdBubble_server&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=NerdBubble_server)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=NerdBubble_server&metric=vulnerabilities)](https://sonarcloud.io/summary/new_code?id=NerdBubble_server)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=NerdBubble_server&metric=bugs)](https://sonarcloud.io/summary/new_code?id=NerdBubble_server)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=NerdBubble_server&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=NerdBubble_server)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=NerdBubble_server&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=NerdBubble_server)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=NerdBubble_server&metric=coverage)](https://sonarcloud.io/summary/new_code?id=NerdBubble_server_server)

Die GameApp ist eine APP über der sich der Benutzer Neuigkeiten von diversen Webseiten anzeigen lassen kann.

## User Stories

### App-Benutzer
- [ ] [NewsStream](doku/userStories/newsStream.md) (*NewsStream in der App anzeigen*)
  - [ ] Crawler Function um die News zu aggregieren
  - [x] API Function zum laden des NewsStreams implementiert 
  - [x] App zum Anzeigen des NewsStream implementieren

## Architektur
1. [Einführung und Ziele](doku/architecture/1_Einfuehrung_Ziele.md)
2. [Randbedingung](doku/architecture/2_Randbedingung.md)
3. [Kontextabgrenzung](doku/architecture/3_Kontextabgrenzung.md)
4. [Lösungsstrategie](doku/architecture/4_Loesungsstrategie.md)
5. [Bausteinsicht](doku/architecture/5_Bausteinsicht.md)
6. [Laufzeitsicht](doku/architecture/6_Laufzeitsicht.md)
7. [Verteilungssicht](doku/architecture/7_Verteilungssicht.md)
8. [Querschnittliche Konzepte](doku/architecture/8_Querschnittliche_Konzepte.md)
9. [Entwurfsentscheidungen](doku/architecture/9_Entwurfsentscheidungen.md)
10. [Qualitätsanforderung](doku/architecture/10_Qualitaetsanforderung.md)
11. [Risiken und technische Schulden](doku/architecture/11_Risiken_technische_Schulden.md)
12. [Glossar](doku/architecture/12_Glossar.md)

## Dokumentation

- [API Dokumentation](server/storage/openapi.yml)

## DevSetup

### Frontend 

```bash
npm run start
```

--- 
[![SonarCloud](https://sonarcloud.io/images/project_badges/sonarcloud-white.svg)](https://sonarcloud.io/summary/new_code?id=NerdBubble)
