<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Projet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="main-menu">
    <ul>
        <li><a href="#">➕ Ajouter un projet</a></li>
        <li><a href="#">⚙ Paramètres</a></li>
        <li><a href="#">🚪 Déconnexion</a></li>
    </ul>
</nav>

<div class="container">

    <h1>Gestion du projet</h1>

    <form class="card">
<div class="image-wrapper">
    <img src="https://i.pinimg.com/1200x/23/c3/f5/23c3f5f17744088a2d2ed2ab1630c7d1.jpg" alt="Projet">
    
    <!-- Actions -->
    <div class="image-actions">
        <label class="select-btn">
            <input type="file" accept="image/*">
            🔄 Changer
        </label>
        <span class="vd-trash" title="Supprimer l’image">🗑️</span>
    </div>
</div>



<div class="image-children-wrapper">
    <!-- Bouton Ajouter un child -->
    <button type="button" class="add-child-btn">➕ Ajouter un child</button>

    <!-- Liste des childs -->
    <div class="child-list">
        <div class="child-item">
            <img src="https://i.pinimg.com/1200x/23/c3/f5/23c3f5f17744088a2d2ed2ab1630c7d1.jpg" alt="Child 1">
            <span class="vd-trash" title="Supprimer ce child">🗑️</span>
            
        </div>
        <div class="child-item">
            <img src="https://i.pinimg.com/1200x/23/c3/f5/23c3f5f17744088a2d2ed2ab1630c7d1.jpg" alt="Child 2">
            <span class="vd-trash" title="Supprimer ce child">🗑️</span>
        </div>
        <div class="child-item">
            <img src="https://i.pinimg.com/1200x/23/c3/f5/23c3f5f17744088a2d2ed2ab1630c7d1.jpg" alt="Child 3">
            <span class="vd-trash" title="Supprimer ce child">🗑️</span>
        </div>
    </div>
</div>


        <!-- Titre du projet -->
        <div class="field">
            <div class="field-header">
                <input type="checkbox" id="project_title_ck" name="project_title_ck">
                <label for="project_title">Titre du projet</label>
            </div>
            <div class="input-line">
                <input type="text" id="project_title" name="project_title">
                <span class="vd-trash" title="Vider le champ">🗑️</span>
            </div>
        </div>

        <!-- Description -->
        <div class="field">
            <div class="field-header">
                <input type="checkbox" id="project_description_ck" name="project_description_ck">
                <label for="project_description">Description</label>
            </div>
            <div class="input-line">
                <textarea id="project_description" name="project_description"></textarea>
                <span class="vd-trash" title="Vider le champ">🗑️</span>
            </div>
        </div>

        <!-- Meta projet -->
        <div class="field">
            <div class="field-header">
                <input type="checkbox" id="meta_project_ck" name="meta_project_ck">
                <label for="meta_project">Meta projet</label>
            </div>
            <div class="input-line">
                <input type="text" id="meta_project" name="meta_project">
                <span class="vd-trash" title="Vider le champ">🗑️</span>
            </div>
        </div>

        <!-- Google title -->
        <div class="field">
            <div class="field-header">
                <input type="checkbox" id="google_title_ck" name="google_title_ck">
                <label for="google_title">Google title</label>
            </div>
            <div class="input-line">
                <input type="text" id="google_title" name="google_title">
                <span class="vd-trash" title="Vider le champ">🗑️</span>
            </div>
        </div>

        <!-- Meta content -->
        <div class="field">
            <div class="field-header">
                <input type="checkbox" id="meta_content_ck" name="meta_content_ck">
                <label for="meta_content">Meta content</label>
            </div>
            <div class="input-line">
                <textarea id="meta_content" name="meta_content"></textarea>
                <span class="vd-trash" title="Vider le champ">🗑️</span>
            </div>
        </div>

<div  >
    <input class="field_img" type="file" name="project_image">
    <span class="vd-trash">🗑️</span>
</div>




        <!-- Child -->
<!-- Ajout d'un child -->
<!-- Ajout d'un child -->
<div class="field">
    <div class="field-header">
        <input type="checkbox" id="child_ck" name="child_ck">
        <label>Ajout d’un child</label>
    </div>

    <div class="child-action">
        <button type="button" class="child-btn">
            ➕ Ajouter un child
        </button>

        <span class="vd-trash" title="Supprimer tous les childs">🗑️</span>
    </div>

