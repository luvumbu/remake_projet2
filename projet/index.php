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
 
 <a href="../">
 <img width="50" height="50" src="https://img.icons8.com/ios/50/home--v1.png" alt="home--v1"/>
 </a>
   



<style>
    * {
        box-sizing: border-box;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
    }

    /* ===============================
   CONTENEUR
================================ */
    .new-project {
        max-width: 720px;
        margin: 30px auto;
        background: #1a273f;
        /* moins sombre que #0f172a */
        padding: 28px;
        border-radius: 18px;
        color: #e5e7eb;
    }

    /* ===============================
   LABEL + INDICATEUR
================================ */
    .project-form label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 6px;
        font-size: 14px;
        color: #d1d9e6;
        /* plus clair que #cbd5f5 */
    }

    .project-form .indicator {
        font-size: 12px;
        color: #a8b0bb;
        /* plus clair que #9ca3af */
    }

    /* ===============================
   EDITEURS (BASE)
================================ */
    .editor {
        width: 100%;
        border: 1px solid rgba(255, 255, 255, .25);
        border-radius: 10px;
        background: #2a3a53;
        /* moins sombre que #1e293b */
        color: #ffffff;
        cursor: text;
        outline: none;
        transition: border-color .15s, box-shadow .15s;
    }

    /* PLACEHOLDER CONTENTEDITABLE */
    .editor:empty::before {
        content: attr(data-placeholder);
        color: #b0b8c1;
        /* plus clair que #9ca3af */
        pointer-events: none;
    }

    /* ===============================
   NOM DU PROJET (INPUT LIKE)
================================ */
    #project_name.editor {
        font-size: 14px;
        font-weight: normal;
        line-height: 1.4;
        min-height: 42px;
        padding: 10px 12px;
        display: flex;
        align-items: center;
    }

    /* ===============================
   DESCRIPTION PROJET
================================ */
    #description_projet.editor {
        min-height: 140px;
        padding: 12px;
        font-size: 14px;
        line-height: 1.6;
    }

    /* ===============================
   GOOGLE TITLE / META CONTENT (COULEUR CLAIRE)
================================ */
    #google_title.editor,
    #metacontent.editor {
        min-height: 42px;
        padding: 10px 12px;
        font-size: 14px;
        line-height: 1.4;
        background: #3b4c6b;
        /* moins sombre que #2c3e50 */
        border: 1px solid rgba(255, 255, 255, .25);
        border-radius: 8px;
        color: #e5e7eb;
    }

    #google_title.editor:empty::before,
    #metacontent.editor:empty::before {
        color: #c0c8d1;
        /* plus clair que #b0b8c1 */
    }

    /* ===============================
   FOCUS
================================ */
    .editor:focus {
        border-color: #22c55e;
        box-shadow: 0 0 0 2px rgba(34, 197, 94, .3);
    }

    /* ===============================
   BOUTON ENVOI
================================ */
    .submit-btn {
        margin-top: 22px;
        background: #22c55e;
        /* un vert un peu plus vif */
        color: #052e16;
        padding: 16px;
        text-align: center;
        border-radius: 12px;
        cursor: pointer;
        font-weight: 600;
        transition: transform .15s, box-shadow .15s;
    }

    .submit-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(34, 197, 94, .4);
    }

    /* ===============================
   CHECKBOX STYLING
================================ */
    input[type="checkbox"] {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        width: 22px;
        height: 22px;
        border: 2px solid #d1d9e6;
        /* plus clair que #cbd5f5 */
        border-radius: 6px;
        background-color: #2a3a53;
        /* moins sombre que #1e293b */
        cursor: pointer;
        position: relative;
        transition: all 0.2s ease;
    }

    input[type="checkbox"]:checked {
        background: #22c55e;
        /* vert */
        border-color: #22c55e;
    }

    input[type="checkbox"]:checked::after {
        content: '';
        position: absolute;
        left: 6px;
        top: 2px;
        width: 6px;
        height: 12px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    input[type="checkbox"]:hover {
        border-color: #34d17a;
    }
</style>


<style>
    /* ===============================
   INPUT PASSWORD (PROJET)
================================ */
    #password_projet {
        width: 100%;
        margin-top: 6px;
        padding: 10px 12px;
        font-size: 14px;
        line-height: 1.4;
        color: #0f172a;

        background: #f1f5f9;
        /* clair */
        border: 1px solid #cbd5f5;
        border-radius: 10px;
        background-color: #4f769c;
        outline: none;
        transition: border-color .15s, box-shadow .15s, background .15s;
    }

    /* Placeholder */
    #password_projet::placeholder {
        color: #94a3b8;
    }

    /* Focus */
    #password_projet:focus {
        background: #ffffff;
        border-color: #22c55e;
        box-shadow: 0 0 0 2px rgba(34, 197, 94, .25);
    }

    /* ===============================
   LABEL + DESCRIPTION (RAPPEL)
================================ */
    label[for="password_projet"] {
        color: #334155;
        font-weight: 500;
    }

    .field-description {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 6px;
    }
