<?php 

function formatDateFr($dateStr, $withTime = true) {
    // Vérifie que la date est valide
    if (!$dateStr || !strtotime($dateStr)) {
        return 'Date invalide';
    }

    $mois = array(
        '01' => 'janvier', '02' => 'février', '03' => 'mars',
        '04' => 'avril', '05' => 'mai', '06' => 'juin',
        '07' => 'juillet', '08' => 'août', '09' => 'septembre',
        '10' => 'octobre', '11' => 'novembre', '12' => 'décembre'
    );

    $dateParts = explode(' ', $dateStr);
    $date = explode('-', $dateParts[0]);

    $jour = isset($date[2]) ? $date[2] : '??';
    $moisTexte = isset($mois[$date[1]]) ? $mois[$date[1]] : '??';
    $annee = isset($date[0]) ? $date[0] : '????';

    $result = $jour . ' ' . $moisTexte . ' ' . $annee;

    if ($withTime && isset($dateParts[1])) {
        $heureMinute = substr($dateParts[1], 0, 5); // hh:mm
        $result .= ' à ' . str_replace(':', 'h', $heureMinute);
    }

    return $result;
}

// exemple 


/*

echo formatDateFr("2025-05-25 23:38:03");
// Résultat : 25 mai 2025 à 23h38

echo formatDateFr("2025-05-25 23:38:03", false);
// Résultat : 25 mai 2025



*/

?>