<div class="class1">
    <div>
        <h1><?=   $mes_projets[0]["name_projet"]?></h1>
    </div>
    <div>
          <p><?=   $mes_projets[0]["description_projet"]?></p>
    </div>
</div>
<?php 
$databaseHandler = new DatabaseHandler($dbname, $username, $password);
// Je veux ma propre requête
$sql = "SELECT * FROM `projet` WHERE `parent_projet`='$url'";
// On exécute et on crée une variable globale $mes_projets
$result = $databaseHandler->select_custom_safe($sql, 'mes_projets_child');
for ($i=0; $i < count($mes_projets_child); $i++) { 
echo $mes_projets_child[$i]["id_projet"];
echo "<br/>" ; 
}


 
?>

    <a href="../">
        <img width="50" height="50" src="https://img.icons8.com/ios/50/home--v1.png" alt="home--v1" />
    </a>