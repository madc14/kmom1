<?php
/* Klassfil för klassen CDice */
class CDice {

  private $faces;

  /* Konstruktor */
  public function __construct($faces=6) {
      $this->faces = $faces;
    }

  /* Medlemsvariabel för att spara kast */
  private $rolls = array();

  /* Metod för att kasta tärningar, och returnera resultatet */

  public function RollDice($times) {
    for($i = 0; $i < $times; $i++) {
        $this->rolls[] = rand(1, $this->faces);
    }

    return $this->GetTotal();
  }

  /* Returnerar den sammanslagna totalsumman av kast */
  public function GetTotal() {
    return array_sum($this->rolls);
  }
}