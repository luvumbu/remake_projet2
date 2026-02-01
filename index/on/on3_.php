<?php

/* ==============================
   GROUPE PRINCIPAL
================================ */


$group = new Group(false);

/* ==============================
   CONTAINER PRINCIPAL
================================ */
$group->addElement([
    'tag'   => 'div',
    'attrs' => [
        'id' => 'main_container',
        'class'=>'display_none'
        ],
    'open'  => true,
    'flag'  => false
]);

/* ==============================
   TITRE
================================ */
$group->addElement([
    'tag'   => 'h1',
    'attrs' => ['class' => 'h1_tag'],
    'text'  => 'Création du projet',
    'flag'  => true
]);

/* ==============================
   INPUT — NOM DU PROJET
================================ */
$group->addElement(['tag' => 'div', 'open' => true]);

$group->addElement([
    'tag' => 'label',
    'attrs' => ['for' => 'name_projet'],
    'text' => 'Nom du projet',
    'flag' => false
]);

$group->addElement([
    'tag' => 'input',
    'attrs' => [
        'type' => 'text',
        'id' => 'name_projet',
        'placeholder' => 'Nom du projet'
    ],
    'self' => true,
    'flag' => true
]);

$group->addElement(['tag' => 'div', 'close' => true]);

/* ==============================
   TEXTAREA — DESCRIPTION
================================ */
$group->addElement(['tag' => 'div', 'open' => true]);

$group->addElement([
    'tag' => 'label',
    'attrs' => [
        'for' => 'description_projet'


    ],
    'text' => 'Description',
    'flag' => false
]);

$group->addElement([
    'tag' => 'textarea',
    'attrs' => [
        'id' => 'description_projet',
        'placeholder' => 'Description du projet',
        'class' => 'description_projet',
        'rows' => '5'
    ],
    'text' => '',
    'flag' => true
]);

$group->addElement(['tag' => 'div', 'close' => true]);

/* ==============================
   BOUTON ENVOYER
================================ */
$group->addElement([
    'tag'   => 'div',
    'attrs' => [
        'id'      => 'id_envoyer',
        'onclick' => 'on_send_form(this)',
        'class'   => 'envoyer'
    ],
    'text'  => 'Créer le projet',
    'flag'  => true
]);

/* ==============================
   FERMETURE CONTAINER
================================ */
$group->addElement(['tag' => 'div', 'close' => true]);

/* ==============================
   MANAGER
================================ */
$manager = new GroupManager('formData');
$manager->addGroup($group);

/* ==============================
   RENDU
================================ */
echo $manager->render();
$manager->generateJsInformation('x.php');
$manager->pushJs();

?>

<style>
    /* ===== TITRE ===== */

    .display_none{
        display: none;
    }
    .description_projet {
        width: 100%;
        border-radius: 7px;
        border: 1px solid rgba(0, 0, 0, 0.2);

    }

    .h1_tag {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        color: #1877f2;
    }

    /* ===== CONTAINER ===== */
    #main_container {
        width: 360px;
        margin: 50px auto;
        padding: 25px 20px;
        background-color: #1e293b;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        font-family: Arial, sans-serif;
    }

    /* Chaque div contenant un input */
    #main_container>div {
        margin-bottom: 15px;
    }

    /* ===== INPUTS ===== */
    #main_container input[type="text"],
    #main_container input[type="password"],
    #main_container input[type="checkbox"] {
        font-size: 14px;
        outline: none;
        box-sizing: border-box;
    }

    #main_container input[type="text"],
    #main_container input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    #main_container input:focus {
        border-color: #1877f2;
        box-shadow: 0 0 3px rgba(24, 119, 242, 0.6);
    }

    #main_container input::placeholder {
        color: #999;
    }

    /* Checkbox alignement label à droite */
    #main_container input[type="checkbox"] {
        width: auto;
        margin-left: 10px;
        vertical-align: middle;
    }

    /* ===== LIEN MOT DE PASSE OUBLIÉ ===== */
    #main_container a {
        display: block;
        font-size: 13px;
        color: #1877f2;
        text-decoration: none;
        margin-bottom: 15px;
        text-align: right;
        transition: color 0.2s;
    }

    #main_container a:hover {
        text-decoration: underline;
        color: #145dbf;
    }

    /* ===== DIV ENVOYER ===== */
    .envoyer {
        background-color: rgba(140, 0, 0, 0.4);
        text-align: center;
        padding: 15px;
        color: white;
        cursor: pointer;
        border-radius: 6px;
    }

    .envoyer:hover {
        background-color: rgba(140, 0, 0, 0.6);
    }
</style>

<script>
    

    function on_send_form() {



console.log(formData ) ; 

 
    if (typeof formData === 'undefined') {
        console.warn('formData n\'existe pas encore !');
        return;
    }

    for (let i = 0; i < formData.identite_tab.length; i++) {
        let id = formData.identite_tab[i][0];
        let value = '';

        let el = document.getElementById(id);
        if (el) {
            if (el.type === 'checkbox') {
                value = el.checked ? el.value : '0';
            } else if (el.type === 'radio') {
                let checked = document.querySelector('input[name="' + el.name + '"]:checked');
                value = checked ? checked.value : '';
            } else {
                value = el.value;
            }
            formData.identite_tab[i][1] = value;
        }
    }

    console.log('Valeurs à envoyer :', formData.identite_tab);
    formData.push();

   
}
</script>