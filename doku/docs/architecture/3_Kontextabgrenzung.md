# 3. Kontextabgrenzung

> Dieser Abschnitt beschreibt das Umfeld von NerdBubble. Für welche Benutzer ist es da, und mit welchen Fremdsystemen interagiert es?

## 3.1 Fachlicher Kontext

```mermaid
C4Context
    Person(customer, "Benutzer")
    System(nerdBubble, "NerdBubble")
    System_Ext(newsProvider, "Neuigkeiten Anbieter")
    
    Rel(customer, nerdBubble, "")
    Rel(nerdBubble, newsProvider, "")
```

### Benutzer

Benutzten die App um sich über Neuigkeiten aus ihrem Interessensgebieten zu informieren.

### Neuigkeiten Anbieter

Interessens Webseiten sind Webpages.
