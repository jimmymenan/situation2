<?php 
require_once '../incs/si.php';
require_once '../incs/station.php';
require_once '../incs/abonne.php';
require_once '../incs/velo.php';
$mySI=SI::getSI();
$stations=$mySI->getLesStations();
$_SESSION['identifie']=$mySI->getLAbonne("123456","1234");
//$monEmprunt=$mySI->getLeVeloEmprunt($_SESSION['identifie']);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VLib</title>

<script type="text/javascript" src="../scripts/simulation.js"></script>
</head>
<!--  onLoad="afficherVeloEprunte()" -->
<body>
	<div id="haut">
		VLib
	</div>
	
	<?php include("../vues/menu.php")?>
	
	<div id="simulation">
	
		<div id="lesStations">Liste des stations :	<?php $stations->faireUnSelect();?>	</div>
	
		<div id="emprunt"></div>

		<div id="listePlots"></div>
		
	</div>

</body>
</html>