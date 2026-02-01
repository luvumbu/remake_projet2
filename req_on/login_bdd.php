<?php
session_start();
header("Access-Control-Allow-Origin: *");
require_once "../Class/DatabaseHandler.php";
require_once "../info_exe/dbCheck.php";

$_SESSION["info_index"] = array();
$info_index_1 = "✅ Utilisateur trouvé : ";
$info_index_2 = "❌ Aucun utilisateur correspondant.";

$__dbname = $_POST["dbname"];
$__username = $_POST["username"];

$_SESSION["info_index"][0] = $info_index_1;

$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Je veux ma propre requête
$sql = 'SELECT * FROM `profil_user` WHERE `prenom_user`="' . $__dbname . '" AND `password_user`="' . $__username . '"';

// On exécute et on crée une variable globale $mes_projets
$result = $databaseHandler->select_custom_safe($sql, 'mes_projets');

if ($result['success']) {

    if (count($mes_projets) != 0) {
        $_SESSION["info_index"][0] = $info_index_1 . count($mes_projets) . ' _  : ' . $mes_projets[0]["nom_user"] . "ifno ok";
         $_SESSION["info_index"][1] = $mes_projets;
    

    } else {
        $_SESSION["info_index"][0] = $info_index_2;
    }
} else {

    $_SESSION["info_index"][0] = $info_index_2;
    $_SESSION["info_index"][1] =false;
}
?>     
