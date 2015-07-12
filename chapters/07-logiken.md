# Webbapplikationens logik

Innan vi börjar programmera behöver vi göra ordning databasen. MySQL erbjuder en textbaserat klient som du kan använda, men de flesta webbhotell ger dig valet att använda PHPMyAdmin, ett grafiskt gränssnitt till MySQL.

När du har hittat konsolen kan du skapa en databas och en tabell med fyra kolumner, id, title, body och date genom nedanstående SQL. Den första kolumnen `id` kommer att få ett unikt värde så att vi kan särskilja posterna och den kommer att räkna upp automatiskt.

Alltså den första posten kommer att ha ett id lika med ett och den andra lika med två osv. Datatypen är satt till *int* med en storlek satt till elva, det vill säga att vi endast får mata in heltal i detta fält. `NOT NULL` säger till att detta fält inte får vara tomt. `AUTO_INCREMENT` gör att den automatiskt räknar upp, vilket gör att vi inte behöver mata in ett id när vi skapar en ny post. `PRIMARY KEY` säger till att detta fält ska användas för att särskilja posterna.

Den andra kolumnen har sin datatyp satt till *varchar* och storleken på den är satt till 128, som gör att titeln är begränsad till 128 tecken. `COLLATE utf8_bin` sätter teckenkodningen till UTF-8.

Den tredje kolumnen har sin datatyp satt till *text*. Den är till för lite längre texter och man behöver inte specificera någon storlek. Samma gäller för datatypen *date*. På den sista raden säger vi till att vi vill använda InnoDB som databasmotor.

```sql
CREATE TABLE IF NOT EXISTS `journals` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(128) COLLATE utf8_bin NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
```

Det första vi behöver göra är en sida där man kan skapa nya poster. Därför måste vi skapa en ny fil med namnet `new.php`. Det fullständiga innehållet finns i exempelfilen. Som du ser har jag lagt till en ny HTML form, där användaren kan mata in sin data. Attributet `method` specificerar att data ska skickas i en POST förfrågning. Elementet `label` har fått attributet `for` vilket används för referera till inmatningsfältet. Om man klickar på texten hamnar man i inmatningsfältet.

Elementet `input` används för att skapa fältet där användaren kommer att mata in sin data. Den har fått ett `id` för att kunna referera till den med `for` attributet i labeln. Utöver har den fått `name` attributet, som skickas som nyckelpar i POST förfrågan tillsammans med det inmatade data. Elementet `textarea` används för inmatning av längre texter. Sist i formuläret finns en Spara-knapp.

```html
<form method="post">
    <label for="title">Titel:</label>
    <br />
    <input id="title" name="title" type="text" />
    <br /><br />
    <label for="body">Idag har jag:</label>
    <br />
    <textarea id="body" name="body"></textarea>
    <br />
    <input name="submit" type="submit" value="Spara" />
</form>
```

Nu måste vi kunna hantera POST förfrågan som skickas när användaren klickar på Spara-knappen. PHP sparar all data skickat i POST förfrågan i en speciell variabel (array) nämnd `$_POST`. Med `isset` funktionen kan vi kolla om variabeln är satt och har ett värde knutet till sig.

```php
<?php
	if ( isset($_POST['submit']) ) {
		// Gör någonting med förfrågan ...
	}
?>
```

Vi kommer att ha några krav, ett av dem är att formuläret ska vara ifylld helt. Här kommer `empty` funktionen till hands. En funktion som returnerar *sanning* om variabeln är tom. Om användaren dock matar in mellanslag kommer funktionen att returnera *falskhet*, alltså kommer variabeln inte att vara tom. Funktionen `trim` kan då användas för att ta bort mellanrum på början och slutet av strängen. Så här kommer villkorssatsen att se ut.

```php
if(empty(trim($_POST['title'])) || empty(trim($_POST['body']))) {
	// Informera användaren om problemen
}
```

\newpage

Inuti if-satsen finner vi tre till if-satser som kollar vad problemet är och informerar användaren sedan om problemet. Om allting är korrekt kan vi lägga in posten i databasen. Innan vi kan göra det, måste vi skapa en databasanslutning. Det finns flera sätt att interagera med MySQL databaser.

* **mysql** – gränssnittet som användes till 2012. Den bör inte användas längre och kommer att tas bort i nyare versioner av PHP.

* **mysqli** – uppföljaren till det föråldrade mysql gränssnittet. Man får interagera med den på ett objektorienterad eller processuellt sätt.

* **PDO** – gränssnittet som vi kommer att använda. Den stöder tolv olika databaser inkluderande MySQL och har sitt fokus på objektorienterat programmering samt att den stöder *nämnda parametrar*.

Nedanstående kod skapar en ny anslutning till databasen genom att skapa ett nytt PDO objekt. Troligtvis kommer databasservern att köras på samma server som webbservern, om det inte är sant bör du byta ut `localhost` mot databasserverns IP adress. Ävenledes måste du byta ut `databasnamn`, `användarnamn` och `lösenord` mot dina egna uppgifter.

