<?php
class emprunt{
	private $codeAcces;
	private $codeSecret;
	private $dateE;
	private $heureE;
	private $dateRetour;
	private $heureRetour;
	private $numV;
	private $o_leVelo;
	
	public function __construct($theLigne, $theVelo=null){
		$this->codeAcces=$theLigne['codeAcces'];
		$this->codeSecret=$theLigne['codeSecret'];
		$this->dateE=$theLigne['dateE'];
		$this->heureE=$theLigne['heureE'];
		$this->dateRetour=$theLigne['dateRetourn'];
		$this->heureRetour=$theLigne['heureRetour'];
		$this->numV=$theLigne['numV'];
		$this->o_leVelo=$theVelo;
	}
}