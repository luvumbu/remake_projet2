<?php
session_start();
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<?php 
require_once "index/require_once.php" ;
// Récupère la valeur passée dans l'URL
$default ="index/default.php";
$projet_bdd ="projet/index.php";  
$url = $_GET['url'] ?? '';
switch ($url) {
    case '':
        if (isset($_SESSION["info_index"][1])) {
           if(!$filename_bool){
              require_once $default;
           }
           else{
            require_once "req_on/on.php";
           }
        } else {
          require_once $default;
        }
        break;
    default:
    require_once $projet_bdd;
        break;
} 
?>