</style>
<style>
    /* ===============================
   price (INPUT NUMBER)
================================ */
    #price {
        width: 100px;
        min-height: 42px;
        padding: 10px 12px;
        font-size: 14px;
        line-height: 1.4;
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 10px;
        background: #2a3a53;
        /* même couleur que les éditeurs */
        color: #ffffff;
        outline: none;
        transition: border-color .15s, box-shadow .15s;
    }

    /* PLACEHOLDER */
    #price::placeholder {
        color: #b0c8d1;
        /* même que les placeholders des éditeurs */
    }

    /* FOCUS */
    #price:focus {
        border-color: #22c55e;
        box-shadow: 0 0 0 2px rgba(34, 197, 94, .3);
    }
</style>
<?php


$group = new Group(false);

/* CONTENEUR PRINCIPAL */
$group->addElement([
    'tag' => 'div',
    'attrs' => ['class' => 'new-project'],
    'open' => true,
    
    'flag' => true
]);

/* FORMULAIRE */
$group->addElement([
    'tag' => 'form',
    'attrs' => [
        'class' => 'project-form',
        'method' => 'POST',
        'action' => 'save.php'
       
    ],
    'open' => true,
    'flag' => true
]);

/* =====================================================
   NOM DU PROJET
===================================================== */
$group->addElement([
    'tag' => 'p',
    'attrs' => ['class' => 'field-description'],
    'text' => 'Indiquez le nom de votre projet.',
    'flag' => true
]);

$group->addElement([
    'tag' => 'label',
    'attrs' => ['for' => 'use_html_project_name'],
    'open' => true,
    'flag' => true
]);
$attrs = [
    'type' => 'checkbox',
    'id'   => 'use_html_project_name',
    'name' => 'use_html_project_name',
    'value'=> '1'
];

// Ajoute checked seulement si = 1
if ($mes_projets[0]["use_html_project_name"] == 1) {
    $attrs['checked'] = 'checked';
}

$group->addElement(['tag' => 'text', 'text' => 'Autoriser HTML', 'flag' => true]);

$group->addElement([
    'tag'   => 'input',
    'attrs' => $attrs,
    'flag'  => true
]);

$group->addElement(['tag' => 'label', 'close' => true, 'flag' => true]);









////  'id_projet'=>$url


$group->addElement([
    'tag' => 'div',
    'attrs' => [
        'id' => 'name_projet',
        'class' => 'editor',
        'contenteditable' => 'true',
        
      


        'data-placeholder' => 'Nom du projet...'
    ],
      'text' => $mes_projets[0]["name_projet"],
    'flag' => true
]);


