\newpage

# Hypertext Markup Language

```html
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Test</title>
</head>
<body>
    <h1>Test</h1>
    <p style=”color:red;”>Bacon ipsum dolor amet.</p>
</body>
</html>
```

Ovanstående kod är skriven i HTML. Enkelt förklarat så är HTML (Hypertext Markup Language) ett språk som används för att skapa hemsidor. Man kan säga att det är hemsidans skelett.

Dokumentet är uppbyggd av *element*. I exemplet ser vi bland annat `<h1>Test</h1>` elementet. Alla element börjar med en tagg slutar med en tagg. Uppgiften av detta element är att visa innehållet ”Test” som en rubrik.

Så låt oss dyka in i koden och beskriva vad allt gör rad för rad. Vi ser att dokumentet börjar med `<!DOCTYPE html>`. Alla dokument börjar med en så kallad DOCTYPE, vilken säger åt webbläsaren vilken version av HTML dokumentet är skriven i. Det är HTML5 i detta fall.

`<html></html>` beskriver ett HTML dokument.

`<head><head>` innehåller all information som inte visas direkt på sidan. Bland annat kan det innehålla titeln på sidan och meta taggar, som hjälper sökmotorer identifiera vår hemsida.

`<meta charset=”utf-8” />` För att webbläsaren ska kunna visa dokumentet korrekt, så måste den veta vilken teckenkodning som ska användas. Teckenkodningen är sättet på hur data sparas på hårddisken, medans Unicode är ett exempel på en teckentabell.  Detta element säger åt webbläsaren att dokumentet ska läsas med UTF-8 teckenkodning. Du har säkert sett frågetecken på platser där egentligen ett å bör stå förut? Det är ett tecken på att sidan använder sig av fel teckenkodning.

UTF-8, den standard teckenkodningen för HTML5, har jämfört med ASCII ett stort antal fördelar. Framförallt för språk som svenska som innehåller alla dem här konstiga tecken som äåö. De icke engelska tecken visar upp sig som frågetecken i webbläsaren om man använder ASCII som teckenkodning, eftersom de tecken inte finns i ASCII tabellen. Förutom att UTF-8 är den standard teckenkodningen för HTML5 är den också standard på många moderna operativsystem som till exempel Linux.

ANSI (Windows-1252) är ett tillägg till ASCII och stöder dem icke engelska tecken. HTML 2.0 tillförde att ISO-8859-1 blev den nya standard teckenkodningen. I grund och botten är ISO-8859-1 samma sak som ANSI förutom att ANSI innehåller 32 extra tecken.

`<title>Test</title>` är sidans titel som kommer att visas på fliken.

`<body></body>` Nu kommer vi till den roligare delen av dokumentet. Menyer, tabeller, bilder, text, länkar, verkligen allt som syns på hemsidan befinner sig i bodyn.

`<p style="color:red;">Bacon ipsum dolor amet.</p>` är ett element som visar en paragraf med text. Till skillnad från `<h1>` har detta element ett attribut. Attributet `style=""` tillåter oss bland annat att ändra färgen på texten till röd.

## Utvecklingsmiljön

För att kunna utveckla en webbapplikation behöver man inte många verktyg. Huvudsakligen behöver man skaffa sig en bra textredigerare. Vilken spelar ingen roll, men här är en lista på några bra textredigerare som man kan ladda ner.

**Platform oberoende:** Aptana Studio, Atom, VIM, Emacs

**Windows:** Notepad++

**Linux:** Gedit och Kate

Om man inte vet vilken man ska ladda ner, kan man ladda ner Atom. Slutligen behöver man en förnuftig webbläsare som stöder HTML5, Mozilla Firefox till exempel. Utöver det måste man ha tillgång till en webbserver och eventuellt ett skriptspråk och en databasserver.

## Första uppgiften

Nu ska vi göra något roligt med HTML. Skolorna har ett stort problem. Att hantera alla veckorapporter från eleverna på papper är ineffektiv och därför måste vi bygga en applikation där eleverna kan göra ett inlägg varje dag med vad de har fått göra på praktikplatsen. Målet är att vi i slutändan har en simpel dock fullständig fungerande applikation, där man kan skapa nya inlägg.