```php
$dbh = new PDO('mysql:host=localhost;dbname=databasnamn',
               'användarnamn', 'lösenord');
```

## Prepared statements

Användaren kan mata in vad som helst, även SQL kod. Essentiellt betyder det att användaren kan göra vad som helst med vår databas. Detta fenomen kallas för *SQL-injektion* och är en av dem vanligaste attacker. Vi kan motverka dessa attacker genom att använda oss av *prepared statements*.

```php
$stmt = $dbh->prepare("INSERT INTO journals (title, body, date)
                      VALUES(:title, :body, NOW())");
```
Istället för att konkatenera användarens inmatningar direkt med satsen, så förbereder vi satsen först så att vi sedan kan sitta ihop användarens inmatningar med vår förfråga. På så sätt är vi skyddat mot attacken SQL-injektion.

Nästa steg är att sitta ihop användarens inmatningar med förfrågan. Här säger vi till PDO att byta ut parametern *:title* mot värdet av variabeln *$title*.

```php
$stmt->bindParam(':title', $title);
```

Såklart behöver vi sätta variabeln också. Notera återigen att vi använder `trim` funktionen för att ta bort mellanrummet på början och slutet av strängen.

```php
$title = trim($_POST['title']);
```

Slutligen kan vi exekvera queryn och återvända användaren till startsidan om allt gick som det skulle.

```php
$stmt->execute();
header('Location: index.php');
```

## Undantagshantering

```php
try {
	$dbh = new PDO('mysql:host=localhost;dbname=veckorapporten',
                     'användaren', 'lösenord');
} catch ( PDOException $e ) {
	echo 'Detta fel inträffade: ' . $e;
}
```

Vad händer om vi inte kan ansluta mot databasservern? Jo, PDO kastar då ett så kallad undantag (*exception*). Undantagshantering görs med ett try-catch block. Vi kan omge koden som kastar ett undantag med try och sedan kan vi fånga undantaget med ett catch block. Notera att PDO som standard endast kastar ett undantag om anslutningen misslyckades. Troligtvis vill du inte skriva ut informationen till sidan, eftersom undantaget innehåller information om databasanslutningen inkluderande användarnamn och lösenord. Om man vill få information om en query som misslyckades måste man sätta ett attribut.

```php
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

## Visa rapporterna

Nu ska vi göra ordning startsidan (index.php) som kommer att lista alla veckorapporter. Det här blir lite enklare, eftersom vi inte behöver använda oss av prepared statements. För att ta ut all data ur databasen kan vi använda följande SQL.

```php
$sql = "SELECT id, title, body, date FROM journals";
```
Varje rad i tabellen journals är en artikel. Det betyder att vi för varje rad behöver generera en artikel. Vi kan använda oss av en foreach slinga för att generera artiklarna. I koden ser du att vi stänger PHP taggen och fortsätter med lite HTML kod efteråt.

```php
foreach($dbh->query($sql) as $row):
```
På några ställen öppnar vi PHP taggarna igen och skriver ut värdena som erhölls från databasen. Vi gör det för titeln, länkarna, datumet och själva innehållet.

```php
<h2 class="article-title"><?php echo $row['title']; ?></h2>
```

\textbf{Tips:} I PHP 5.4+ kan du istället använda
\texttt{\textless{}?=\ \$row{[}{'}title{'}{]};\ ?\textgreater{}}.

Slutligen stänger vi slingan.

```php
<?php endforeach; ?>
```

## Redigera rapporter

Som du märkt la vi till rapportens id i redigera och ta bort länken. Skapa en ny fil kallad `edit.php`. Vi kommer att använda id:n för att hämta rapporten från databasen så att vi kan fylla alla fält med nuvarande innehåll. Här kommer vi återigen använda oss av en prepared statement. Den kommer att vara lik sidan där man skapar rapporter.

```php
$stmt = $dbh->prepare("SELECT title, body, date
                      FROM journals
                      WHERE id = :id");
```

Rapportens id som skickades med i GET förfrågan kan vi extrahera från `$_GET` variabeln och därefter koppla till :id parametern.

```php
$stmt->bindParam(':id', $_GET['id']);
```

Eftersom queryn returnerar endast en rad, behöver vi till skillnad från tidigare inte göra någon slinga. Utan kan vi hämta ut det första värdet med `fetch` metoden.

```php
$row = $stmt->fetch();
```

Vi använder attributet `value` för att sätta in texten i fälten. För att uppdatera posten i databasen använder vi en UPDATE sats. Glöm inte WHERE satsen, annars kommer alla rapporter att uppdateras och få samma innehåll.

```php
$stmt = $dbh->prepare("UPDATE journals
                       SET title = :title, body = :body
                       WHERE id = :id");
```

## Radera rapporter

Sist av allt ska användaren kunna ta bort rapporter. Detta kommer att göras i filen med namnet `delete.php`. Jag gjorde ett enkelt formulär som endast innehåller en Radera-knapp. Om användaren klickar på knappen tar vi bort rapporten och återvänder användaren till startsidan.

```php
$stmt = $dbh->prepare("DELETE FROM journals
                       WHERE id = :id");
```
