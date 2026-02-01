<?php
// Vérifier si $_POST n'est pas vide
if (!empty($_POST)) {
    foreach ($_POST as $key => $value) {
        // Si la valeur est un tableau (ex: plusieurs inputs avec le même nom)
        if (is_array($value)) {
            echo "Clé : $key <br>";
            foreach ($value as $subKey => $subValue) {
                echo " - $subKey : $subValue <br>";
            }
        } else {
            echo "Clé : $key, Valeur : $value <br>";
        }
    }
} else {
    echo "Aucune donnée POST reçue.";
}
?>