<!-- Simulation des childs -->
<div class="child-list">

    <div class="child-item">
        <span class="child-name">Child 1</span>

        <label class="child-switch">
            <input type="checkbox">
            <span class="child-slider"></span>
        </label>
    </div>

    <div class="child-item">
        <span class="child-name">Child 2</span>

        <label class="child-switch">
            <input type="checkbox" checked>
            <span class="child-slider"></span>
        </label>
    </div>

    <div class="child-item">
        <span class="child-name">Child 3</span>

        <label class="child-switch">
            <input type="checkbox">
            <span class="child-slider"></span>
        </label>
    </div>

    <div class="child-item">
        <span class="child-name">Child 4</span>

        <label class="child-switch">
            <input type="checkbox" checked>
            <span class="child-slider"></span>
        </label>
    </div>

</div>

</div>


    </form>

</div>


<style>
    /* menu principal */
.main-menu {
    background-color: #007bff;
    padding: 10px 20px;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    max-width: 800px;
    margin: 0 auto;
}

/* liste horizontale */
.main-menu ul {
    list-style: none;
    display: flex;
    gap: 20px;
    margin: 0;
    padding: 0;
    align-items: center;
}

/* liens du menu */
.main-menu ul li a {
    text-decoration: none;
    color: white;
    font-weight: bold;
    padding: 6px 12px;
    border-radius: 6px;
    transition: background-color 0.2s, transform 0.1s;
}

/* hover */
.main-menu ul li a:hover {
    background-color: #005fc4;
    transform: scale(1.05);
}

/* responsive pour mobile */
@media (max-width: 500px) {
    .main-menu ul {
        flex-direction: column;
        gap: 10px;
    }
}

</style>
<style>
    * {
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #f4f6f8;
    padding: 30px;
}

.container {
    max-width: 850px;
    margin: auto;
}

h1 {
    text-align: center;
    margin-bottom: 25px;
}

.card {
    background: #fff;
    padding: 30px;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.field {
    margin-bottom: 22px;
}

.field-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 6px;
}

label {
    font-weight: bold;
    color: #444;
}

.input-line {
    display: flex;
    align-items: center;
    gap: 10px;
}

input[type="text"],
input[type="file"],
textarea {
    flex: 1;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 14px;
}

textarea {
    min-height: 90px;
    resize: vertical;
}

/* corbeille vd */
.vd-trash {
    cursor: pointer;
    font-size: 18px;
    color: #999;
    user-select: none;
}

.vd-trash:hover {
    color: #e74c3c;
}


</style>


<style>
    /* liste des childs */
.child-list {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 12px;
}

/* card child */
.child-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;

    padding: 10px 14px;
    min-width: 180px;

    border-radius: 12px;
    background: #f0f6ff;
    border: 1px solid #cce0ff;
}

/* nom */
.child-name {
    font-weight: bold;
    color: #007bff;
    white-space: nowrap;
}

/* switch */
.child-switch {
    position: relative;
    display: inline-block;
    width: 42px;
    height: 22px;
}

.child-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

/* slider */
.child-slider {
    position: absolute;
    cursor: pointer;
    inset: 0;
    background-color: #ccc;
    border-radius: 30px;
    transition: 0.3s;
}

.child-slider::before {
    content: "";
    position: absolute;
    height: 18px;
    width: 18px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    border-radius: 50%;
    transition: 0.3s;
}

/* actif */
.child-switch input:checked + .child-slider {
    background-color: #28a745;
}

.child-switch input:checked + .child-slider::before {
    transform: translateX(20px);
}

</style>

<style>
    /* style global pour toutes les checkboxes */
input[type="checkbox"] {
    /* on masque l'original */
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    width: 22px;
    height: 22px;
    border: 1px solid #ccc;
    border-radius: 6px;
    background-color: #eee;
    cursor: pointer;
    position: relative;
    transition: 0.2s;
}

/* hover */
input[type="checkbox"]:hover {
    border-color: #007bff;
}

/* tick */
input[type="checkbox"]::after {
    content: "";
    position: absolute;
    display: none;
    left: 7px;
    top: 3px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

/* checked */
input[type="checkbox"]:checked {
    background-color: #007bff;
    border-color: #007bff;
}

input[type="checkbox"]:checked::after {
    display: block;
}

/* focus */
input[type="checkbox"]:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(0,123,255,0.25);
}

