 
<link rel="stylesheet" href="css.css">
<div id="info_index"></div>
<style>
#info_index {

  color: #143b88;
  padding: 20px 24px;
  max-width: 500px;
  margin: 30px auto;

  border-radius: 14px;
  font-family: "Segoe UI", Roboto, Arial, sans-serif;
  font-size: 14.5px;
}



</style>
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
        'id'=>'dbname',
        'value'=>'root',
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
        'type'=>'password',   // <- changé de 'text' à 'password'
        'id'=>'username',
        'value'=>'',
        'placeholder'=>'user name'
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
        'onclick' => 'login_js()',
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
$manager->generateJsInformation('req_on/login_bdd.php');
//$manager->pushJs();
?>
<?php
require_once "index/login_js.php";
?>
 

 

 