$group->addElement([
    'tag' => 'img',
    'attrs' => [
        'width' => '40',
        'height' => '40',
        'src' => 'https://img.icons8.com/fluency/40/delete-forever.png',
        'onclick' => 'document.getElementById("project_name").innerHTML="";',
        'class' => 'remove_element',
        'alt' => 'delete-sign--v1',

    ],

    'flag' => true
]);
/* =====================================================
   DESCRIPTION PROJET
===================================================== */
$group->addElement([
    'tag' => 'p',
    'attrs' => ['class' => 'field-description'],
    'text' => 'Décrivez brièvement votre projet.',
    'flag' => true
]);

$group->addElement([
    'tag' => 'label',
    'attrs' => ['for' => 'use_html_description_projet'],
    'open' => true,
    'flag' => true
]);

// Préparer les attributs
$attrs = [
    'type'  => 'checkbox',
    'id'    => 'use_html_description_projet',
    'name'  => 'use_html_description_projet',
    'value' => '1' // toujours '1', la valeur POST
];

// Ajouter checked seulement si la valeur est 1
if ($mes_projets[0]["use_html_description_projet"] == 1) {
    $attrs['checked'] = 'checked';
}

// Ajouter le texte
$group->addElement([
    'tag'  => 'text',
    'text' => 'Autoriser HTML',
    'flag' => true
]);

// Ajouter l'input
$group->addElement([
    'tag'   => 'input',
    'attrs' => $attrs,
    'flag'  => true
]);





//
//  'id_projet'=>$url
$group->addElement(['tag' => 'label', 'close' => true, 'flag' => true]);

$group->addElement([
    'tag' => 'div',
    'attrs' => [
        'id' => 'description_projet',
        'class' => 'editor',
        'contenteditable' => 'true',
        'spellcheck' => 'true',
        'data-placeholder' => 'Décris brièvement le projet...'
    ],
    'text'=>$mes_projets[0]["description_projet"] , 
     'flag' => true
]);

$group->addElement([
    'tag' => 'img',
    'attrs' => [
        'width' => '40',
        'height' => '40',
        'src' => 'https://img.icons8.com/fluency/40/delete-forever.png',
        'onclick' => 'document.getElementById("description_projet").innerHTML="";',
        'class' => 'remove_element',
        'alt' => 'delete-sign--v1',

    ],

    'flag' => true
]);




$group->addElement(['tag' => 'label', 'close' => true, 'flag' => true]);

$group->addElement([
    'tag' => 'div',
    'attrs' => [
        'id' => 'id_projet',
        'class' => 'display_none',
        'contenteditable' => 'true',
        'spellcheck' => 'true',
        'data-placeholder' => 'Décris brièvement le projet...'
    ],
    'text'=> $url , 
     'flag' => true
]);

 
















/* =====================================================
   GOOGLE TITLE
===================================================== */
$group->addElement([
    'tag' => 'p',
    'attrs' => ['class' => 'field-description'],
    'text' => 'Indiquez le titre SEO qui apparaîtra dans Google.',
    'flag' => true
]);

$group->addElement([
    'tag' => 'label',
    'attrs' => ['for' => 'use_html_google_title'],
    'open' => true,
    'flag' => true
]);
// Préparer les attributs
$attrs = [
    'type'  => 'checkbox',
    'id'    => 'use_html_google_title',
    'name'  => 'use_html_google_title',
    'value' => '1' // toujours '1', la valeur POST
];

// Ajouter checked seulement si la valeur est 1
if ($mes_projets[0]["use_html_google_title"] == 1) {
    $attrs['checked'] = 'checked';
}

// Ajouter le texte
$group->addElement([
    'tag'  => 'text',
    'text' => 'Autoriser HTML',
    'flag' => true
]);

// Ajouter l'input
$group->addElement([
    'tag'   => 'input',
    'attrs' => $attrs,
    'flag'  => true
]);

$group->addElement(['tag' => 'label', 'close' => true, 'flag' => true]);

