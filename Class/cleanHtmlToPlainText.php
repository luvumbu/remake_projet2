<?php
/**
 * Nettoie n'importe quel HTML pour ne garder que le texte brut.
 *
 * @param string $html Le HTML à nettoyer
 * @return string Texte brut propre
 */
function cleanHtmlToPlainText($html) {
    // Supprimer tous les tags HTML
    $text = strip_tags($html);

    // Nettoyer les espaces en début et fin
    $text = trim($text);

    // Remplacer plusieurs espaces ou retours à la ligne par un seul espace
    $text = preg_replace('/\s+/u', ' ', $text);

    return $text;
}

/*

// ------------------------
// Exemple d'utilisation
$html = '<span><p><span>ALARME</span></p><div><span><br></span></div></span>
        <div>Suite du texte avec <b>gras</b></div>';

$result = cleanHtmlToPlainText($html);

echo $result;


*/
?>
