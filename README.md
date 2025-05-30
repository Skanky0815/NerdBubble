# NerdBubble

[![Server](https://github.com/Skanky0815/NerdBubble/actions/workflows/server.yml/badge.svg)](https://github.com/Skanky0815/NerdBubble/actions/workflows/server.yml)
[![App](https://github.com/Skanky0815/NerdBubble/actions/workflows/app.yml/badge.svg)](https://github.com/Skanky0815/NerdBubble/actions/workflows/app.yml)

> Die NerdBubble ist eine APP über der sich der Benutzer Neuigkeiten von diversen Webseiten anzeigen lassen kann.

Das Projekt ist eine reine Spielwiese, um folgende Dinge zu lernen.
- [arc42](https://www.arc42.de/)
- [Storybook](https://storybook.js.org/)
- [Docusaurus](https://docusaurus.io/)
- [Cucumber](https://cucumber.io/)
- [Cypress](https://www.cypress.io/)
- [NextJS](https://nextjs.org/)
- [MUI](https://mui.com/)
- [Laravel](https://laravel.com/)
- [GitHub Actions](https://github.com/features/actions)
- [sonarcloud](https://sonarcloud.io/)

## User Stories

### App-Benutzer
- [ ] [NewsStream](doku/docs/userStories/newsStream.md) (*NewsStream in der App anzeigen*)
  - [ ] Crawler Function um die News zu aggregieren
  - [x] API Function zum laden des NewsStreams implementiert 
  - [x] App zum Anzeigen des NewsStream implementieren

## Architektur
1. [Einführung und Ziele](doku/docs/architecture/1_Einfuehrung_Ziele.md)
2. [Randbedingung](doku/docs/architecture/2_Randbedingung.md)
3. [Kontextabgrenzung](doku/docs/architecture/3_Kontextabgrenzung.md)
4. [Lösungsstrategie](doku/docs/architecture/4_Loesungsstrategie.md)
5. [Bausteinsicht](doku/docs/architecture/5_Bausteinsicht.md)
6. [Laufzeitsicht](doku/docs/architecture/6_Laufzeitsicht.md)
7. [Verteilungssicht](doku/docs/architecture/7_Verteilungssicht.md)
8. [Querschnittliche Konzepte](doku/docs/architecture/8_Querschnittliche_Konzepte.md)
9. [Entwurfsentscheidungen](doku/docs/architecture/9_Entwurfsentscheidungen.md)
10. [Qualitätsanforderung](doku/docs/architecture/10_Qualitaetsanforderungen.md)
11. [Risiken und technische Schulden](doku/docs/architecture/11_Risiken_technische_Schulden.md)
12. [Glossar](doku/docs/architecture/12_Glossar.md)

## Dokumentation

- [API Dokumentation](server/storage/openapi.yml)

## DevSetup

```bash
  docker compose up -d
```

## Development
### Generate TypeScript Types from Swagger
For the frontend, the clients for the backend communication are generated using the OPEN API specification. To do this, the following command must be executed in the corresponding frontend project directory.

```bash
  npm run client --prefix web-app
```

- [OpenAPI-TS](https://openapi-ts.pages.dev/introduction) Dokumentation for type generation.


--- 
[![SonarCloud](https://sonarcloud.io/images/project_badges/sonarcloud-white.svg)](https://sonarcloud.io/summary/new_code?id=NerdBubble)
