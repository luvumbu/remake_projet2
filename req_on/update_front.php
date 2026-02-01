<?php
require_once "../Class/DatabaseHandler.php";
require_once "../info_exe/dbCheck.php";

if (!empty($_POST)) {
    // Transforme toutes les clés POST en variables locales
    extract($_POST, EXTR_SKIP); // EXTR_SKIP évite d'écraser des variables existantes

    // Affichage des noms des champs POST uniquement
    $names = array_keys($_POST);
    //  var_dump($names); // Affiche juste les noms des champs

    // Exemple : si $_POST contient "meta" et "title"
    // tu pourras faire directement :
    // echo $meta;
    // echo $title;

} else {
    echo "Aucune donnée POST reçue.";
}

echo  $id_projet;
//echo $use_html_project_name ; 
$databaseHandler = new DatabaseHandler($dbname, $username, $password);
// Mettre à jour le nom du projet dont id_projet = 2
$data = [
    'name_projet' => $name_projet,
    'description_projet' => $description_projet,
    'use_html_project_name' => $use_html_project_name,
    'use_html_description_projet' => $use_html_description_projet,
    'use_html_google_title' => $use_html_google_title,
    'google_title' => $google_title,
    'use_html_metacontent' => $use_html_metacontent,
    'metacontent' => $metacontent,
    'price' => $price,
    'active_visibilite' => $active_visibilite,
    'active_qr_code' => $active_qr_code,
    'password_projet' => $password_projet,
    'active_voix_vocale' => $active_voix_vocale


];
$where = ['id_projet' => $id_projet];
$result = $databaseHandler->update_sql_safe('projet', $data, $where);

if ($result['success']) {
    echo "Mise à jour réussie, lignes affectées : " . $result['affected_rows'];
} else {
    echo "Erreur : " . $result['message'];
}
$databaseHandler->closeConnection();
