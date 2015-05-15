<?php session_start();
require_once '../incs/si.php' ;
require_once '../incs/abonne.php' ;
// Si l'utilisateur ne vient pas de valider le formulaire
//, on met une valeur de base dans le champ code codeAcces
if(!isset($_POST['codeAcces'])){ 
	$valueBaseCodeAcces=null;
}Else{
	$valueBaseCodeAcces=$_POST['codeAcces'];
}
// Si l'utilisateur vient de valider le formulaire on v�rifie la connexion
if(isset($_GET['connect'])){ 
	// Le type d'utilisateur qui se connecte se rep�re gr�ce aux valeurs entr�es
	switch ($_POST['codeAcces']){
		// Si le codeAcces est num�rique, il s'agit d'un utilisateur
		case is_numeric($_POST['codeAcces']):
			// On v�rifie les identifants
			$testConnex=SI::getSI()->connexionUtilisateur($_POST['codeAcces'], $_POST['codeSecret']);
			// Si l'identifiant est valide (trouv�e dans la bdd)
			if($testConnex!=null){
				// On ins�re dans des variables de session l'identit� du connect�
				$_SESSION['logged'] = "utilisateur";
				$_SESSION['identifie'] = $testConnex;
			}
			break;
		// L'identifiant du technicien est v�rifi� en dur, pour le diff�rencier du personnel
		case $_POST['codeAcces']=="techni":
			// On v�rifie en dur le mot de passe technicien
			if($_POST['codeSecret'] == "techni"){
				// Et on ins�re dans une variable session l'identit� du connect�
				$_SESSION['logged'] = "technicien";
			}
			break;
		// Si le codeAcces n'est pas numerique, il s'agit du personnel.
		case !is_numeric($_POST['codeAcces']):
			// On v�rifie dans la base de donn�e l'identit� du personnel qui se connecte
			$testConnex=SI::getSI()->connexionPersonnel($_POST['codeAcces'], $_POST['codeSecret']);
			// Si elle est 
			if($testConnex==1){
				// Et on ins�re dans une variable session l'identit� du connect�
				$_SESSION['logged'] = "personnel";
			}
			break;
			
	}
}

if(isset($_SESSION['logged'])){
    header("Location: ../index.php");
}
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>VLib</title>
</head>
<body>
	<div id="haut">
		VLib
	</div>
	
	<?php include("../vues/menu.php")?>
	
<div id="connexion">
      <h2>Connexion
      </h2>
      
      <!-- Ce div permet de v�rifier si la connexion a r�ussi ou non et qui s'est connect� -->
      <div id="resultConnex"><?php if(isset($_SESSION['logged']) && isset($_GET['connect'])){echo "Vous &ecirc;tes connect&eacute; en temps que ".$_SESSION['logged'];}
      		elseif(!isset($_SESSION['logged']) && isset($_GET['connect'])){echo "La connexion a &eacute;chou&eacute;e";}?></div>
   	  
   	  
   	  <!-- Formulaire de connexion -->
      <form action="connexion.php?connect" method="post">
         <table>
            <tr>
               <td><label for="codeAcces"><strong>Code Acces :</strong></label></td>
               <td><input type="text" name="codeAcces" id="codeAcces" value="<?php echo $valueBaseCodeAcces;?>" maxlength="6"/></td>
            </tr>
            <tr>
               <td><label for="codeSecret"><strong>Code Secret :</strong></label></td>
               <td><input type="password" name="codeSecret" id="codeSecret" maxlength="6"/></td>
            </tr>
         </table>
         <input type="submit" name="connexion" value="Se connecter"/>
      </form>
      <!-- Fin du formulaire de connexion -->
      
</div>
</body>
</html>

