<?php 
session_start();
header("Access-Control-Allow-Origin: *");
require_once "../Class/DatabaseHandler.php";
require_once "../info_exe/dbCheck.php";
$img_projet = $_POST["img_projet"] ; 
$id_projet = $_POST["id_projet"] ; 
$databaseHandler = new DatabaseHandler($dbname, $username, $password);
// Mettre à jour le nom du projet dont id_projet = 2
$data = ['img_projet' =>$img_projet];
$where = ['id_projet' => $id_projet];
$result = $databaseHandler->update_sql_safe('projet', $data, $where);
if ($result['success']) {
    echo "Mise à jour réussie, lignes affectées : " . $result['affected_rows'];
} else {
    echo "Erreur : " . $result['message'];
}
$databaseHandler->closeConnection();
?>