$group->addElement([
    'tag' => 'div',
    'attrs' => [
        'id' => 'google_title',
        'class' => 'editor',
        
        'contenteditable' => 'true',
        'data-placeholder' => 'Titre SEO Google...'
    ],
    'text'=>$mes_projets[0]["google_title"],
    'flag' => true
]);
$group->addElement([
    'tag' => 'img',
    'attrs' => [
        'width' => '40',
        'height' => '40',
        'src' => 'https://img.icons8.com/fluency/40/delete-forever.png',
        'onclick' => 'document.getElementById("google_title").innerHTML="";',
        'class' => 'remove_element',
        'alt' => 'delete-sign--v1',

    ],

    'flag' => true
]);
/* =====================================================
   META CONTENT
===================================================== */
$group->addElement([
    'tag' => 'p',
    'attrs' => ['class' => 'field-description'],
    'text' => 'Indiquez la meta description SEO.',
    'flag' => true
]);

$group->addElement([
    'tag' => 'label',
    'attrs' => ['for' => 'use_html_metacontent'],
    'open' => true,
    'flag' => true
]);
// Préparer les attributs
$attrs = [
    'type'  => 'checkbox',
    'id'    => 'use_html_metacontent',
    'name'  => 'use_html_metacontent',
    'value' => '1' // toujours '1', pour POST
];

// Ajouter checked seulement si la valeur est 1
if ($mes_projets[0]["use_html_metacontent"] == 1) {
    $attrs['checked'] = 'checked';
}

// Ajouter le texte
$group->addElement([
    'tag'  => 'text',
    'text' => 'Autoriser HTML',
    'flag' => true
]);

// Ajouter l'input
$group->addElement([
    'tag'   => 'input',
    'attrs' => $attrs,
    'flag'  => true
]);

$group->addElement(['tag' => 'label', 'close' => true, 'flag' => true]);




$group->addElement([
    'tag' => 'div',
    'attrs' => [
        'id' => 'metacontent',
        'class' => 'editor',
        'contenteditable' => 'true',
        'data-placeholder' => 'Meta description SEO...'
    ],
    'flag' => true
]);




$group->addElement([
    'tag' => 'img',
    'attrs' => [
        'width' => '40',
        'height' => '40',
        'src' => 'https://img.icons8.com/fluency/40/delete-forever.png',
        'onclick' => 'document.getElementById("metacontent").innerHTML="";',
        'class' => 'remove_element',
        'alt' => 'delete-sign--v1',

    ],

    'flag' => true
]);
/* =====================================================
   price
===================================================== */
$group->addElement([
    'tag' => 'p',
    'attrs' => ['class' => 'field-description'],
    'text' => 'Indiquez le price du projet.',
    'flag' => true
]);
$group->addElement([
    'tag' => 'input',
    'attrs' => [
        'type' => 'number',
        'name' => 'price',
        'id' => 'price',
        'min' => '0',
        'step' => '1',
        'value'=>$mes_projets[0]["price"],
        
    ],
    
    'flag' => true
]);



/* =====================================================
   VISIBILITÉ
===================================================== */
$group->addElement([
    'tag' => 'p',
    'attrs' => ['class' => 'field-description'],
    'text' => 'Projet visible publiquement.',
    'flag' => true
]);




// Préparer les attributs
$attrs = [
    'type'  => 'checkbox',
    'id'    => 'active_visibilite',
    'name'  => 'active_visibilite',
    'value' => '1' // toujours '1', pour POST
];

// Ajouter checked seulement si la valeur est 1
if ($mes_projets[0]["active_visibilite"] == 1) {
    $attrs['checked'] = 'checked';
}

// Ajouter l'input
$group->addElement([
    'tag'   => 'input',
    'attrs' => $attrs,
    'flag'  => true
]);

