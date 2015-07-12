# PHP: Hypertext Preprocessor

PHP är ett populärt skriptningsspråk som finns på nästan alla webbhotell. Initialt hette språket Personal Home Page och bestod endast av ett par skript skrivna i Perl språket, men växte snart till världens mest populära skriptningsspråk för webben. Facebook, Wikipedia och Yahoo! är allihoppa skrivna i PHP. Till skillnad från JavaScript, är PHP ett server-side skriptningsspråk, vilket betyder att allt genereras på servern. Det som är unikt med detta språk är att man kan inpränta PHP kod i ett HTML dokument.

```php
<?php
    echo "<p>Bacon ipsum</p>";
?>
```

Ovanstående kod skriver ut *Bacon ipsum*. PHP skrivs inom `<?php ?>` taggar och notera att alla regler slutar med ett semikolon. Till skillnad från tidigare skriven kod måste man ladda upp koden till en webbserver som stöder PHP. Säkerställ att suffixet på filens namn slutar på `.php`. När du har gjort det, kan du surfa till sidan och när allt fungerar som det ska bör du se texten "Bacon ipsum" som en paragraf.

## Variabler

Senare kommer vi bland annat att jobba med användarens inmatningar och eftersom vi inte vet vad personen kommer att mata in, behöver vi spara informationen någonstans i minnet så att vi sedan kan använda informationen. Det är vad *variabler* är till för.

Härnedan deklarerar jag en variabel med namnet *name*. Alla variabelnamn börjar med ett dollartecken och man behöver inte deklarera någon datatyp. I nedanstående exempel ser du att jag nu använder mig av enkla citattecken. PHP tillåter både enkla och dubbla citattecken, men de beter sig olika. Punkten används för att *konkatenera* strängarna. Det vill säga att man lägger ihop två strängar.

```php
<?php
    $name = 'Fabian Bakkum';
    echo 'Mitt namn är ' . $name;
?>
```

Ibland behöver man spara en lista. Detta kan man göra med så kallade *arrays*. Nedanstående kod skapar en ny array med ett flertal olika frukter och skriver sedan ut alla frukter.

```php
<?php
    $fruits = array("äpple", "banan", "melon");
    echo $fruits[0] . "\t";
    echo $fruits[1] . "\t";
    echo end($fruits);
?>
```

## Villkorssatser

if $\overbrace{(\$x == 5)}^\text{sant}$ {
    echo '$x är lika med 5';
}

Den ovannämnda koden är ett exempel på en if-sats och används för att kolla om ett uttryck är sant eller inte och exekverar passande kod.

Läs koden så här: Om $x är lika med 5, skriv ut att $x är lika med 5.

Man kan expandera if-satsen med en else-sats, i vilket man kan skriva koden som ska köras om uttrycket är falskt.

```php
<?php
    $x = 5;
    $y = 10;

    if ($y > $x) {
        echo '$y är större än $x';
    } else {
        echo '$y är inte större än $x';
    }
?>
```

Det finns en del *operatörer* man kan använda sig av:

* **==** - är lika med
* **===** - är identiskt med (datatypen är likadan)
* **!=** - är inte lika med
* **>** - större än
* **<** - mindre än
* **>=** - större än eller lika med
* **<=** - mindre än eller lika med

## Funktioner

Även fast du kanske inte har märkt, så har du använd dig av *funktioner*. En av dem funktioner du har stött dig på var `end()` funktionen, vilken *returnerade* det sista elementet i arrayn. Vi kan även skapa våra egna funktioner.

I följande exempel ser du att jag skapade en funktion kallad `sum`, vilken tar två *argument* och returnerar summan av dem två tal.

```php
<?php
	function sum($x, $y) {
		return $x + $y;
	}

	echo sum(1, 3);
?>
```

## Objektorienterad Programmering

Objektorienterad programmering är en programmeringsmetod, vilket har som mål att organisera koden. Tänk på ett objekt i det verkliga livet, allt är ett objekt, du är ett objekt, din dator, maten du äter, allt. Vi tar en hund som exempel. En hund kan ha flera egenskaper, den kan vara snäll, korthårig, svart och den kan göra olika saker, den kan gå, den kan skälla och den kan äta.

Nu ska vi göra om hunden till kod. En *klass* är en slags mall för att beskriva objektet.

```php
<?php
	class Dog {
		private $name;
		private $color;
		private $age;

		function __construct($name, $color, $age) {
		    $this->name = $name;
		}

		public function bark() {
			echo 'bark bark, my name is ' . $this->name;
		}
	}

    $scooby = new Dog("Scooby-Doo", "Brown", 13);
    $scooby->bark();
?>
```

Klassen innehåller tre egenskaper som har synligheten *private*. Det innebär att vi endast kan komma åt variablerna inuti själva klassen, men inte utanför. För alla egenskaper (variabler inom klassen) och metoder (funktioner inom klassen) gäller att man måste specificera synligheten. Det finns tre synligheter i PHP.

* **public** – man får komma åt variabeln utanför klassen.

* **protected** – man får inte komma åt variabeln utanför klassen, men föräldraklasser får komma åt variabeln.

* **private** – man får endast komma åt variabeln inom klassen.

Tidigare nämnde jag att alla metoder måste ha en synlighet. Det gäller dock inte för en *konstruktor*. En konstruktor är en metod i klassen som alltid körs när man skapar en ny instans av objektet. Egenskaper inuti klassen kommer man åt med variabeln *this*. Det finns en publik metod `bark` som vi kan anropa utanför klassen. Vi skapar en ny instans av objektet, `scooby` och kastar in tre argument. Slutligen anropar vi bark metoden på objektet.
