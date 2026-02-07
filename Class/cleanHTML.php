<?php
function cleanHTML($html) {
    $doc = new DOMDocument();

    // Evite les warnings pour HTML mal formé
    libxml_use_internal_errors(true);

    // Charger le HTML
    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    $xpath = new DOMXPath($doc);

    // Supprime tous les styles
    foreach ($xpath->query('//*[@style]') as $node) {
        if ($node instanceof DOMElement) { // <-- S'assure que c'est bien un élément
            $node->removeAttribute('style');
        }
    }

    // Supprime tous les autres attributs sauf href et title sur <a>
    foreach ($doc->getElementsByTagName('*') as $node) {
        if ($node instanceof DOMElement) {
            $allowedAttrs = [];
            if ($node->nodeName === 'a') {
                $allowedAttrs = ['href', 'title'];
            }
            // On convertit la liste en tableau pour éviter les erreurs pendant la suppression
            $attrs = [];
            foreach ($node->attributes as $attr) {
                $attrs[] = $attr->nodeName;
            }
            foreach ($attrs as $attrName) {
                if (!in_array($attrName, $allowedAttrs)) {
                    $node->removeAttribute($attrName);
                }
            }
        }
    }

    return $doc->saveHTML();
}


/*

// Test
$html = '<div id="description_projet"><p style="color:red;"><b>Test</b> <a href="https://example.com" style="color:blue;">Link</a></p></div>';
echo cleanHTML($html);

*/
?>
