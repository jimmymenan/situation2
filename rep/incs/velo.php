<?php
class velo{
	private $numV;
	private $DMEC;
	private $etat;
	private $numP;
	private $numS;
	private $o_monPlot;
	
	public function __construct($theLigne, $thePlot = null){
		$this->numV=$theLigne['numV'];
		$this->DMEC=$theLigne['DMEC'];
		$this->etatV=$theLigne['etatV'];
		$this->numP=$theLigne['numP'];
		$this->numS=$theLigne['numS'];
		$this->o_monPlot = $thePlot;
	}
	
	public function getNumV() {
		return $this->numV ; 
	}
	
	public function getMonPlot() {

		return $this->o_monPlot = SI::getSI()->getLePlotDuVelo($this) ;	
	}
	
// sérialisation 
	public function getAjaxReturn() {
		$tmp  = $this->numV.'$' ;
		$tmp .= $this->DMEC.'$' ;
		$tmp .= $this->etatV.'$' ;
		$tmp .= $this->numP.'$' ;
		$tmp .= $this->numS;
		return $tmp ;
	}
		
	public function optionSelect() {
		echo '<option value="' ;
		echo $this->numV ;
		echo '">' ;
		echo 'n°';
		echo $this->numV ;
		echo '</option>' ;
	}
	
}

Class Velos extends Pluriel {
	public function __construct () {
		parent::__construct() ;							
	}
	
	public function afficherLeVeloEmprunT() {
		echo "Vous avez emprunt&eacute le v&eacutelo ";
		foreach($this->TB as $V) {
			echo $V->getNumV();
		}
	}
	
	public function faireUnSelect() {
		echo '<select id="IDV" onChange="choixVelo(this)">' ;
		foreach ($this->TB as $Ve) { $Ve->optionSelect();}
		echo '</select>' ;
	}
}