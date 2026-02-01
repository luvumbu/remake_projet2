<?php 




 require_once "Class/DatabaseHandler.php" ; 
 
echo $_POST["id_envoyer"] ; 
$dbname   = "test";
$username = "root";
$password = "";

$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Sécurité minimale
if (!isset($_POST["id_envoyer"])) {
    die("ID du projet manquant");
}

// Données à mettre à jour
$data = [
    'name_projet'        => $_POST["name_projet"],
    'description_projet'=> $_POST["description_projet"]
];

// Condition WHERE
$where = [
    'id_projet' => (int) $_POST["id_envoyer"]
];

// Update
$result = $databaseHandler->update_sql_safe('projet', $data, $where);

if ($result['success']) {
    echo "✅ Mise à jour réussie, lignes affectées : " . $result['affected_rows'];
} else {
    echo "❌ Erreur : " . $result['message'];
}

// Fermeture connexion
$databaseHandler->closeConnection();
