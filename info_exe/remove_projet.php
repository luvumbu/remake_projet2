<?php
 
session_start();
header("Access-Control-Allow-Origin: *");

 

require_once "../Class/DatabaseHandler.php";
require_once "../info_exe/dbCheck.php";
echo  $_POST["remove_projet"] ;  
$databaseHandler = new DatabaseHandler($dbname, $username, $password);
// Supprimer l'utilisateur dont id_utilisateur = 3
$where = ['id_projet' => $_POST["remove_projet"]];
$result = $databaseHandler->remove_sql_safe('projet', $where);
if ($result['success']) {
    echo "Suppression réussie, lignes affectées : " . $result['affected_rows'];
} else {
    echo "Impossible de supprimer : " . $result['message'];
}
$databaseHandler->closeConnection();
 
?>