</style>
<style>
    /* Masque l'input réel */
.custom-checkbox input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

/* Crée le carré stylisé */
.custom-checkbox {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    position: relative;
    font-weight: bold;
    color: #444;
}

.custom-checkbox .checkmark {
    width: 22px;
    height: 22px;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 6px;
    position: relative;
    transition: all 0.2s;
}

/* tick */
.custom-checkbox .checkmark::after {
    content: "";
    position: absolute;
    display: none;
    left: 7px;
    top: 3px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 2px 2px 0;
    transform: rotate(45deg);
}

/* quand coché */
.custom-checkbox input:checked + .checkmark {
    background-color: #007bff;
    border-color: #007bff;
}

.custom-checkbox input:checked + .checkmark::after {
    display: block;
}

/* hover */
.custom-checkbox:hover .checkmark {
    border-color: #007bff;
}


 
</style>
<style>
    /* wrapper général */
.field_img {
    position: relative;
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #f9f9f9;
    cursor: pointer;
    font-size: 14px;
    color: #555;
    display: inline-block;
}

/* masquer l’input natif */
.field_img[type="file"]::-webkit-file-upload-button {
    visibility: hidden;
}

.field_img[type="file"]::file-selector-button {
    visibility: hidden;
}

/* pseudo-bouton “Choisir un fichier” */
.field_img::before {
    content: "Choisir un fichier";
    display: inline-block;
    padding: 6px 12px;
    background-color: #007bff;
    color: #fff;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    margin-right: 10px;
    user-select: none;
}

/* hover du bouton */
.field_img:hover::before {
    background-color: #005fc4;
}

/* texte du fichier choisi */
.field_img::after {
    content: "Aucun fichier choisi";
    margin-left: 5px;
    color: #555;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* vd-trash (si ajouté à côté) */
.vd-trash {
    cursor: pointer;
    font-size: 18px;
    color: #999;
    transition: color 0.2s;
}

.vd-trash:hover {
    color: #e74c3c;
}

</style>


<style>
.image-wrapper {
    position: relative;
    width: 100%;
    max-width: 600px; /* optional, adapte au conteneur */
    margin-bottom: 20px;
}

.image-wrapper img {
    width: 100%;        /* prend toute la largeur */
    max-height: 250px;  /* hauteur max */
    height: auto;       /* proportionnelle */
    display: block;
    object-fit: cover;  /* remplissage largeur */
    border-radius: 10px;
    border: 1px solid #ccc;
}

/* overlay actions */
.image-actions {
    margin-top: 8px;
    display: flex;
    gap: 10px;
    align-items: center;
}

/* bouton sélection / changer */
.select-btn {
    display: inline-block;
    padding: 6px 12px;
    background-color: #007bff;
    color: white;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

/* masquer l’input file natif */
.select-btn input[type="file"] {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0; left: 0;
    opacity: 0;
    cursor: pointer;
}

/* corbeille */
.vd-trash {
    cursor: pointer;
    font-size: 18px;
    color: #999;
    transition: color 0.2s;
}

.vd-trash:hover {
    color: #e74c3c;
}


</style>

<style>
    .image-children-wrapper {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 20px;
}

/* bouton ajouter child */
.add-child-btn {
    padding: 10px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
}

.add-child-btn:hover {
    background-color: #005fc4;
}

/* container flex des childs */
.child-list {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

/* card child */
.child-item {
    position: relative;
    width: 150px;      /* largeur fixe */
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #ccc;
}

/* image dans child */
.child-item img {
    width: 100%;
    height: 100px;
    object-fit: cover;
    display: block;
}

/* corbeille sur chaque child */
.child-item .vd-trash {
    position: absolute;
    top: 6px;
    right: 6px;
    font-size: 16px;
    color: #999;
    background-color: rgba(255,255,255,0.7);
    border-radius: 50%;
    padding: 2px 4px;
    transition: color 0.2s, background-color 0.2s;
    cursor: pointer; /* CURSEUR seulement sur corbeille */
}

.child-item .vd-trash:hover {
    color: #fff;
    background-color: #e74c3c; /* rouge sur hover */
}

</style>
</body>
</html>
