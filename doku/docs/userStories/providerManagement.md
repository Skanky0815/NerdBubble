# Provider übersicht
> Als eingeloggter User möchte ich eine List mit allen aktiven Providern sehen.
>
> Als eingeloggter User kann ich in der Liste neue Provider abonnieren.
> 
> Als eingeloggter User kann ich in der List Provider das Abonnement eines Providers aufheben.

**Akzeptanzkriterien:**
- in der Liste sind nur die von dem User abonnierten und aktiven Provider aufgeführt
- in der Liste wird das Logo des Providers angezeigt
- wenn man in der Liste auf ein Provider klickt, sieht man die Keywords, die der User dem Provider zugeordnet hat, angezeigt werden
- die Liste soll einen Filter enthalten, mit dem man die Provider anhand der Keywords filtern kann
- über eine suche, kann man neue Provider abonnieren (hinzufügen)

# Provider anlegen oder bearbeiten
> Als eingeloggter User möchte einen neuen Provider anlegen.
> 
> Als eingeloggter User möchte ich einen bestehenden Provider bearbeiten.

**Akzeptanzkriterien:**
- man muss ein Name hinterlegt
- man muss eine Farbe zuweisen
- man muss ein Logo des Providers hinterlegen
- man muss ein Link zur Webseite hinterlegen, welche durchsucht werden soll
- man muss auswählen, ob es ein einfacher NewsArtikel oder ProdukteArtikel ist
- wenn es ein NewsArtikel ist:
  - man muss bestimmen, welches HTML Element als Bildquelle dient
  - man muss bestimmen, welches HTML Element als Headline dient
  - man muss ein HTML element als SubHeadline auswähle
  - man muss ein HTML element als Description auswählen
  - man muss bestimmen, welches HTML Element als Link zur Webseite dient
  - man muss das Layout für den Artikel auswählen
- wenn es ein ProduktArtikel ist:
  - entweder muss man bestimmen, welches HTML Element als Bildquelle dient oder man muss ein Link für das Bild hinterlegen
  - entweder muss man bestimmen, welches HTML Element als Headline dient man muss eine Headline hinterlegen
  - entweder muss man ein HTML element als SubHeadline auswähle oder man muss ein HTML element als Description auswählen
  - entweder muss man bestimmen, welches HTML Element als Link zur Webseite dient oder man muss ein Link zu Webseite hinterlegen
  - man muss bestimmen, welches HTML Element als Link zum Produkt dient
  - man muss bestimmen, welches HTML Element als Bildquelle dient
  - man muss bestimmen, welches HTML Element als Name dient
- immer wenn man ein Feld ausfüllt, wird einem der Artikel als Vorschau angezeigt
- man kann den Provider aktivieren
- der angelegte Provider ist in der Datenbank gespeichert
- aktive Provider aggregieren Artikel anhand der zugeordneten Keywords

# Provider abonnieren
> Als eingeloggter User kann ich einen Provider abonnieren, um mir die aggregierten Artikel anzeigen zu lassen. 

**Akzeptanzkriterien:**
- wenn man den Provider abonniert, dann muss man mindestens ein Keyword zuordnen

# Provider (de)aktivieren
> Als eingeloggter User möchte ich einen Provider für mich aktivieren oder deaktivieren.

**Akzeptanzkriterien:**
- wenn ein Provider deaktiviert ist, aggregiert er keine Artikel mehr
