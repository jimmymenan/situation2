<?php
//Classe Abonne
class Abonne{
	private $codeAcces;
	private $codeSecret;
	private $numTelAbo;
	private $emailAbo;
	
	private $nomAbo;
	private $prenomAbo;
	private $dateNaissAbo;
	private $adresse;
	private $CPabo;
	private $villeAbo;
	Private $o_monAbonnement ;
	private $o_mesEmprunts;

//Constructeur de la classe Abonne
public function __construct($theLigne, $theAbonnement=null, $theEmprunts=null) {
			$this->codeAcces = $theLigne['codeAcces'] ;
			$this->codeSecret = $theLigne['codeSecret'] ;
			$this->numTelAbo = $theLigne['numTelAbo'] ;
			$this->emailAbo = $theLigne['emailAbo'] ;
			
			$this->nomAbo=$theLigne['nomAbo'];
			$this->prenomAbo=$theLigne['prenomAbo'];
			$this->dateNaissAbo=$theLigne['dateNaissAbo'];
			$this->adresse=$theLigne['adresse'];
			$this->CPabo=$theLigne['CPabo'];
			$this->villeAbo=$theLigne['villeAbo'];
			
			$this->o_monAbonnement = $theAbonnement ;
			$this->o_mesEmprunts = $theEmprunts;
		}
		
//Fonction pour retourner le codeAcces qui est important
public function getCodeAcces() {return $this->codeAcces ; }
public function getNom() {return $this->nomAbo ; }
public function getPrenom() {return $this->prenomAbo ; }
public function getTelFixe() {return $this->numTelFixeAbo ; }
public function getDate() {return $this->dateNaissAbo ; }
public function getAdresse() {return $this->adresse ; }
public function getCP() {return $this->CPabo ; }
public function getVille() {return $this->villeAbo ; }


/*public static function getAbo() {
	if (Abonne::$os_Abonne==null) {
		Abonne::$os_Abonne = new Abonne() ;
	}
	return Abonne::$os_Abonne ;
}	*/
	
//Fonction pour retourner l'abonnement de l'abonnee
public function getAbonnement(){
	return $this->o_monAbonnement;
    }
    

    
    //Fonction pour retourner les propri�t�es de Abonne sous forme de ligne
    public function LigneTable(){
    	echo '<tr><td>' ;
    	echo $this->codeAcces ;
    	echo '</td><td>' ;
    	echo $this->codeSecret ;
    	echo '</td><td>' ;
    	echo $this->o_monAbonnement;
    	echo'</td><td><form name="modif" action="../vues/PersoModificationUsager.php?codeAcces='.$this->codeAcces.'&codeSecret='.$this->codeSecret.'" method="post">
    			<input type="submit" value="Modifier"> 



</form></td>
    			 
    			<td><form name="suppr" action="../vues/Supprimer.php?codeAcces=$this->codeAcces&codeSecret=$this->codeSecret" method="post" > 
    			<input type="submit" value="Supprimer"> </form></td></tr>';
    }
	
public function optionSelect() {
	echo '<option value="' ;
	echo $this->codeAcces ;
	echo '">' ;
	echo $this->codeAcces ;
	echo '</option>' ;
}


public function faireUnform() {
		echo ' <form method="post" action="" id="formmodif" >';
		echo' <p><label>Nom :</label><input type="text" name="nom" value="';
		echo $this->codeAcces ;
		echo'/>';
		/////a finir
		echo'
		<p><label>Prenom :</label><input type="text" name="prenom" value="'.$prenom.'"/>
		<p><label>Date de naissance :</label><input type="text" name="date" value="'.$date.'"/>
		<p><label>numero de telephone :</label><input type="text" name="numtel" value="'.$numtel.'"/>
		<p><label>adresse :</label><input type="text" name="adresse" value="'.$adresse.'"/>
		<p><label>Code postal :</label><input type="text" name="cp" value="'.$cp.'"/>
		<p><label>ville :</label><input type="text" name="ville" value="'.$ville.'"/>'
		;
}

}
//Classe AbonneInfo qui herite de Abonne
/*Class AbonneInfo extends Abonne {
	private $numTelFixeAbo;
	private $nomAbo;
	private $prenomAbo;
	private $dateNaissAbo;
	private $adresse;
	private $CPabo;
	private $villeAbo;

//Constructeur de la classe fille AbonneInfo
	function __construct($codeAcces, $codeSecret, $numTelAbo, $emailAbo, $theLigne) {
	
		parent::__construct($codeAcces, $codeSecret, $numTelAbo, $emailAbo);
 	
		$this->numTelFixeAbo=$theLigne['numTelFixeAbo'];
		$this->nomAbo=$theLigne['nomAbo'];
		$this->prenomAbo=$theLigne['prenomAbo'];
		$this->dateNaissAbo=$theLigne['dateNaissAbo'];
		$this->adresse=$theLigne['adresse'];
		$this->CPabo=$theLigne['CPabo'];
		$this->villeAbo=$theLigne['villeAbo'];
	}
	
public function getNom(){ return $this->nomABo;}	

}*/

Class Abonnes extends Pluriel {
		public function __construct () {
			parent::__construct() ;							
		}
		
		public function faireUnSelect() {
			echo '<select id="idAbo" onChange="afficherEmprunt(this)">' ;
			foreach ($this->TB as $A) { $A->optionSelect();}
			echo '</select>' ;
		}
		
		

//Fonction qui renvoie un tableau des abonn�es
function TableDesAbonnees(){
	echo '<table>
			<tr><td colspan=2>Abonnes</td><td>Abonnement</td></tr>';
	foreach ($this->TB as $A){$A->LigneTable();}
		echo'</table>
				<form name="ajout" action="../vues/AjouterUsager.php" > <input type="submit" value="Ajouter"> </form>';
	
	
}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	}