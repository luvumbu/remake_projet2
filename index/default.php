<?php
$source_dbcheck = "info_exe/dbCheck.php";
$login = "index/login.php" ; 
 
// demande a l'utilisateur d'entre le nom de la bd puis la table puis le mot de passe 

// Vérification de l'existence du fichier configuration
if (!file_exists($source_dbcheck)) { 
   require_once "index/creation_formulaire_bdd.php";
} else {
   require_once $source_dbcheck;   
   if (isset($_SESSION["info_index"])) {
      if ($_SESSION["info_index"][1]) {
       require_once "index/on.php";
       // Lors que lutilisateur est enligne
      } else {
        require_once $login;
        require_once "info_exe/effacement.php";
      }
   } else {
       require_once $login;
       require_once "index/effacement.php";
   }
}
        




//require_once "index/creation_formulaire_bdd.php";

