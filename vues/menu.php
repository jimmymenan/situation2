<div id="menu">
	<!-- On commence d'abord par afficher les actions communes a tous les utilisateurs -->
	<a href="ListeStation.php">Liste des Stations</a>&nbsp;
	<a href="ConditionsDutilisation.php">Conditions d'utilisation</a>&nbsp;
	<a href="tarifs.php">Tarifs</a>&nbsp;
	<?php 
	// Cette page affiche le menu. Comme les options du menu sont diff�rentes pour chaque type
	// D'utilisateur, il convient de v�rifier de qui il s'agit.
	
	// Pour �viter les erreurs, on v�rifie l'existence de la varible session
	// permettant de savoir s'il l'utilisateur est connect�
		if(isset($_SESSION['logged'])){ 
			if ($_SESSION['logged'] != null){ // On v�fifie ensuite qu'elle n'est pas vide
				switch($_SESSION['logged']){ // On regarde de quel type d'utilisateur il s'agit
					case "user":
						// On v�rifie en premier s'il s'agit d'un utilisateur (le plus probable)
						// On lui affiche alors l'acces � ses infomations/consommation
						echo'<a href="detailUsager.php">Consulter ses informations</a>&nbsp';
						break;
					case "technicien":
						// S'il s'agit du technicien, on lui affiche la page de maintenance
						echo'<a href="Maintenance.php">Maintenance</a> ';
						break;
					case "personnel":
						// Enfin, si c'est membre du personnel, on lui donne les options de 
						// gestion des utilisateurs
						echo '<a href="detailUsager.php">Consulter ses informations</a>&nbsp';
						echo '<a href="sAbonner.php">Cr&eacute;er un abonnement</a>&nbsp';
						break;
				}
				// Dans tous les cas, on doit laisser � l'utilisateur la possibilit� de se d�connecter
				echo '<a href="deconnexion.php">Se d&eacute;connecter</a>&nbsp';
			}
		}else{
			echo '<a href="connexion.php">Se connecter</a>&nbsp';
			echo '<a href="sAbonner.php">S\'abonner</a>&nbsp';
		}
		// On affiche en dernier les actions communes a tous les types d'utilisateurs
        echo '<a href="simulation.php">Simulateur</a>&nbsp';
	?>
		
		
</div>