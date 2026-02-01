<?php
require_once "projet/require_once.php";
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Je veux ma propre requête
$sql = "SELECT * FROM `projet` WHERE `id_projet`='$url'";

// On exécute et on crée une variable globale $mes_projets
$result = $databaseHandler->select_custom_safe($sql, 'mes_projets');

if ($result['success']) {
    echo "<pre>";
    var_dump($mes_projets); // accès direct via la variable globale
    echo "</pre>";
} else {
    echo "Erreur : " . $result['message'];
}
?>
<div class="editor-wrapper">

    <!-- ===== TITRE ===== -->
    <div class="editor-block">
        <div class="editor title-editor" contenteditable="true">
            <?= $mes_projets[0]["name_projet"] ?>
        </div>
    </div>

    <!-- ===== DESCRIPTION ===== -->
    <div class="editor-block">
        <div class="editor desc-editor" contenteditable="true">
            <?= $mes_projets[0]["description_projet"] ?>
        </div>
    </div>

</div>


<style>
    .editor-wrapper {

        padding: 14px;
        border-radius: 14px;

    }

    .editor-block {
        margin-bottom: 16px;
        border: 1px solid rgba(0, 0, 0, 0.3);
        border-radius: 7px;
    }

    .editor-toolbar {
        display: flex;
        gap: 6px;
        margin-bottom: 6px;
    }

    .editor-toolbar button,
    .editor-toolbar input {
        background: #1e293b;
        border: none;

        padding: 6px 8px;
        border-radius: 6px;
        cursor: pointer;
    }

    .editor {

        border-radius: 8px;
        padding: 10px;
        outline: none;
    }

    /* titre */
    .title-editor {
        font-size: 20px;
        font-weight: 600;
    }

    /* description */
    .desc-editor {
        font-size: 14px;
        min-height: 120px;
    }
</style>


<a href="../">ACCEUIL</a>