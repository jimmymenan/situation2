<?php
	Class SI {
		Private static $os_SI ;
		Private $connex ;
	
	
		private $o_lesStations ;
		private $o_lesVelos ;
		private $o_lesAbonnes ;
	
		private function __construct() { 
			$this->connex = mysqli_connect("127.0.0.1","root","","vlib") ;
			$this->o_lesStations = null ;
			$this->o_lesAbonnes = null;
			$this->o_lesVelos = null;
		}
	
		
		public static function getSI() {
			if (SI::$os_SI==null) {
				SI::$os_SI = new SI() ;
			}
			return SI::$os_SI ;
		}
		
	////////Ajax///////////////////////
		public function ajaxPlotsStation($numS) {
			$lst = $this->chargerLesPlotsDeLastation($numS, $objStation=null) ;
			$deja = false ;
			foreach ($lst->TB as $plot) { 
				if ($deja) {echo '#'; }
				echo $plot->getAjaxReturn();
				$deja = true ;
			}
		}
		
		public function ajaxVelo($numV) {
			$lst = $this->chargerVelo($numV) ;
			foreach ($lst->TB as $velo) { 
				echo $velo->getAjaxReturn();
			}
		}
		
		public function ajaxEtatStation($numS) {
			$lst = $this->chargerStation($numS) ;
			foreach ($lst->TB as $station){
				echo $station->getAjaxReturn();
				
			}
		}
		
		
		
		
		
		 public function changementEtatV($numV ,$etatV){
			$req = "INSERT INTO Maintenancev VALUES (CURDATE(), '$etatV', $numV)" ;
			$rs = $this->connex->query($req);
			
			$req = "update velo set etatV='$etatV' where numV='$numV'"; ;
			$rs = $this->connex->query($req);
			SI::getSI()->ajaxVelo($numV);
		}
		
		 public function changementEtatS($numS ,$etatS){
			$req = "INSERT INTO Maintenances VALUES (CURDATE(),  $numS, '$etatS')" ;
			$rs = $this->connex->query($req);
			
			$req = "update station set dernierEtatS='$etatS' where numS='$numS'"; ;
			$rs = $this->connex->query($req);
			SI::getSI()->ajaxEtatStation($numS);
			
		}
		
		 public function changementEtatP($numS ,$numP,$etatP){
			$req = "INSERT INTO Maintenancep VALUES (CURDATE(), $numP, $numS, '$etatP')" ;
			$rs = $this->connex->query($req);
			
			$req = "update plot set etatP='$etatP' where numS='$numS' and numP='$numP'"; ;
			$rs = $this->connex->query($req);
			SI::getSI()->ajaxPlotsStation($numS);
		}
		
		
		
	///////en rapport avec les abonn�es//////////
	//get de la liste des abonn�es
	public function getLesAbonnes(){
		//si pas encore de liste, la cr�er
		if ($this->o_lesAbonnes == null){
			$this->o_lesAbonnes = $this->chargerAbonnes();
		}
		return $this->o_lesAbonnes;
	}	
	
	private function chargerAbonnes(){
		$result = new Abonnes();
		$req = 'SELECT codeAcces, codeSecret, numTelAbo, numFixeAbo, emailAbo, nomAbo, prenomAbo, dateNaissAbo, adresse,
				CPabo, villeAbo, codeA
				FROM abonne' ;
		$rs = $this->connex->query($req);
		while ($ligne = $rs->fetch_array()){
			$tmp=new Abonne($ligne);
			$result ->TB[$tmp->getCodeAcces()] = $tmp;
		}
		$rs->free();
		return $result;
	}
	public Function GetLAbonne($codeAcces,$codeSecret){
		$req = 'SELECT codeAcces, codeSecret, numTelAbo, numFixeAbo, emailAbo, nomAbo, prenomAbo, dateNaissAbo, adresse,
				CPabo, villeAbo, codeA
				FROM abonne 
				WHERE codeAcces='.$codeAcces.' 
				AND codeSecret='.$codeSecret ;
		$rs = $this->connex->query($req);
        $result = new Abonnes();
		while ($ligne = $rs->fetch_array()){
			$tmp=new Abonne($ligne);
			$result->TB[$tmp->getCodeAcces()] = $tmp;
		}
		$rs->free();
		if(!isset($result)){
			return null;
		}else{
			return $result;
		}
	
	
	}
		
	///////en rapport avec les stations, les plots et les velos///////////
	
		// get de la liste des stations
		public function getLesStations() {
			// si pas encore de liste, la créer
			if ($this->o_lesStations == null) {
				$this->o_lesStations = $this->chargerStations();
			}
			return $this->o_lesStations;
		}
		
	private function chargerStations() {
			$result = new Stations() ;
			$req = 'SELECT numS,nomS,capaciteS,situationS,numBorne,dernierEtatS FROM station ORDER BY numS' ;
			$rs = $this->connex->query($req) ;				
			While ($ligne = $rs->fetch_array()) { 
				$tmp = new Station($ligne);	
				$result->TB[$tmp->getNumS()] = $tmp ;
			}
			$rs->free() ;
			return $result ;
		}
		
	private function chargerStation($numS) {
			$result = new Stations() ;
			$req = "SELECT numS,nomS,capaciteS,situationS,numBorne,dernierEtatS FROM station where numS='$numS'" ;
			$rs = $this->connex->query($req) ;				
			While ($ligne = $rs->fetch_array()) { 
				$tmp = new Station($ligne);	
				$result->TB[$tmp->getNumS()] = $tmp ;
			}
			$rs->free() ;
			return $result ;
		}
		
		// get de la liste des velos
		public function getLesVelos() {
			// si pas encore de liste, la créer
			if ($this->o_lesVelos == null) {
				$this->o_lesVelos = $this->chargerVelos();
			}
			return $this->o_lesVelos;
		}
		
		private function chargerVelos() {
			$result = new Velos() ;
			$req = "SELECT numV, DMEC, etatV, numP, numS FROM velo order by numV " ;
			$rs = $this->connex->query($req) ;				
			While ($ligne = $rs->fetch_array()) { 
				$tmp = new Velo($ligne);	
				$result->TB[$tmp->getNumV()] = $tmp ;
			}
			$rs->free() ;
			return $result ;
		}
		
		private function chargerVelo($numV) {
			$result = new Velos() ;
			$req = "SELECT numV, DMEC, etatV, numP, numS FROM velo where numV='$numV'" ;
			$rs = $this->connex->query($req) ;				
			While ($ligne = $rs->fetch_array()) { 
				$tmp = new Velo($ligne);	
				$result->TB[$tmp->getNumV()] = $tmp ;
			}
			$rs->free() ;
			return $result ;
		}
		
		
		
		///get de la liste des plots de la station
		public function getLesPlotsDeLaStation ($objStation) {
			return $this->chargerLesPlotsDeLastation($objStation->getNumS(), $objStation);
		}
		
		private function chargerLesPlotsDeLastation($codeStation, $objStation = null) {
			$result = new Plots() ;
			$req = "SELECT numP,numS,etatP,numV FROM plot WHERE numS='$codeStation' ORDER BY numP" ;
			$rs = $this->connex->query($req) ;				
			While ($ligne = $rs->fetch_array()) { 
				$tmp = new Plot($ligne, $objStation, $objetVelo=null);	
				$result->TB[$tmp->getNumP()] = $tmp ;
			}
			$rs->free() ;
			return $result ;
		}
		
		////get du velo du plot
		public function getLeVeloDuPlot ($objplot) {
			return $this->ChargerLeVeloDuPlot($objplot->getNumP(), $objplot);

		}
		
		private function ChargerLeVeloDuPlot($codeplot, $objplot) {
			$result = new velos() ;
			$req = "SELECT numV, DMEC, etatV, numP, numS FROM velo WHERE numP='$codeplot' " ;
			$rs = $this->connex->query($req) ;				
			While ($ligne = $rs->fetch_array()) { 
				$tmp = new Velo($ligne, $objplot);	
				$result->TB[$tmp->getNumV()] = $tmp ;
			}
			$rs->free() ;
			return $result ;
		}
		
		////get du plot du velo
		public function getLePlotDuVelo ($objvelo) {
			return $this->ChargerLePlotDuVelo($objvelo->getNumV(), $objvelo);
		}
		
		private function ChargerLePlotDuVelo($codevelo, $objvelo) {
			$result = new Plots() ;
			$req = "SELECT numP,numS,etatP,numV FROM plot WHERE numV='$codevelo' " ;
			$rs = $this->connex->query($req) ;				
			While ($ligne = $rs->fetch_array()) { 
				$tmp = new plot($ligne,$objstation=null, $objvelo);	
				$result->TB[$tmp->getNumP()] = $tmp ;
			}
			$rs->free() ;
			return $result ;
		}
		
		public function getUnVeloEmprunT($objUsager){
			$codeAcces = $objUsager->getCodeAcces();
			$codeSecret = $objUsager->getCodeSecret();
			$req = "SELECT numV FROM emprunt 
					 WHERE codeAcces='$codeAcces'
					   AND codeSecret='$codeSecret'
					   AND dureeEmprunt IS NULL";
			$rs = $this->connex->query($req);
            $result = new Velos();
			while ($ligne = $rs->fetch_array()) {
				$tmp = new velo($ligne, null);
				$result->TB[$tmp->getCode()] = $tmp;
			}
			$rs->free();
			return $result;
		}
	
	/////////////////////////////////////////////////////////////////////
	//// Fonctions de connexion
	/////////////////////////////////////////////////////////////////////
	public function connexionPersonnel($login, $pass){
		$req = "SELECT login, pass
				FROM personnel
				WHERE login='".$login."'
				AND pass='".$pass."'" ;
		$rs = $this->connex->query($req);
		return $rs->num_rows;
	}

    public function connexionUtilisateur($codeAcces, $codeSecret){
        $result = null;
        $req = "SELECT codeAcces, codeSecret, numTelAbo, numFixeAbo, emailAbo, nomAbo, prenomAbo, dateNaissAbo, adresse, CPabo, villeAbo, codeA
                FROM abonne
                WHERE codeAcces = '".$codeAcces."'
                AND codeSecret = '".$codeSecret."'";
        $rs = $this->connex->query($req);
        if($rs->num_rows >0){
            while ($ligne = $rs->fetch_array()) {
                $result = new Abonne($ligne);
            }
        }
        return $result;

    }
	
	}
	
	Class Pluriel {
		Public $TB ;
		public function __construct() {
			$this->TB = array() ;			
		}
	}


?>