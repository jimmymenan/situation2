<?php
	require_once ('../incs/SI.php');
	require_once ('../incs/plot.php');
	require_once ('../incs/station.php');
	if (!isset($_GET['station'])) {
		SI::getSI()->ajaxPlotsStation('') ;
	} else {
		SI::getSI()->ajaxPlotsStation($_GET['station']);
	}
?>