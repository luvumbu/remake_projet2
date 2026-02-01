<?php 

// Fonction pour vérifier l'existence d'un dossier et le créer si nécessaire
function EnsureDirectoryExists($path) {
    if (is_dir($path)) {
        echo "Le dossier '$path' existe déjà.\n";
    } else {
        mkdir($path, 0777, true);
        echo "Dossier '$path' créé avec succès.\n";
    }
}
/*

<?php
// Tableau contenant les chemins de fichiers ou dossiers à vérifier
$source_file = array(
    "CRUDManager/",
    "CRUDManager/file.txt",
    "Toyota"
);

foreach ($source_file as $path) {
    ensureFileOrDirectoryExists($path);
}


*/


/*
 
 

// Fonction pour vérifier l'existence d'un fichier et le créer si nécessaire
function EnsureFileExists($path) {
    if (file_exists($path)) {
        echo "Le fichier '$path' existe déjà.\n";
    } else {
        // Créer un fichier vide pour illustrer la création
        touch($path);
        echo "Fichier '$path' créé avec succès.\n";
    }
}

// Fonction pour vérifier à la fois fichiers et dossiers
function ensureFileOrDirectoryExists($path) {
    if (is_dir($path)) {
        EnsureDirectoryExists($path);
    } elseif (file_exists($path)) {
        EnsureFileExists($path);
    } else {
        echo "Le chemin '$path' n'existe pas et n'est ni un dossier ni un fichier valide.\n";
    }
}

// Tableau contenant les chemins de fichiers ou dossiers à vérifier
$source_file = array(
    "CRUDManager/",
    "CRUDManager/file.txt",
    "Toyota"
);

foreach ($source_file as $path) {
    ensureFileOrDirectoryExists($path);
}
 
*/




?>