<?php


session_start();
header("Access-Control-Allow-Origin: *");
require_once "../Class/DatabaseHandler.php";
require_once "../info_exe/dbCheck.php"; 
 
$databaseHandler = new DatabaseHandler($dbname, $username, $password);



$fichier ="../file_dowload/uploads/". $_POST["img_projet_src_img"];

if (file_exists($fichier)) {
    unlink($fichier);
    echo "Fichier supprimé ✅";
} else {
    echo "Fichier introuvable ❌";
}





// Supprimer l'utilisateur dont id_utilisateur = 3
$where = ['img_projet_src_img' => $_POST["img_projet_src_img"]];

$result = $databaseHandler->remove_sql_safe('projet_img', $where);

if ($result['success']) {
    echo "Suppression réussie, lignes affectées : " . $result['affected_rows'];
} else {
    echo "Impossible de supprimer : " . $result['message'];
}

$databaseHandler->closeConnection();


?>