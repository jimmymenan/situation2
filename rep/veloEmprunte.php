<?php
	require_once ('../incs/SI.php');
	require_once ('../incs/velo.php');
	
	if (!isset($_GET['usager'])) {
		echo '0';
	} else {
		$velE = SI::getSI()->getUnVeloEmprunT($_GET['usager']);
		$velE->afficherVeloEmprunT();
		if($velE!=null){
			$_SESSION["emprunteUnVelo"] = false;
		}else{
			$_SESSION["emprunteUnVelo"] = true;
		}
		
		
	}
?>