Vi börjar med att skapa en ny fil med namnet `index.php`. Det är filen som servas ut automatiskt av webbservern på rooten av domänet, startsidan. Hur fungerar det? Din webbläsare skickar en HTTP **GET** förfråga till webbservern (värddatorn som serverar besökaren sidan) och svarar i sin tur med att skicka `index.php`. Det finns även andra typer av förfrågningar eller metoder som det kallas, vi kommer dock bara fokusera oss på GET och POST.

**GET** - Frågar servern att visa en post.

**POST** - Frågar servern att skapa en ny post.

**DELETE** - Frågar servern att ta bort en post.

**PUT** - Frågar servern om tillåtelse för att ladda upp data. Används bland annat för att ladda upp filer.

Efter att du har skapat filen kan du fylla den med följande innehåll. Notera att om du använder Windows så döljer filhanteraren extensionen på filen, dubbelkolla att suffixet på filen är '.html' och inte '.txt'.

```html
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Veckorapporten</title>
</head>
<body>
    <header id="header-top">
        <h1 id="logo"><a href="index.php">Veckorapporten</a></h1>
        <nav>
            <ul>
                <li><a href="index.php">Hem</a></li>
                <li><a href="new.php">Ny</a></li>
            </ul>
        </nav>
    </header>

    <div id="page-container">
        <article>
            <h2 class="article-title">Bacon</h2>
            <p class="actions">
                <a href="delete.php?id=1">Radera</a>
                &nbsp;
                <a href="edit.php?id=1">Redigera</a>
                &nbsp;
                <span class="date">2015-03-17</span>
            </p>
            <p class="content">
                Idag har jag ...<br />
                Det jag även fick jobba på var ...<br />

                <br /><br />

                Slutligen gjorde jag ...
            </p>
        </article>

        <footer id="footer-bottom">
            <p>Copyright &copy; 2015 Fabian Bakkum</p>
        </footer>
    </div>
</body>
</html>
```

Som du ser finns det en del tillagd inuti `body` elementet. Låt mig bryta ner det. Du kan öppna dokumentet i Firefox genom att hålla i *Alt* och *F* samtidigt och klicka på *Öppna Fil*, välj dokumentet och klicka på *Öppna*.

`<header id="header-top"></header>` är det första elementet i bodyn. Det är en ny tag i HTML5 dit man bland annat kan placera logotypen, ett sökfält eller navigationsmenyer. Elementet innehåller också ett attribut, *id* med värdet *header-top*. Syftet med class och id attributen är att vi kan använda de för att styla dokumentet med CSS.

`<h1 id="logo"><a href="index.php">...</a></h1>` är sidans titel som innehåller en länk tillbaka till startsidan. Attributet `href="index.php"` anger platsen dit vi vill länka till. Man kan även länka till externa sidor. Till exempel så länkar följande länk till sökmotorn Google:

`<a href="https://www.google.se/">Klicka här</a>`

`<nav></nav>` innehåller menyn med alla länkar. I detta fall finns det två knappar på sidan. En för att gå tillbaka till startsidan och en annan knapp för att skapa ett nytt inlägg.

`<ul></ul>` är till för att göra listor. Ett exempel:

- Handla mat
- Tvätta kläderna

`<div></div>` används för att dela upp sidan och kommer att användas i CSS sektionen av häftet.

`<article></article>` Inom detta element kommer inlägget att visas. Vi kommer att sedan att generera ett `article` element för vartenda inlägg.

`<h2></h2>` Inläggets titel.

`&nbsp;` är ett speciellt HTML tecken som skapar ett tomrum mellan dem två länkar.

`<br />` bryter raden.

`<footer></footer>` innehåller ett meddelande om upphovsrätten. Elementet kan även innehålla kontakt information eller länkar till annan nyttig information.

**Extra uppgift:**

Placera en slumpvis bild under inlägget.
