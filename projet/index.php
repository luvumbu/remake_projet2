<link rel="stylesheet" href="projet/css_projet.css">

<?php
require_once "projet/require_once.php";
if ($_SESSION["info_index"][1]) {

?>
    <a href="../">
        <img width="50" height="50" src="https://img.icons8.com/ios/50/home--v1.png" alt="home--v1" />
    </a>
<?php
    require_once "projet/index_child.php";
}
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Je veux ma propre requête
$sql = "SELECT * FROM `projet` WHERE `id_projet`='$url'";

// On exécute et on crée une variable globale $mes_projets
$result = $databaseHandler->select_custom_safe($sql, 'mes_projets');

if ($result['success']) {
    echo "<pre>";
    //   var_dump($mes_projets); // accès direct via la variable globale
    echo "</pre>";
} else {
    echo "Erreur : " . $result['message'];
}


if ($_SESSION["info_index"][1]) {
    require_once "projet/index_on.php";
} else {
    require_once "projet/index_off.php";
}

?>