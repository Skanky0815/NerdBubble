# 8. Querschnittliche 

## 8.1. Domain Entity Model

```mermaid
erDiagram
    User }|--o{ Keyword: has
    User }o--o{ Provider: has
    User {
        UUID id
        string name
        string email
    }
    Provider }o--o{ Keyword: has
    Provider ||--o{ Artikel: has
    Provider {
        UUID id
        string name
        string color
        string logoImage
        string aggregateUrl
        boolean hasProducts
        enum leyout
        boolean isActive
        string headlineSelector
        string headline
        string subHeadlineSelector
        string descriptionSelector
        string imageSelector
        string articleImage
        string linkSelector
        string articleLink
    }
    Keyword {
        UUID id
        string word
    }
    Artikel ||--o{ Produkt: has
    Artikel }o--|{ Keyword: has
    Artikel {
        UUID id
        UUID providerId
        string headline
        string subHeadline
        string description
        string image
        string link
    }
    Produkt {
        UUID id
        UUID articleId
        string name
        string image
        string link
    }
    
```
