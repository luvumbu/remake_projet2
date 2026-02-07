<?php
session_start();
header("Access-Control-Allow-Origin: *");
require_once "../Class/DatabaseHandler.php";
require_once "../info_exe/dbCheck.php"; 
// ---------------------------
// 1️⃣ Connexion unique
// ---------------------------
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// ---------------------------
// 2️⃣ Récupérer et transformer les tableaux
// ---------------------------



$presentIds = isset($_POST['presentIds']) && $_POST['presentIds'] !== ''
    ? array_map('intval', explode(',', $_POST['presentIds']))
    : [];

$absentIds  = isset($_POST['absentIds']) && $_POST['absentIds'] !== ''
    ? array_map('intval', explode(',', $_POST['absentIds']))
    : [];
echo "test";
// ---------------------------
// 3️⃣ Fonction de mise à jour
// ---------------------------
function updateIds($ids, $value, $dbHandler) {
    foreach ($ids as $id) {
        $data  = ['is_checked' => $value];
        $where = ['id_projet_img_auto' => $id];

        $result = $dbHandler->update_sql_safe('projet_img', $data, $where);

        if ($result['success']) {
            echo "ID $id → is_checked = $value, lignes affectées : {$result['affected_rows']}<br>";
        } else {
            echo "ID $id → ERREUR : {$result['message']}<br>";
        }
    }
}

// ---------------------------
// 4️⃣ Mise à jour
// ---------------------------
updateIds($presentIds, 1, $databaseHandler);
updateIds($absentIds, 0, $databaseHandler);

// ---------------------------
// 5️⃣ Fermer la connexion
// ---------------------------
$databaseHandler->closeConnection();
?>