/* =====================================================
   QR CODE
===================================================== */
$group->addElement([
    'tag' => 'p',
    'attrs' => ['class' => 'field-description'],
    'text' => 'Activer la génération du QR code.',
    'flag' => true
]);
// Préparer les attributs
$attrs = [
    'type'  => 'checkbox',
    'id'    => 'active_qr_code',
    'name'  => 'active_qr_code',
    'value' => '1' // valeur POST standard
];

// Ajouter checked uniquement si la valeur vaut 1
if (!empty($mes_projets[0]["active_qr_code"]) && $mes_projets[0]["active_qr_code"] == 1) {
    $attrs['checked'] = 'checked';
}

// Ajouter l'input
$group->addElement([
    'tag'   => 'input',
    'attrs' => $attrs,
    'flag'  => true
]);

/* =========================
   VOIX VOCALE (CHECKBOX)
========================= */
$group->addElement([
    'tag' => 'p',
    'attrs' => ['class' => 'field-description'],
    'text' => 'Activez la voix vocale pour ce projet.',
    'flag' => true
]);

$group->addElement([
    'tag' => 'label',
    'attrs' => ['for' => 'active_voix_vocale'],
    'open' => true,
    'flag' => true
]);
$group->addElement([
    'tag' => 'text',
    'text' => 'Voix vocale',
    'flag' => true
]);
// Préparer les attributs
$attrs = [
    'type' => 'checkbox',
    'id'   => 'active_voix_vocale',
    'name' => 'active_voix_vocale',
    'value'=> '1' // valeur POST standard
];

// Ajouter checked uniquement si la valeur vaut 1
if (!empty($mes_projets[0]["active_voix_vocale"]) && $mes_projets[0]["active_voix_vocale"] == 1) {
    $attrs['checked'] = 'checked';
}

// Ajouter l'input avec les attributs conditionnels
$group->addElement([
    'tag'   => 'input',
    'attrs' => $attrs,
    'flag'  => true
]);

$group->addElement([
    'tag' => 'label',
    'close' => true,
    'flag' => true
]);


/* =====================================================
   MOT DE PASSE PROJET
===================================================== */
$group->addElement([
    'tag' => 'p',
    'attrs' => ['class' => 'field-description'],
    'text' => 'Définissez un mot de passe pour protéger le projet.',
    'flag' => true
]);

$group->addElement([
    'tag' => 'label',
    'attrs' => ['for' => 'password_projet'],
    'open' => true,
    'flag' => true
]);
$group->addElement([
    'tag' => 'text',
    'text' => 'Mot de passe du projet',
    'flag' => true
]);
$group->addElement([
    'tag' => 'input',
    'attrs' => [
        'type' => 'text',
        'name' => 'password_projet',
        'placeholder' => 'Si le champ est vide alors y aura pas de mot de passe',
        'id' => 'password_projet',
        'autocomplete' => 'new-password',
          'value'=>$mes_projets[0]["password_projet"]
    ],
  
    'flag' => true
]);
$group->addElement([
    'tag' => 'label',
    'close' => true,
    'flag' => true
]);



/* =====================================================
   BOUTON ENVOI
===================================================== */
$group->addElement([
    'tag' => 'div',
    'attrs' => [
        'class' => 'submit-btn',
        'onclick' => 'on_send_form()'
    ],
    'text' => 'Envoyer',
    'flag' => true
]);

/* FERMETURES */
$group->addElement(['tag' => 'form', 'close' => true, 'flag' => true]);
$group->addElement(['tag' => 'div', 'close' => true, 'flag' => true]);

/* MANAGER */
$manager = new GroupManager('formData');
$manager->addGroup($group);
echo $manager->render();
$manager->generateJsInformation('x.php');
$manager->pushJs();
?>




