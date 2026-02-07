<?php
session_start();
header("Access-Control-Allow-Origin: *");
require_once "../Class/DatabaseHandler.php";
require_once "../info_exe/dbCheck.php"; 

// Définit le fuseau horaire sur Europe/Paris
date_default_timezone_set('Europe/Paris');

// Récupère le timestamp actuel à Paris
$timestamp = time(); // timestamp Unix

// Récupère l'extension du fichier envoyé (si disponible)
$originalFileName = isset($_POST["insert_file"]) ? $_POST["insert_file"] : '';
$ext = pathinfo($originalFileName, PATHINFO_EXTENSION);

// Génère un nom de fichier unique basé sur le timestamp
$generatedFileName = $timestamp . ($ext ? "." . $ext : "");


$_SESSION["generatedFileName"] = $generatedFileName ;
// Connexion à la base
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Prépare les données à insérer
$user = [
    'id_projet_img'      => $_POST["file_dowload"],
    'img_projet_src_img' => $generatedFileName,
    'extension_img'      => $ext ? $ext : null, // ajoute l'extension ou null si absente
    'id_user_img'        => $_SESSION["info_index"][1][0]["id_user"]
];

// Insertion sécurisée dans la base
$result = $databaseHandler->insert_safe('projet_img', $user, 'img_projet_src_img');

// Retourne le résultat
if ($result['success']) {
    echo "✅ ".$result['message']." (ID ".$result['id'].") — Fichier : ".$generatedFileName;
} else {
    echo "⚠️ ".$result['message'];
}

// Ferme la connexion
$databaseHandler->closeConnection();
?>
