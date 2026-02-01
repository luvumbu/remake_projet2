<?php
 
function formaterDateFr($datetime) {
    // Essaye plusieurs formats selon le système
    $locales = ['fr_FR.UTF-8', 'fr_FR', 'fra', 'french'];
    foreach ($locales as $loc) {
        if (setlocale(LC_TIME, $loc)) break;
    }

    return strftime('%A %d %B %Y à %Hh%M', strtotime($datetime));
}


/*
$date = "2025-04-30 14:32:28";
echo formaterDateFr($date);
 */
?>
