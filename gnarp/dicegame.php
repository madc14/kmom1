<?php 
/* Page controller */
include(__DIR__ . "/includes/config.php");

$settings['page_title'] = "Dice Game";

$output = "<p><strong>Dice game</strong> går ut på att försöka få ihop så många poäng som möjligt. 
<br>Summan av alla tärningsslag räknas samman - men får man
 siffran 1 vid ett kast, då åker summan tillbaks på noll. Får man high score så måste man avsluta pågående spel för att poängen skall sparas - omm man inte vill vara modig och försöka 
 göra ännu ett kast vill säga... :-)<br><br>";

// Create DiceGame
$diceGame = new DiceGame();

/* Main Page Content */
$settings['page_content'] = "<h2>Dice Game</h2>\n";

/* Game start check */
if(isset($_POST['name'])) {
	$name = $_POST['name'];
	$_SESSION['name'] = $name;
	/* Reset score to 0 */
	$_SESSION['score'] = 0;
}

/* Is game in progress? */
if(isset($_SESSION['name'])) {

	// Continue game
	if(isset($_GET['option'])) {
		$option = $_GET['option'];
		if($option == 1) {
			//New throw
			$settings['page_content'] .= $diceGame->ThrowDice(1);
		} 
		elseif($option == 2) {
			//Stop and save
			$settings['page_content'] .= $diceGame->EndGame();
		} 
		else {
			//End game/session
			$settings['page_content'] .= $diceGame->EndGame();
		}
	} else {
		// Display interface 
		$settings['page_content'] .= $diceGame->GameRound();
	}

} else {
	//Its not - display welcome
	$output .= "<p>Skriv in namn och klicka på på Starta.</p>\n";
	$output .= "<form method='post' action='dicegame.php'>\n";
	$output .= "Namn: <input type='text' name='name' class='diceinput'><input type='submit' value='Starta' class='dicebutton'>\n";
	$output .= "</form>\n";
	
	$settings['page_content'] .= $output;
}

/* Render page */
include(GNARP_THEME_PATH);