<?php
ini_set('memory_limit', '900M'); // ou plus si besoin

function parcourirDossier($racine, $chaineRecherche, $mode = 1) {
    if (!is_dir($racine)) {
        echo "<p class='error'>❌ Le chemin spécifié n'est pas un dossier.</p>";
        return;
    }

    $elements = scandir($racine);

    foreach ($elements as $element) {
        if ($element === '.' || $element === '..') {
            continue;
        }

        $cheminComplet = $racine . DIRECTORY_SEPARATOR . $element;

        if (is_dir($cheminComplet)) {
            if ($mode === 1) {
                echo "<p class='dir'>📂 Dossier : $cheminComplet</p>";
            }
            parcourirDossier($cheminComplet, $chaineRecherche, $mode);

        } else {
            $contenu = @file_get_contents($cheminComplet); // @ = ignore erreurs
            $correspond = $contenu !== false && stripos($contenu, $chaineRecherche) !== false;

            if ($mode === 1) {
                if ($correspond) {
                    echo "<p class='found'>✅ Trouvé dans : $cheminComplet</p>";
                } else {
                    echo "<p class='file'>📄 Fichier : $cheminComplet</p>";
                }
            } elseif ($mode === 2 && $correspond) {
                echo "<p class='found'>✅ Trouvé dans : $cheminComplet</p>";
            }
        }
    }
}

// 📂 Racine de recherche (tu peux changer "/" ou "C:\\")
$racine = __DIR__;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Recherche dans les fichiers</title>
<style>
body {
    font-family: monospace;
    background: #f4f4f4;
    padding: 20px;
}
form {
    margin-bottom: 20px;
    padding: 10px;
    background: #fff;
    border: 1px solid #ccc;
}
p { margin: 2px 0; }
.dir   { color: blue; }
.file  { color: #555; }
.found { color: red; font-weight: bold; }
.error { color: darkred; }
</style>
</head>
<body>

<h2>🔎 Recherche dans les fichiers</h2>

<form method="post">
    <label>Valeur à rechercher :</label><br>
    <input type="text" name="chaine" required>
    <br><br>
    <label>Mode :</label><br>
    <input type="radio" name="mode" value="1" checked> Afficher tout<br>
    <input type="radio" name="mode" value="2"> Afficher seulement si trouvé<br><br>
    <button type="submit">Lancer la recherche</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $chaineRecherche = trim($_POST["chaine"]);
    $mode = intval($_POST["mode"]);

    echo "<h3>Résultats pour : <em>$chaineRecherche</em></h3>";
    parcourirDossier($racine, $chaineRecherche, $mode);
}
?>

</body>
</html>