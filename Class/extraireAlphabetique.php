<?php 

function extraireAlphabetique($str) {
    return preg_replace('/[^a-zA-Z]/', '', $str);
}
/*


$texte = "H3ll0 W0rld! 2024";
$resultat = extraireAlphabetique($texte);

echo $resultat; // Affichera "HllWrld"



*/
?>