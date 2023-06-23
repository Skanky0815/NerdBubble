# GameApp
[![Server QA](https://github.com/Skanky0815/NerdBubble/actions/workflows/server_qa.yml/badge.svg)](https://github.com/Skanky0815/NerdBubble/actions/workflows/server_qa.yml)
[![App QA](https://github.com/Skanky0815/NerdBubble/actions/workflows/app_qa.yml/badge.svg)](https://github.com/Skanky0815/NerdBubble/actions/workflows/app_qa.yml)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=Skanky0815_NerdBubble&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=Skanky0815_NerdBubble)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=Skanky0815_NerdBubble&metric=vulnerabilities)](https://sonarcloud.io/summary/new_code?id=Skanky0815_NerdBubble)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=Skanky0815_NerdBubble&metric=bugs)](https://sonarcloud.io/summary/new_code?id=Skanky0815_NerdBubble)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=Skanky0815_NerdBubble&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=Skanky0815_NerdBubble)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=Skanky0815_NerdBubble&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=Skanky0815_NerdBubble)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=Skanky0815_NerdBubble&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=Skanky0815_NerdBubble)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=Skanky0815_NerdBubble&metric=coverage)](https://sonarcloud.io/summary/new_code?id=Skanky0815_NerdBubble)

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
[![SonarCloud](https://sonarcloud.io/images/project_badges/sonarcloud-white.svg)](https://sonarcloud.io/summary/new_code?id=Skanky0815_NerdBubble)
