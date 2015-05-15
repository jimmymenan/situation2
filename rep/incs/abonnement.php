<?php
class Abonnement{
	private $codeA;
	private $libelleA;
	private $dureeA;
	private $montantA;
	private $creditTempsBase;
	private $tarifHoraire;
	private $caution;
	private $typeA;
	
	public function __construct($theLigne){
		$this->codeA=$theLigne['codeA'];
		$this->libelleA=$theLigne['libelleA'];
		$this->dureeA=$theLigne['dureeA'];
		$this->montantA=$theLigne['montantA'];
		$this->creditTempsBase=$theLigne['creditTempsbase'];
		$this->tarifHoraire=$theLigne['tarifHoraire'];
		$this->caution=$theLigne['caution'];
		$this->typeA=$theLigne['typeA'];
	}
public function getCodeA(){return $this->codeA;}

public function LigneTable(){
	echo '<tr><td>' ;
	echo $this->codeA ;
	echo '</td><td>' ;
	echo $this->libelleA ;
	echo '</td><td>' ;
	echo $this->dureeA ;
	echo '</td></tr>' ;
	echo $this->montantA ;
	echo '</td><td>' ;
	echo $this->creditTempsBase ;
	echo '</td><td>' ;
	echo $this->tarifHoraire ;
	echo '<tr><td>' ;
	echo $this->caution ;
	echo '</td><td>' ;
	echo $this->typeA ;
	echo '</td></tr>' ;}

	}
class Abbonnements extends pluriel {
		public function _construct() {
				parent::_construct();}

/*function TableDesAbonnements(){
	echo '<table>';
	foreach ()
}*/


}

?>