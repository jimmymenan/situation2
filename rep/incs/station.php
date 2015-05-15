<?php
class Station{
	private $numS;
	private $nomS;
	private $capaciteS;
	private $situationS;
	private $numBorne;
	private $DernierEtat;
	private $o_lesPlots;
	
	public function __construct($theLigne){
		$this->numS=$theLigne['numS'];
		$this->nomS=$theLigne['nomS'];
		$this->capaciteS=$theLigne['capaciteS'];
		$this->situationS=$theLigne['situationS'];
		$this->numBorne=$theLigne['numBorne'];
		$this->dernierEtatS=$theLigne['dernierEtatS'];
		$this->o_lesPlots = null;
	}
	
	// sérialisation 
	public function getAjaxReturn() {
		$tmp  = $this->numS.'$' ;
		$tmp .= $this->nomS.'$' ;
		$tmp .= $this->capaciteS.'$' ;
		$tmp .= $this->situationS.'$' ;
		$tmp .= $this->numBorne.'$' ;
		$tmp .= $this->dernierEtatS;
		return $tmp ;
	}
	
	public function getNumS() {
		return $this->numS ;
	}
	
	public function getMesPlots() {
		// si pas encore de liste, la créer
		if ($this->o_lesPlots ==null) {
			$this->o_lesPlots = SI::getSI()->getLesPlotsDeLaStation($this) ;
		}			
		return $this->o_lesPlots;
	}
	
	public function optionSelect() {
			echo '<option value="'.$this->numS.'">'.$this->nomS.'</option>' ;
		}
}

Class Stations extends Pluriel {
	public function __construct () {
		parent::__construct() ;							
	}
	
	public function faireUnSelect() {
			echo '<select id="IDSTA" onChange="choixStation(this)">' ;
			foreach ($this->TB as $D) {$D->optionSelect();}
			echo '</select>' ;
		}
}


?>