<script>
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
</script>



 <?php 

 /*
    <div id="gallery-flex">

        <!-- IMAGE 1 -->
        <div class="gallery-item">
            <img src="https://i.pinimg.com/736x/5e/54/9f/5e549f54dd92ff0fc96dd2f44f3f9c2b.jpg" alt="">

            <div class="actions">
                <!-- Checkbox -->
                <input type="checkbox" class="check-remove">

                <!-- Corbeille -->
                <img
                    src="https://img.icons8.com/ios-glyphs/30/trash--v1.png"
                    class="remove_element"
                    alt="Supprimer"
                    title="Supprimer">

                <!-- Etoile -->
                <label class="star-wrap">
                    <input type="radio" name="mainImage">
                    <svg class="star" viewBox="0 0 24 24" aria-hidden="true">
                        <polygon points="12 2 15 9 22 9 16.5 13.5 18.5 21 12 16.8 5.5 21 7.5 13.5 2 9 9 9" />
                    </svg>
                </label>
            </div>
        </div>

        <!-- IMAGE 2 -->
        <div class="gallery-item">
            <img src="https://i.pinimg.com/736x/5e/54/9f/5e549f54dd92ff0fc96dd2f44f3f9c2b.jpg" alt="">

            <div class="actions">
                <!-- Checkbox -->
                <input type="checkbox" class="check-remove">

                <!-- Corbeille -->
                <img
                    src="https://img.icons8.com/ios-glyphs/30/trash--v1.png"
                    class="remove_element"
                    alt="Supprimer"
                    title="Supprimer">

                <!-- Etoile -->
                <label class="star-wrap">
                    <input type="radio" name="mainImage">
                    <svg class="star" viewBox="0 0 24 24" aria-hidden="true">
                        <polygon points="12 2 15 9 22 9 16.5 13.5 18.5 21 12 16.8 5.5 21 7.5 13.5 2 9 9 9" />
                    </svg>
                </label>
            </div>
        </div>
    </div>
 */


    ?>

<style>

    .d_flex{
        display: flex;
    }
    /* Conteneur gallery */
    #gallery-flex {
        display: flex;
        /* display flex pour aligner les cartes */
        gap: 20px;
        flex-wrap: wrap;
        max-width: 80%;
        margin: auto;
        justify-content: space-around;
    }
    .actions{
        padding: 10px;
    }

    /* Carte image */
    #gallery-flex .gallery-item {
        display: flex;
        /* display flex pour organiser contenu vertical */
        flex-direction: column;
        /* image + actions */
        flex: 1 1 200px;
        max-width: 260px;
        border: 1px solid #ccc;
        border-radius: 7px;
        padding: 8px;
        box-sizing: border-box;
    }

    /* Images */
    #gallery-flex img {
        width: 100%;
        height: 200px;
        /* hauteur fixe */
        object-fit: cover;
        /* remplissage sans déformation */
        border-radius: 7px;
        display: block;
    }

    /* Zone actions (checkbox, corbeille, étoile) */
    #gallery-flex .actions {
        display: flex;
        /* flex pour aligner horizontalement */
        align-items: center;
        justify-content: space-between;
        /* espace entre les éléments */
        margin-top: 8px;
    }

    /* Checkbox */
    #gallery-flex .check-remove {
        cursor: pointer;
    }

    /* Corbeille */
    #gallery-flex .remove_element {
        cursor: pointer;
        width: 22px;
        height: 22px;
        transition: transform 0.2s, opacity 0.2s;
    }

    #gallery-flex .remove_element:hover {
        transform: scale(1.1);
        opacity: 0.85;
    }

    /* Etoile */
    #gallery-flex .star-wrap input {
        display: none;
        /* cacher le radio */
    }

    #gallery-flex .star {
        width: 22px;
        height: 22px;
        cursor: pointer;
        fill: transparent;
        /* non sélectionnée */
        stroke: #000;
        /* contour noir */
        stroke-width: 1.5;
        transition: fill 0.2s;
    }

    /* Etoile sélectionnée */
    #gallery-flex .star-wrap input:checked+.star {
        fill: gold;
    }
    .display_none{
        display: none;
    }
    .editor{
        padding-top: 20px;
        padding-bottom: 20px;

    }
</style>