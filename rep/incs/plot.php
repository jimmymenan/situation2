<?php
class Plot{
	private $numP;
	private $numS;
	private $etatP;
	private $numV;
	private $o_maStation;
	private $o_monVelo;
	
	public function __construct($theLigne, $theStation=null, $theVelo=null){
		$this->numP=$theLigne['numP'];
		$this->numS=$theLigne['numS'];
		$this->etatP=$theLigne['etatP'];
		$this->numV=$theLigne['numV'];
		$this->o_maStation=$theStation;
		$this->o_monVelo=$theVelo;
	}

// sérialisation 
	public function getAjaxReturn() {
		$tmp  = $this->numP.'$' ;
		$tmp .= $this->numS.'$' ;
		$tmp .= $this->etatP.'$' ;
		$tmp .= $this->numV;
		return $tmp ;
	}
	
	public function getNumP() {
		return $this->numP ; 
	}
	
	public function getMonVelo() {

		return $this->o_monVelo = SI::getSI()->getLeVeloDuPlot($this) ;		
	}
	
	public function ligneTableEmprunt() {
			echo '<tr><td>' ;
			echo $this->numP ;
			echo '</td><td>' ;
			echo $this->etatP ;
			echo '</td><td>' ;
			echo $this->numV ;
			echo '</td><td>' ;
			if(!$_SESSION['emprunteUnVelo'] && $this->o_monVelo!=null){
				echo '<a href="station.php?emprunt=numP;&station=numS';
			}
			echo '</td></tr>' ;
		}
}


Class Plots extends Pluriel {
	public function __construct () {
		parent::__construct() ;					
	}
	
	public function tableDesPlotsEmprunt() {
			echo '<table>' ;
			foreach ($this->TB as $P) {
				$P->ligneTableEmprunt() ;
			}
			echo '</table>' ;
	}
}
?>