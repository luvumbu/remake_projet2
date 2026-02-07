<link rel="stylesheet" href="projet/css_projet.css">
<?php
require_once "projet/require_once.php";
$databaseHandler = new DatabaseHandler($dbname, $username, $password);
// Je veux ma propre requête
$sql = "SELECT * FROM `projet` WHERE `id_projet`='$url'";
// On exécute et on crée une variable globale $mes_projets
$result = $databaseHandler->select_custom_safe($sql, 'mes_projets');
if ($result['success']) {
    echo "<pre>";
    //   var_dump($mes_projets); // accès direct via la variable globale
    echo "</pre>";
} else {
    echo "Erreur : " . $result['message'];
}
?>









<?php
if (isset($_SESSION["info_index"][1])) {




?>


    <div class="menu_">
        <div class="menu-item" id="menu_nouveau_projet" title="Nouveau projet" onclick="home()">
            <i class="fa-solid fa-folder-plus"></i>
            <span>Home</span>
        </div>

        <hr class="menu-separator">

        <div class="menu-item" id="file_dowload_" title="Mon profil" onclick="file_dowload()">
            <i class="fa-solid fa-user"></i>
            <span>Ajouter une image</span>
        </div>

        <div class="menu-item logout" id="menu_deconnexion" title="Déconnexion" onclick="session_destroy()">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Déconnexion</span>
        </div>

        <hr class="menu-separator">

        <!-- Modifier projet -->
        <div class="menu-item" id="menu_modifier_projet" title="Modifier projet" onclick="modifier_projet()">
            <i class="fa-solid fa-pen-to-square"></i>
            <span>Modifier projet</span>
        </div>

    </div>
<?php


}

// FORMULAIRE 0001



// FORMULAIRE 0001

?>

<script>
    function home() {
        window.location.href = "../";
    }
</script>




<div id="index_form" style="display: none;">
    <?php
    require_once "projet/index_form.php";
    ?>
</div>



<div id="file_dowload_x" style="display: none;">
    <?php
    require_once "file_dowload/img.php";

    ?>

</div>

<?php
 
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Je veux ma propre requête
$sql = "SELECT * FROM `projet` WHERE `id_projet`='$url'";

// On exécute et on crée une variable globale $mes_projets
$result = $databaseHandler->select_custom_safe($sql, 'mes_projet_parent');





/*
?>






<div class="nd_projet">
    <div id="name_projet">
        <?= $mes_projet_parent[0]["name_projet"]  ?>
    </div>
    <div id="description_projet">
        <?= $mes_projet_parent[0]["description_projet"]  ?>
    </div>
</div>


<a href="../">
    <img width="50" height="50" src="https://img.icons8.com/ios/50/home--v1.png" alt="home--v1" />
</a>
 


*/




$description_projet = $mes_projet_parent[0]["description_projet"];
$description_projet_n = html_vers_texte_brut($description_projet);
// Ensuite entourer d'une div pour avoir une structure HTML
$description_projet_n = '<div>' .  $description_projet_n . '</div>';

// Enfin ajouter le span au premier caractère
$description_projet_n = html_premier_caractere($description_projet_n, 'span', 'rouge');






$name_projet = $mes_projet_parent[0]["name_projet"];
$name_projet_n = html_vers_texte_brut($name_projet);
// Ensuite entourer d'une div pour avoir une structure HTML
$name_projet_n = '<div>' .  $name_projet_n . '</div>';
// Enfin ajouter le span au premier caractère
$name_projet_n = html_premier_caractere($name_projet_n, 'span', 'rouge');


















?>
<script>
    function deleteImage(btn) {
        var ok = new Information("req_on/img_projet_src_img.php"); // création de la classe 
        ok.add("img_projet_src_img", btn.title); // ajout de l'information pour lenvoi 
        console.log(ok.info()); // demande l'information dans le tableau
        ok.push(); // envoie l'information au code pkp 
        const block = btn.closest('.image_block');
        block.remove();
    }
</script>







<?php



$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Je veux ma propre requête
$sql = "SELECT * FROM `projet` WHERE `parent_projet`='$url'";

// On exécute et on crée une variable globale $mes_projets
$result = $databaseHandler->select_custom_safe($sql, 'mes_projet_child');

















?>
















