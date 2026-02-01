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
   LABEL + INDICATEUR
================================ */
.project-form label{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:6px;
    font-size:14px;
    color:#cbd5f5;
}

.project-form .indicator{
    font-size:12px;
    color:#9ca3af;
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

/* PLACEHOLDER CONTENTEDITABLE */
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
   DESCRIPTION PROJET
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
   FOCUS
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
</style>
<style>
    /* ===== CHECKBOX STYLING ===== */
input[type="checkbox"] {
    /* Masquer le checkbox par défaut */
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    width: 22px;
    height: 22px;
    border: 2px solid #cbd5f5;
    border-radius: 6px;
    background-color: #1e293b;
    cursor: pointer;
    position: relative;
    transition: all 0.2s ease;
}

/* Checkbox lorsqu'elle est cochée */
input[type="checkbox"]:checked {
    background: #16a34a; /* vert */
    border-color: #16a34a;
}

/* Tick mark */
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

/* Hover effect */
input[type="checkbox"]:hover {
    border-color: #22c55e;
}

</style>
<?php
$group = new Group(false);

/* CONTENEUR PRINCIPAL */
$group->addElement([
    'tag'=>'div',
    'attrs'=>['class'=>'new-project'],
    'open'=>true,
    'flag'=>true
]);

/* FORMULAIRE */
$group->addElement([
    'tag'=>'form',
    'attrs'=>[
        'class'=>'project-form',
        'method'=>'POST',
        'action'=>'save.php'
    ],
    'open'=>true,
    'flag'=>true
]);

/* =========================
   NOM DU PROJET
========================= */
$group->addElement([
    'tag'=>'p',
    'attrs'=>['class'=>'field-description'],
    'text'=>'Indiquez le nom de votre projet.',
    'flag'=>true
]);
$group->addElement([
    'tag'=>'label',
    'attrs'=>['for'=>'project_name'],
    'open'=>true,
    'flag'=>true
]);
$group->addElement(['tag'=>'text','text'=>'Nom du projet','flag'=>true]);
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
$group->addElement(['tag'=>'label','close'=>true,'flag'=>true]);

/* =========================
   DESCRIPTION PROJET
========================= */
$group->addElement([
    'tag'=>'p',
    'attrs'=>['class'=>'field-description'],
    'text'=>'Décrivez brièvement votre projet.',
    'flag'=>true
]);
$group->addElement([
    'tag'=>'label',
    'attrs'=>['for'=>'description_projet'],
    'open'=>true,
    'flag'=>true
]);
$group->addElement(['tag'=>'text','text'=>'Description','flag'=>true]);
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
$group->addElement(['tag'=>'label','close'=>true,'flag'=>true]);

/* =========================
   GOOGLE TITLE
========================= */
$group->addElement([
    'tag'=>'p',
    'attrs'=>['class'=>'field-description'],
    'text'=>'Indiquez le titre SEO qui apparaîtra dans Google.',
    'flag'=>true
]);
$group->addElement([
    'tag'=>'label',
    'attrs'=>['for'=>'google_title'],
    'open'=>true,
    'flag'=>true
]);
$group->addElement(['tag'=>'text','text'=>'Google Title','flag'=>true]);
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
$group->addElement(['tag'=>'label','close'=>true,'flag'=>true]);

/* =========================
   META CONTENT
========================= */
$group->addElement([
    'tag'=>'p',
    'attrs'=>['class'=>'field-description'],
    'text'=>'Indiquez la meta description SEO.',
    'flag'=>true
]);
$group->addElement([
    'tag'=>'label',
    'attrs'=>['for'=>'metacontent'],
    'open'=>true,
    'flag'=>true
]);
$group->addElement(['tag'=>'text','text'=>'Meta Content','flag'=>true]);
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
$group->addElement(['tag'=>'label','close'=>true,'flag'=>true]);

/* =========================
   PRIX (INPUT NUMBER)
========================= */
$group->addElement([
    'tag'=>'p',
    'attrs'=>['class'=>'field-description'],
    'text'=>'Indiquez le prix du projet.',
    'flag'=>true
]);
$group->addElement([
    'tag'=>'label',
    'attrs'=>['for'=>'prix'],
    'open'=>true,
    'flag'=>true
]);
$group->addElement(['tag'=>'text','text'=>'Prix','flag'=>true]);
$group->addElement([
    'tag'=>'input',
    'attrs'=>[
        'type'=>'number',
        'name'=>'prix',
        'id'=>'prix',
        'min'=>'0',
        'step'=>'1',
        'placeholder'=>'0'
    ],
    'flag'=>true
]);
$group->addElement(['tag'=>'label','close'=>true,'flag'=>true]);

/* =========================
   VISIBILITE (CHECKBOX)
========================= */
$group->addElement([
    'tag'=>'p',
    'attrs'=>['class'=>'field-description'],
    'text'=>'Cochez si le projet doit être visible.',
    'flag'=>true
]);
$group->addElement([
    'tag'=>'label',
    'attrs'=>['for'=>'active_visibilite'],
    'open'=>true,
    'flag'=>true
]);
$group->addElement(['tag'=>'text','text'=>'Visibilité','flag'=>true]);
$group->addElement([
    'tag'=>'input',
    'attrs'=>[
        'type'=>'checkbox',
        'name'=>'active_visibilite',
        'id'=>'active_visibilite',
        'value'=>'1'
    ],
    'flag'=>true
]);
$group->addElement(['tag'=>'label','close'=>true,'flag'=>true]);

/* =========================
   QR CODE (CHECKBOX)
========================= */
$group->addElement([
    'tag'=>'p',
    'attrs'=>['class'=>'field-description'],
    'text'=>'Cochez pour générer un QR code pour ce projet.',
    'flag'=>true
]);
$group->addElement([
    'tag'=>'label',
    'attrs'=>['for'=>'active_qr_code'],
    'open'=>true,
    'flag'=>true
]);
$group->addElement(['tag'=>'text','text'=>'QR Code','flag'=>true]);
$group->addElement([
    'tag'=>'input',
    'attrs'=>[
        'type'=>'checkbox',
        'name'=>'active_qr_code',
        'id'=>'active_qr_code',
        'value'=>'1'
    ],
    'flag'=>true
]);
$group->addElement(['tag'=>'label','close'=>true,'flag'=>true]);

/* =========================
   BOUTON ENVOI
========================= */
$group->addElement([
    'tag'=>'div',
    'attrs'=>[
        'class'=>'submit-btn',
        'onclick'=>'on_send_form()'
    ],
    'open'=>true,
    'flag'=>true
]);
$group->addElement(['tag'=>'text','text'=>'Envoyer','flag'=>true]);
$group->addElement(['tag'=>'div','close'=>true,'flag'=>true]);

/* FERMETURE FORMULAIRE ET CONTENEUR */
$group->addElement(['tag'=>'form','close'=>true,'flag'=>true]);
$group->addElement(['tag'=>'div','close'=>true,'flag'=>true]);

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
