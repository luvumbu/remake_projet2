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
    'value' => '1'
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
    'text' => $mes_projets[0]["description_projet"],
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
    'text' => $url,
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
    'text' => $mes_projets[0]["google_title"],
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
    "text" => $mes_projets[0]["metacontent"],
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
        'value' => $mes_projets[0]["price"],

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
    'value' => '1' // valeur POST standard
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
        'value' => $mes_projets[0]["password_projet"]
    ],

    'flag' => true
]);
$group->addElement([
    'tag' => 'label',
    'close' => true,
    'flag' => true
]);



$group->addElement([
    'tag' => 'img',
    'attrs' => [
        'width' => '40',
        'height' => '40',
        'src' => 'https://img.icons8.com/color/48/add--v1.png',
        'onclick' => 'add_child(this)',
        'title' => $url,

        'class' => 'add_child'


    ],

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
$manager->generateJsInformation('req_on/update_front.php');
$manager->pushJs();

 
?>



