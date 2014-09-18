<?php 
/* Game logic class */
class DiceGame {
	private $current_score;
	private $current_throw;
	private $current_highscore;

	private $db = NULL;

	public function __construct() {
		/* Create DB-connection */
		$this->db = new DBCon();

		/* Read current HighScore */
		$this->current_highscore = $this->db->GetHighScore();
	}

	/* Interface */
	public function GameRound() {
		$output = "";
		/* Name and score */
		$output = "<p class='diceplayer'>Spelare: " . $_SESSION['name'] . "</p>\n";
		$output .="<p class='dicescore'>Nuvarande poäng: " . $_SESSION['score'] . "</p>\n";
		$output .="<p class='dicehighscore'>Highscore: " . $this->GetHighScore() . "</p>\n";

		/* Check if High Score */
		if($this->current_score > $this->GetHighScore()) {
			$output .="<p class='dicehighscorereached'>Du har nått High Score! Avsluta för att spara.</p>\n";
		} 

		/* Buttons */
		$output .= "<section id='dicebuttons'>\n";

		$output .= "<a href='dicegame.php?option=1'>Kasta tärning</a>\n";
		$output .= "<a href='dicegame.php?option=2'>Stanna</a>\n";
		$output .= "<a href='dicegame.php?option=3' class='diceend'>Avsluta</a>\n";

		$output .= "</section>\n";

		$output .= $this->GetHighScoreTable();

		return $output;
	}

	/* Save current score */
	private function SaveScore() {	
		$this->current_score = $this->GetScore() + $this->current_throw;
		$_SESSION['score'] =  $this->current_score;
	}

	/* Get current score */
	public function GetScore() {
		return (int)($_SESSION['score']);
	}

	/* Throw dice */
	public function ThrowDice() {
		$dice = new CDice();
		$this->current_throw = $dice->RollDice(1);

		/* Check if its = 1 */
		if($this->current_throw == 1) {
			$this->current_score = 0;
			$_SESSION['score'] = 0;
		} else {
			$this->SaveScore();
		}

		$output = "<p class='dicethrow'>Ditt kast blev: " . $this->current_throw . "</p>\n";
		/* Draw dice */
		$output .= "<div class='dice" . $this->current_throw . "'></div>\n";
		$output .= $this->GameRound();

		return $output;
	}

	/* Save High Score */
	public function SaveHighScore() {

	}

	/* Get High Score */
	public function GetHighScore() {
		return (int)($this->current_highscore);
	}

	/* End game */
	public function EndGame() {		
		/* End message */
		$output = "";		

		$output .= "<p class='diceendgame'>Du avslutade spelet på " . $this->GetScore() . " poäng.</p>\n";
				
		/* Check if High Score */
		if($this->GetScore() > $this->GetHighScore()) {
			$output .= "<p>Du fick High Score! Ditt resultat är sparat till databasen.</p>\n";
			$this->db->SaveHighScore();
		} else {
			/* Save anyway */
			$this->db->SaveHighScore();
		}

		/* Buttons */
		$output .= "<section id='dicebuttons'>\n";
		$output .= "<a href='dicegame.php'>Ladda om</a>\n";
		$output .= "</section>\n";

		/* End session */
		$_SESSION['name'] = "";
		$_SESSION['score'] = 0;
		session_destroy();

		$output .= $this->GetHighScoreTable();

		return $output;
	}

	/* Highscore table */
	public function GetHighScoreTable() {
		//Add Highscore Table
		$output = "<section id='highscoretable'>\n";
		$output .= "<h3>High Score</h3>\n";
		$output .= $this->db->GetHighScoreList();
		$output .= "</section>\n";
		
		return $output;
	}
}