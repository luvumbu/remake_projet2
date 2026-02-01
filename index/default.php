<?php
$source_dbcheck = "info_exe/dbCheck.php";
// Vérification de l'existence du fichier configuration
if (!file_exists($source_dbcheck)) {

 
   require_once "index/creation_formulaire_bdd.php";
} else {
   require_once $source_dbcheck;
   
   if (isset($_SESSION["info_index"])) {

      if ($_SESSION["info_index"][1]) {
       require_once "index/on.php";
      } else {
        require_once "index/login.php";
         require_once "info_exe/effacement.php";
      }
   } else {
       require_once "index/login.php";
       require_once "index/effacement.php";
   }
}
        




//require_once "index/creation_formulaire_bdd.php";

