<?php
require_once "require_once.php";
 ?> 

 <style>
/* ===============================
   BASE
================================ */
*{
    box-sizing: border-box;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
}

/* ===============================
   CONTENEUR
================================ */
.new-project{
    max-width:720px;
    margin:30px auto;
    background:#0f172a;
    padding:28px;
    border-radius:18px;
    color:#e5e7eb;
}

/* ===============================
   LABEL
================================ */
.project-form label{
    display:block;
    margin-bottom:18px;
    font-size:14px;
    color:#cbd5f5;
}

/* ===============================
   EDITEURS (BASE)
================================ */
.editor{
    width:100%;
    border:1px solid rgba(255,255,255,.25);
    border-radius:10px;
    background:#1e293b;
    color:#ffffff;
    cursor:text;
    outline:none;
    transition:border-color .15s, box-shadow .15s;
}

/* ===============================
   PLACEHOLDER CONTENTEDITABLE
================================ */
.editor:empty::before{
    content:attr(data-placeholder);
    color:#9ca3af;
    pointer-events:none;
}

/* ===============================
   NOM DU PROJET (INPUT LIKE)
================================ */
#project_name.editor{
    font-size:14px;
    font-weight:normal;
    line-height:1.4;
    min-height:42px;
    padding:10px 12px;
    display:flex;
    align-items:center;
}

/* ===============================
   DESCRIPTION (WORD LIKE)
================================ */
#description_projet.editor{
    min-height:140px;
    padding:12px;
    font-size:14px;
    line-height:1.6;
}

/* ===============================
   GOOGLE TITLE / META CONTENT (COULEUR CLAIRE)
================================ */
#google_title.editor,
#metacontent.editor{
    min-height:42px;
    padding:10px 12px;
    font-size:14px;
    line-height:1.4;
    background:#2c3e50;
    border:1px solid rgba(255,255,255,.25);
    border-radius:8px;
    color:#e5e7eb;
}

#google_title.editor:empty::before,
#metacontent.editor:empty::before{
    color:#b0b8c1;
}

/* ===============================
   FOCUS (INPUT STYLE)
================================ */
.editor:focus{
    border-color:#22c55e;
    box-shadow:0 0 0 2px rgba(34,197,94,.3);
}

/* ===============================
   BOUTON ENVOI
================================ */
.submit-btn{
    margin-top:22px;
    background:#16a34a;
    color:#052e16;
    padding:16px;
    text-align:center;
    border-radius:12px;
    cursor:pointer;
    font-weight:600;
    transition:transform .15s, box-shadow .15s;
}

.submit-btn:hover{
    transform:translateY(-1px);
    box-shadow:0 8px 18px rgba(34,197,94,.4);
}

/* ===============================
   OPTIONNEL : SCROLLBAR PROPRE
================================ */
.editor::-webkit-scrollbar{
    width:8px;
}
.editor::-webkit-scrollbar-thumb{
    background:rgba(255,255,255,.2);
    border-radius:6px;
}
</style>

<?php

/* ==============================
   CRÉATION DU GROUPE
================================ */
$group = new Group(false);

/* ==============================
   CONTENEUR PRINCIPAL
================================ */
$group->addElement([
    'tag'=>'div',
    'attrs'=>['class'=>'new-project'],
    'open'=>true
]);

/* ==============================
   FORMULAIRE
================================ */
$group->addElement([
    'tag'=>'form',
    'attrs'=>[
        'class'=>'project-form',
        'method'=>'POST',
        'action'=>'save.php'
    ],
    'open'=>true
]);

/* ==============================
   NOM DU PROJET
================================ */
$group->addElement(['tag'=>'label','open'=>true]);
$group->addElement(['tag'=>'text','text'=>'Nom du projet']);

$group->addElement([
    'tag'=>'div',
    'attrs'=>[
        'id'=>'project_name',
        'class'=>'editor',
        'contenteditable'=>'true',
        'data-placeholder'=>'Nom du projet...'
    ],
    'flag'=>true
]);
$group->addElement(['tag'=>'label','close'=>true]);

/* ==============================
   DESCRIPTION PROJET
================================ */
$group->addElement(['tag'=>'label','open'=>true]);
$group->addElement(['tag'=>'text','text'=>'Description']);

$group->addElement([
    'tag'=>'div',
    'attrs'=>[
        'id'=>'description_projet',
        'class'=>'editor',
        'contenteditable'=>'true',
        'spellcheck'=>'true',
        'data-placeholder'=>'Décris brièvement le projet...'
    ],
    'flag'=>true
]);
$group->addElement(['tag'=>'label','close'=>true]);

/* ==============================
   GOOGLE TITLE
================================ */
$group->addElement(['tag'=>'label','open'=>true]);
$group->addElement(['tag'=>'text','text'=>'Google Title']);

$group->addElement([
    'tag'=>'div',
    'attrs'=>[
        'id'=>'google_title',
        'class'=>'editor',
        'contenteditable'=>'true',
        'data-placeholder'=>'Titre SEO Google...'
    ],
    'flag'=>true
]);
$group->addElement(['tag'=>'label','close'=>true]);

/* ==============================
   META CONTENT
================================ */
$group->addElement(['tag'=>'label','open'=>true]);
$group->addElement(['tag'=>'text','text'=>'Meta Content']);

$group->addElement([
    'tag'=>'div',
    'attrs'=>[
        'id'=>'metacontent',
        'class'=>'editor',
        'contenteditable'=>'true',
        'data-placeholder'=>'Meta description SEO...'
    ],
    'flag'=>true
]);
$group->addElement(['tag'=>'label','close'=>true]);

/* ==============================
   BOUTON ENVOI
================================ */
$group->addElement([
    'tag'=>'div',
    'attrs'=>[
        'class'=>'submit-btn',
        'onclick'=>'on_send_form()'
    ],
    'open'=>true
]);
$group->addElement(['tag'=>'text','text'=>'Envoyer','flag'=>true]);
$group->addElement(['tag'=>'div','close'=>true]);

/* ==============================
   FERMETURE FORMULAIRE & CONTENEUR
================================ */
$group->addElement(['tag'=>'form','close'=>true]);
$group->addElement(['tag'=>'div','close'=>true]);

/* ==============================
   MANAGER
================================ */
$manager = new GroupManager('formData');
$manager->addGroup($group);

echo $manager->render();
$manager->generateJsInformation('x.php');
$manager->pushJs();
?>

<script>
function on_send_form() {

    console.log(formData);

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
                let checked = document.querySelector(
                    'input[name="' + el.name + '"]:checked'
                );
                value = checked ? checked.value : '';
            } else {
                value = el.innerHTML ?? el.value;
            }
            formData.identite_tab[i][1] = value;
        }
    }

    console.log('Valeurs à envoyer :', formData.identite_tab);
    formData.push();
}
</script>
