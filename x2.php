<?php 
 require_once "Class/DatabaseHandler.php" ; 
 require_once "req_off/dbCheck.php" ; 
 

 /*

        // Affiche tous le noms des tables
$dbname = "test";
$username = "root";
$password = "";
 
 


// Initialisation du gestionnaire de base de données
$databaseHandler = new DatabaseHandler($dbname, $username, $password);


 $databaseHandler->getAllTables();


var_dump($databaseHandler->getAllTables());
*/








 
 

// Champs à rechercher (dans l’ordre)
$champs = ['id_user_projet', 'parent_projet','id_projet_img '];
 


$result = array_filter($champs, function ($value) {
    return strpos($value, 'id') !== false;
});

print_r($result);

 
 /*

// Instanciation
$db = new DatabaseHandler("test", "root", "", "localhost");

// Récupération des données
$allData = $db->getAllDataGrouped();

foreach ($champs as $champRecherche) {

    echo "<h2>Recherche du champ : $champRecherche</h2>";

    $trouve = false;

    foreach ($allData as $tableName => $rows) {

        if (empty($rows)) continue;

        foreach ($rows as $row) {

            // 🔍 même logique que ton code qui fonctionne
            if (array_key_exists($champRecherche, $row)) {

                echo "<h3>Table : $tableName</h3>";
                echo "<strong>$champRecherche :</strong> "
                    . htmlspecialchars($row[$champRecherche]) . "<br>";

                echo "<pre>";
                print_r($row);
                echo "</pre>";

                $trouve = true;
                break 2; // ⛔ stop table + lignes → champ suivant
            }
        }
    }

    if (!$trouve) {
        echo "❌ Champ <b>$champRecherche</b> non trouvé<br>";
    }
}


 





$dbname = "test";
$username = "root";
$password = "";
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Mettre à jour le nom du projet dont id_projet = 2
$data = ['name_projet' => 'Projet Beta Modifié'];
$where = ['id_projet' => 6];

$result = $databaseHandler->update_sql_safe('projet', $data, $where);

if ($result['success']) {
    echo "Mise à jour réussie, lignes affectées : " . $result['affected_rows'];
} else {
    echo "Erreur : " . $result['message'];
}

$databaseHandler->closeConnection();

*/
?>