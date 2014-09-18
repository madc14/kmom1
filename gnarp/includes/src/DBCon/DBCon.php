<?php
/* Class for DB-connections */
class DBCon {
	/* Connection settings */
	
	private $host = "blu-ray.student.bth.se";
	private $database = "madc14";
	private $username = "madc14";
	private $password = "5M7Pc2;T";

	private $dbc = NULL;

	/* Konstruktor */
  	public function __construct() {
    	$this->dbc = mysqli_connect($this->host, $this->username, $this->password, $this->database) or die('Error connecting');
    }

    public function Disconnect() {
    	mysqli_close ($this->dbc);
    }

    public function GetHighScore() {
    	$query = "SELECT MAX(score) FROM dicegame;";
    	$result = mysqli_query($this->dbc, $query);
    	$row = mysqli_fetch_array($result);

    	return $row[0];
    }

    public function SaveHighScore() {
    	$name = $_SESSION['name'];
    	$score = $_SESSION['score'];
    	$query = "INSERT INTO dicegame(name, score)values('$name', $score);";
    	$result = mysqli_query($this->dbc, $query);

    }

    public function GetHighScoreList() {
    	$output = "<ul>\n";
    	$query = "SELECT * FROM dicegame ORDER BY score DESC limit 5";
    	$result = mysqli_query($this->dbc, $query);
    	
    	while ($row = mysqli_fetch_array($result)) {
			$name = $row['name'];
			$score = $row['score'];
			$date = $row['date'];

			
			$output .="<li>$name - $score - " . showDate($date) . "</li>\n";

		}

		$output .= "</ul>\n";

    	return $output;	

    	$this->Disconnect();
    }
}


