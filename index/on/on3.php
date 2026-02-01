<style>
    .display_none{
        display: none;
    }
    .display_block{
        display: block;
    }
    .editor {
        min-height: 160px;
        padding: 10px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        background: rgba(0, 0, 0, 0.4);
        cursor: text;
        margin-bottom: 18px;
        margin-top: 8px;
        border-radius: 8px;
    }

    /* PLACEHOLDER */
    .editor:empty::before {
        content: attr(data-placeholder);
        color: #999;
        pointer-events: none;
    }

    .new-project {
        max-width: 700px;
        margin: 30px auto;
        background: #0f172a;
        border-radius: 18px;
        padding: 28px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        color: #e5e7eb;
    }

    .new-project h2 {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 22px;
        margin-bottom: 22px;
    }

    /* ===== FORM ===== */
    .project-form label {
        display: flex;
        flex-direction: column;
        font-size: 14px;
        margin-bottom: 16px;
        color: #cbd5f5;
    }

    .project-form input,
    .project-form textarea,
    .project-form select {
        margin-top: 6px;
        padding: 10px 12px;
        border-radius: 10px;
        border: none;
        background: #1e293b;
        color: #ffffff;
        font-size: 14px;
    }

    .project-form textarea {
        resize: vertical;
        min-height: 80px;
    }

    /* ===== ROW ===== */
    .form-row {
        display: flex;
        gap: 16px;
    }

    .form-row label {
        flex: 1;
    }

    /* ===== BOUTON ===== */
    .project-form button {
        margin-top: 10px;
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border: none;
        padding: 12px 18px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: bold;
        color: #052e16;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: transform 0.15s, box-shadow 0.15s;
    }

    .project-form button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(34, 197, 94, 0.4);
    }
</style>

<?php
/* ==============================
   GROUPE PRINCIPAL
================================ */
$group = new Group(false);

/* ==============================
   DIV PRINCIPALE
================================ */
$group->addElement([
    'tag'   => 'div',
    'attrs' => ['class' => 'new-project'],
    'open'  => true,
    'flag'  => false
]);

/* ==============================
   FORMULAIRE
================================ */
$group->addElement([
    'tag'   => 'form',
    'attrs' => [
        'class'    => 'project-form',
        'method'   => 'POST',
        'action'   => 'save.php',
        'onsubmit' => 'return submitForm()'
    ],
    'open' => true,
    'flag' => false
]);

/* ==============================
   LABEL NOM DU PROJET
================================ */
$group->addElement(['tag' => 'label', 'open' => true, 'flag' => false]);
$group->addElement(['tag' => 'text', 'text' => 'Nom du projet']);
$group->addElement([
    'tag'   => 'input',
    'attrs' => [
        'type'        => 'text',
        'name'        => 'project_name',
        'id' => 'project_name',
        'value' => "",
        'placeholder' => 'Ex : Site vitrine, App mobile...',
        'required'    => 'required'
    ],
    'flag' => true
]);
$group->addElement(['tag' => 'label', 'close' => true]);

/* ==============================
   LABEL DESCRIPTION + EDITOR
================================ */
$group->addElement(['tag' => 'label', 'open' => true, 'flag' => false]);
$group->addElement(['tag' => 'text', 'text' => 'Description']);

/* editor-wrapper */
$group->addElement([
    'tag'   => 'div',
    'attrs' => ['class' => 'editor-wrapper'],
    'open'  => true,
    'flag'  => false
]);

/* div contenteditable */
$group->addElement([
    'tag'   => 'div',
    'attrs' => [
        'id'               => 'editor',
        'class'            => 'editor',
        'contenteditable'  => 'true',
        'spellcheck'       => 'true',
        'data-placeholder' => 'Décris brièvement le projet...'
    ],
    'flag' => true
]);

/* fermeture editor-wrapper */
$group->addElement(['tag' => 'div', 'close' => true]);

/* input hidden pour récupérer le HTML */
$group->addElement([
    'tag'   => 'input',
    'attrs' => [
        'type' => 'hidden',
        'name' => 'description',
        'id'   => 'description'
    ],
    'flag' => true
]);

$group->addElement(['tag' => 'label', 'close' => true]);

/* ==============================
   TYPE DE PROJET
================================ */
$group->addElement([
    'tag'   => 'div',
    'attrs' => ['class' => 'form-row'],
    'open'  => true,
    'flag'  => false
]);

$group->addElement(['tag' => 'label', 'open' => true, 'flag' => false]);
$group->addElement(['tag' => 'text', 'text' => 'Type de projet']);



/* ==============================
   BOUTON ADD CHILD
================================ */



/*
$group->addElement([
    'tag'   => 'div',
    'attrs' => [
        'id'    => 'add-child-btn',   // pour le style ou le click JS
        'class' => 'add-child-btn'
    ],
    'open'  => true,
    'flag'  => false
]);

$group->addElement([
    'tag'  => 'text',
    'text' => '<i class="fa-solid fa-plus"></i> Add Child ',
    'attrs' => [

        'class' => 'add-child'
    ],
    'flag' => true
]);

$group->addElement([
    'tag'   => 'div',
    'close' => true
]);

*/

$group->addElement([
    'tag'   => 'div',
    'attrs' => [
        'id'    => 'submit-btn',   // pour le style ou le click JS
        'class' => 'submit-btn',
        'onclick'=>'on_send_form(this)'
    ],
    'open'  => true,
    'flag'  => false
]);

$group->addElement([
    'tag'  => 'text',
    'text' => 'Envoyer',
    'flag' => true
]);

$group->addElement([
    'tag'   => 'div',
    'close' => true
]);

/* ==============================
   FERMETURE FORMULAIRE
================================ */
 
/* ==============================
   FERMETURE DIV PRINCIPALE
================================ */
$group->addElement(['tag' => 'div', 'close' => true]);
$group->addElement(['tag' => 'div', 'close' => true]);

/* ==============================
   MANAGER & RENDU
================================ */
$manager = new GroupManager('formData');
$manager->addGroup($group);

echo $manager->render();

$manager->generateJsInformation('x.php');
$manager->pushJs();
?>

<style>
    .submit-btn,
    .add-child-btn {
        background-color: #16a34a;
        color: #cbd5f5;
        padding: 17px;
        text-align: center;
    }

    .submit-btn:hover,
    .add-child-btn {

        cursor: pointer;
    }

    .add-child-btn {
        margin-bottom: 40px;
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