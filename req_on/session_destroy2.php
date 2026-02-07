<?php 
session_start() ; 
session_destroy();
?>
<?php
if (!empty($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
} else {
    // fallback si la page précédente est inconnue
    header('Location: index.php');
    exit;
}
?>



