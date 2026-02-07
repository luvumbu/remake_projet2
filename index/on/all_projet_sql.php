<?php 
$session_id_user = $_SESSION["info_index"][1][0]["id_user"];
$sql = $sql = "
SELECT * 
FROM `projet` 
WHERE id_user_projet = '$session_id_user'
AND parent_projet IS NULL
"; 
?>