<style>
    /* Conteneur des images */
    .all_img {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 10px;
        /* espace entre les blocs */
    }

    /* Bloc image + boutons */
    .image_block {
        display: flex;
        flex-direction: column;
        align-items: center;
        border: 2px solid #ccc;
        padding: 5px;
        width: 300px;
        /* largeur fixe */
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
        background-color: #fafafa;
    }

    /* Image */
    .image_block img {
        width: 100%;
        /* doit correspondre au bloc */
        height: 200px;
        object-fit: cover;
        display: block;
        margin-bottom: 8px;
        border-radius: 5px;
        transition: transform 0.3s ease;
    }


    /* Conteneur boutons */
    .buttons {
        display: flex;
        justify-content: space-between;
        width: 100%;
        gap: 5px;
    }

    /* Boutons et labels */
    button,
    label {
        flex: 1;
        padding: 5px;
        font-size: 12px;
        cursor: pointer;
        text-align: center;
        border-radius: 4px;
        border: 1px solid #888;
        background-color: #f5f5f5;
        transition: all 0.2s ease;
    }

    /* Effet hover */
    button:hover,
    label:hover {
        background-color: #e0e0e0;
    }

    /* Bouton supprimer spécifique */
    .delete_btn {
        background-color: #ffdddd;
        border-color: #ff8888;
    }

    .delete_btn:hover {
        background-color: #ffcccc;
    }

    /* Radio sélection stylisée */
    .select_radio {
        display: none;
        /* cache le radio natif */
    }

    /* Effet de sélection sur le bloc */
    .image_block.selected {
        border: 2px solid #007bff;
        background-color: #e6f0ff;
        box-shadow: 0 0 10px rgba(209, 53, 25, 0.4);
    }

    /* Checkbox stylisée */
    .check_btn {
        margin-right: 5px;
        transform: scale(1.2);
        cursor: pointer;
    }


    #file_dowload {
        width: 600px;
        /* largeur fixe */
        height: 300px;
        /* hauteur fixe */
        overflow: hidden;
        /* cache ce qui dépasse si cover */
    }

    #file_dowload img {
        width: 100%;
        height: 200%;
        object-fit: cover;
        /* ou 'contain' selon ton choix */
        display: block;
        /* supprime les petits espaces sous l'image */
    }



    #file_dowload img {
        width: 100%;
    }

    #file_dowload {
        width: 60%;
        margin: auto;
    }

    .rouge {
        background-color: green;
        font-size: 2em;
        padding: 5px;
        color: white;
    }

    .description_projet {
        margin-top: 50px;
        text-align: center;
    }
</style>
<script>
    // Tableau qui va contenir tous les ID
    let imagesIds = [];

    // Sélectionne tous les blocs image
    document.querySelectorAll('.image_block').forEach(block => {
        const id = block.dataset.id; // récupère data-id
        imagesIds.push(parseInt(id, 10)); // push dans le tableau
    });
</script>













 






</div>





<?php
 


if($mes_projet_parent[0]["id_user_projet"]==$_SESSION["info_index"][1][0]["id_user"]){
?>


<script>
        function file_dowload() {


        if (document.getElementById("file_dowload_x").style.display == "block") {
            document.getElementById("file_dowload_x").style.display = "none";

        } else {
            document.getElementById("file_dowload_x").style.display = "block";

        }


    }

    function modifier_projet() {
        var index_on_group = document.getElementById("index_on_group").className;



        if (index_on_group == "") {

            document.getElementById("index_on_group").className = "display_none";

        } else {
            index_on_group = "";

            document.getElementById("index_on_group").className = "";
        }
    }

    function modifier_projet() {
        if (document.getElementById("index_form").style.display == "block") {
            document.getElementById("index_form").style.display = "none";

        } else {
            document.getElementById("index_form").style.display = "block";

        }
    }
</script>


<div style="margin-bottom: 150px;"></div>
<?php 
}

?>






<script>
    function add_child(_this) {
        var ok = new Information("req_on/insert_projet.php"); // création de la classe 
        ok.add("parent_projet", _this.title); // ajout de l'information pour lenvoi     
        console.log(ok.info()); // demande l'information dans le tableau
        ok.push(); // envoie l'information au code pkp 
        window.scrollTo(0, 0);
        const myTimeout = setTimeout(x, 250);

        function x() {
            location.reload();
        }
    }

    function on_send_form() {

        if (typeof formData === 'undefined') {
            console.warn('formData n\'existe pas encore !');
            return;
        }

        for (let i = 0; i < formData.identite_tab.length; i++) {
            let id = formData.identite_tab[i][0];
            let value = '';

            let el = document.getElementById(id);
            if (el) {
                // Pour les div contenteditable (éditeur)
                if (el.contentEditable === "true") {
                    value = el.innerHTML;
                }
                // Pour checkbox
                else if (el.type === 'checkbox') {
                    value = el.checked ? '1' : '0';
                }
                // Pour radio (si nécessaire)
                else if (el.type === 'radio') {
                    let checked = document.querySelector('input[name="' + el.name + '"]:checked');
                    value = checked ? checked.value : '';
                }
                // Pour les autres inputs classiques
                else {
                    value = el.value;
                }

                formData.identite_tab[i][1] = value;
            }
        }

        console.log('Valeurs à envoyer :', formData.identite_tab);
        formData.push();
    }



    function session_destroy() {
        window.location.href = "req_on/session_destroy2.php";
    }
</script>










<?php 


require_once "projet/index_html.php" ; 

?>
<a href="../">Index</a>