<?php

$output = <<<EOD

<h3>Kmom2</h3>
<p>Länk till DiceGame: <a href="dicegame.php">DiceGame</a></p>

<ul>
<li><strong>Hur väl känner du till objektorienterade koncept och programmeringssätt?</strong>
<p>
	Har programmerat lite i C# och Java sedan tidigare, så själva konceptet med objektorienterad programmering är inget nytt.<br>
	Men det är många nya saker, och mycket annorlunda syntax, i PHP.
	<br>
	Tänkte för denna uppgift prova på Zend Studio som utvecklingsmiljö, men fick den inte att starta - bara kraschar vid uppstart. Det var synd, för den verkar ha mycket
	användbara funktioner, som att snabbt kunna hoppa mellan klasser/metoder. Netbeans har liknande funktionalitet, så jag ska försöka prova den till nästa uppgift.
</p>
</li>

<li><strong>Jobbade du igenom oophp20-guiden eller skumläste du den?</strong>
<p>
	Jag jobbade genom hela guiden, som var väldigt bra! Massor med nyttig information, och intressanta exempel. Tappade tråden lite när konceptet med att 
	spara "state" i sessionen togs upp, och förstod inte det till 100% om jag ska vara ärlig. Hade varit intressant att se den färdiga koden till exemplet som gicks igenom.<br>
	Funktionaliten med att automatiskt ladda in klasser är mycket bra, och gör det hela mycket enkelt att bygga på med nya klasser, utan att behöva köra en massa include-satser överallt.
</p>
</li>

<li><strong>Berätta om hur du löste uppgiften med tärningsspelet 100, hur tänkte du och hur gjorde du, hur organiserade du din kod?</strong>
<p>
	Jag gjorde lite annorlunda än det var tänkt, tror jag. Gjorde om det så att det istället går ut på att få så hög poäng som möjligt - inte bara komma till 100, vilket är svårt nog.
	Spelet fortsätter även efter 100 och använder istället en "high score"-lista för att hålla koll på resultatet. 
</p>
<p>
	Återanvände tärnings-klassen (CDice) från teorimomentet, även om den enbart kastar en tärning åt gången. Skapade en till klass för själva spelmomentet, 
	DiceGame, som sköter själv spel-loopen och användargränssnittet mot användaren. Har sysslat lite mer spelprogrammering tidigare, så jag försökte 
	göra en "game loop", vilket inte blev så himla bra... PHP synkrona exekvering gör det svårt att få samma uppbyggnad, så jag fick tänka om lite.<br>
	Skulle jag göra om uppgiften på nytt hade jag nog gjort den med AJAX, och skött uppdatering och inladdning av filer och klasser från JavaScript.<br>
	Sparar kontinuerligt namn och poäng i en sessionsvariabel, och läser/skriver till dessa under spelets gång.<br>
	För att spara high score skapades en databas på MySQL-servern som sparar namn på spelaren, poäng och datum. En klass för att ansluta mot databas och skicka/ta emot data skapades - DBCon.
	<br>Måste passa på att berömma hur elegant Source plockar bort användarnamn och lösenord - tjusigt!
</p>
</li>

EOD;
	
return $output;