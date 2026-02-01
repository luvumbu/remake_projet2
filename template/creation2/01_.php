<?php
require_once "../Class/Element_.php";
require_once "../Class/Group_.php";
require_once "../Class/GroupManager_.php";
require_once "../Class/DatabaseHandler.php";

/* ==============================
   GROUPE PRINCIPAL
================================ */
$group = new Group(false);

/* ==============================
   CONTAINER PRINCIPAL
================================ */
$group->addElement([
    'tag'   => 'div',
    'attrs' => ['id' => 'main_container'],
    'open'  => true,
    'flag'  => false
]);

/* ==============================
   TITRE DU FORMULAIRE
================================ */
$group->addElement([
    'tag'   => 'h1',
    'attrs' => ['class'=>"h1_tag"],
    'text'  => 'Mon formulaire',
    'flag'  => true
]);

/* ==============================
   INPUT 1 — DB NAME
================================ */
$group->addElement(['tag'=>'div','open'=>true]);
$group->addElement([
    'tag'=>'label',
    'attrs'=>['for'=>'mon_id_1'],
    'text'=>'DB NAME',
    'flag'=>false
]);
$group->addElement([
    'tag'=>'input',
    'attrs'=>[
        'type'=>'text',
        'id'=>'mon_id_1',
        'placeholder'=>'dbname'
    ],
    'self'=>true,
    'flag'=>true
]);
$group->addElement(['tag'=>'div','close'=>true]);

/* ==============================
   INPUT 2 — TABLE NAME
================================ */
$group->addElement(['tag'=>'div','open'=>true]);
$group->addElement([
    'tag'=>'label',
    'attrs'=>['for'=>'mon_id_2'],
    'text'=>'TABLE NAME',
    'flag'=>false
]);
$group->addElement([
    'tag'=>'input',
    'attrs'=>[
        'type'=>'text',
        'id'=>'mon_id_2',
        'placeholder'=>'table name'
    ],
    'self'=>true,
    'flag'=>true
]);
$group->addElement(['tag'=>'div','close'=>true]);

/* ==============================
   INPUT 3 — PASSWORD
================================ */
$group->addElement(['tag'=>'div','open'=>true]);
$group->addElement([
    'tag'=>'label',
    'attrs'=>['for'=>'mon_id_3'],
    'text'=>'PASSWORD',
    'flag'=>false
]);
$group->addElement([
    'tag'=>'input',
    'attrs'=>[
        'type'=>'password',
        'id'=>'mon_id_3',
        'placeholder'=>'password'
    ],
    'self'=>true,
    'flag'=>true
]);
$group->addElement(['tag'=>'div','close'=>true]);

/* ==============================
   DIV ENVOYER
================================ */
$group->addElement([
    'tag'   => 'div',
    'attrs' => [
        'id'      => 'id_envoyer',
        'onclick' => 'send()',
        'class'   => 'envoyer'
    ],
    'text'  => 'Envoyer',
    'flag'  => true
]);

/* ==============================
   FERMETURE CONTAINER
================================ */
$group->addElement(['tag'=>'div','close'=>true]);

/* ==============================
   MANAGER
================================ */
$manager = new GroupManager('formData');
$manager->addGroup($group);

/* ==============================
   RENDU HTML + JS
================================ */
echo $manager->render();
$manager->generateJsInformation('traitement.php');
$manager->pushJs();
?>

<style>
/* ===== TITRE ===== */
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
    background-color: #f0f2f5;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    font-family: Arial, sans-serif;
}

/* Chaque div contenant un input */
#main_container > div {
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
    box-shadow: 0 0 3px rgba(24,119,242,0.6);
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
.envoyer{
    background-color: rgba(140,0,0,0.4); 
    text-align: center; 
    padding: 15px;
    color: white;
    cursor: pointer;
    border-radius: 6px;
}
.envoyer:hover{
    background-color: rgba(140,0,0,0.6);
}
</style>

<script>
function send() {



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


 