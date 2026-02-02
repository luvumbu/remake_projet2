<link rel="stylesheet" href="projet/css_projet.css">

<?php
require_once "projet/require_once.php";
?>

<a href="../">
    <img width="50" height="50" src="https://img.icons8.com/ios/50/home--v1.png" alt="home--v1" />
</a>

<?php
if ($_SESSION["info_index"][1]) {
    require_once "projet/index_on.php";
} else {
    require_once "projet/index_off.php";
}

?>