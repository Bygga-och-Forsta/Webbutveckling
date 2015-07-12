\newpage

# Databaser

En databas är ett digitalt arkiv. Vi kommer att använda en databas för att spara alla inlägg. Ett Database Management System (DBMS) är ett program som hanterar databasen och tillåter oss att ställa frågor eller *queries* som det kallas. Databasen består av tabeller, vilka i deras tur är uppbyggda av rader och kolumner. Ett exempel på en enkel tabell härnedan.


| id  | forename      | surname       | age |
|-----|---------------|---------------|-----|
| 1   | Knatte        | Anka          | 12  |
| 2   | Kalle         | Anka          | 18  |
| 3   | Farbror       | Joakim        | 67  |


## Structured Query Language

Structured Query Language (SQL) är ett språk som används i kombination med *relationsdatabaser* för att förfråga data. Språket utvecklades tidigt på 70-talet av Donald D. Charmberlin och Raymond F. Boyce som jobbade på IBM och är än idag det mest populära sättet att interagera med databaser. SQL finns nästan överallt, mest troligt har du SQL i din byxficka, eftersom de flesta smartphones sparar informationen i en databas kallad SQLite.

SQL är inget svårt språk, men kan bli otroligt komplicerat när databasen innehåller många tabeller och mycket data. SQL på flera tiotals rader är ingen ovanlighet och databasdesign är därför ett yrke i sig. Om vi vill returnera alla personer ur tabellen kan vi använda oss av en SELECT query som den här.

```sql
SELECT id, forename, surname, age
FROM persons;
```

Om man dock bara vill få ut alla personer som är arton eller över arton kan man använda en WHERE sats som den här.

```sql
SELECT id, forename, surname, age
FROM persons
WHERE age >= 18;
```

Och med hjälp av ett INSERT uttryck kan vi lägga till nya rader.

```sql
INSERT INTO persons (forename, surname, age)
VALUES ("Fnatte", "Anka", 12);
```
