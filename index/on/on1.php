<div class="menu_">
    <div class="menu-item" id="menu_tous_projets" title="Tous les projets">
        <i class="fa-solid fa-folder-open"></i>
        <span>Tous les projets</span>
    </div>
    <div class="menu-item" id="menu_nouveau_projet" title="Nouveau projet" onclick="add_element(this)">
        <i class="fa-solid fa-folder-plus"></i>
        <span>Nouveau projet</span>
    </div>

    <hr class="menu-separator">

    <div class="menu-item" id="menu_mon_profil" title="Mon profil">
        <i class="fa-solid fa-user"></i>
        <span>Mon profil</span>
    </div>
    <div class="menu-item logout" id="menu_deconnexion" title="Déconnexion" onclick="session_destroy()">
        <i class="fa-solid fa-right-from-bracket"></i>
        <span>Déconnexion</span>
    </div>
    <div class="menu-item" id="menu_parametres" title="Paramètres">
        <i class="fa-solid fa-gear"></i>
        <span>Paramètres</span>
    </div>

    <hr class="menu-separator">

    <!-- 🔹 Social Media -->
    <div class="menu-item" id="menu_social_media" title="Réseaux sociaux">
        <i class="fa-solid fa-share-nodes"></i>
        <span>Social Media</span>
    </div>
 


    <!--
    <div class="menu-item">
        <i class="fa-solid fa-chart-line"></i>
        <span>Dashboard</span>
    </div>
 

 
    <div class="menu-item">
        <i class="fa-solid fa-star"></i>
        <span>Favoris</span>
    </div>



    <div class="menu-item">
        <i class="fa-solid fa-box-archive"></i>
        <span>Archives</span>
    </div>



-->



</div>




<style>
    /* ===== MENU CONTAINER ===== */
    .menu_ {
        width: 230px;
        background: #0f172a;
        /* bleu foncé */
        border-radius: 14px;
        padding: 12px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.35);
        font-family: "Segoe UI", Arial, sans-serif;
    }

    /* ===== MENU ITEM ===== */
    .menu-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 14px;
        margin-bottom: 4px;
        color: #e5e7eb;
        cursor: pointer;
        border-radius: 10px;
        transition:
            background 0.25s ease,
            transform 0.15s ease,
            box-shadow 0.15s ease;
    }

    /* ===== ICONES ===== */
    .menu-item i {
        font-size: 18px;
        width: 22px;
        text-align: center;
        color: #38bdf8;
    }

    /* ===== TEXTE ===== */
    .menu-item span {
        font-size: 15px;
        white-space: nowrap;
    }

    /* ===== HOVER ===== */
    .menu-item:hover {
        background: #1e293b;
        transform: translateX(4px);
    }

    /* ===== ITEM ACTIF ===== */
    .menu-item.active {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
    }

    .menu-item.active i,
    .menu-item.active span {
        color: #ffffff;
    }

    /* ===== SEPARATEUR ===== */
    .menu-separator {
        border: none;
        height: 1px;
        background: rgba(255, 255, 255, 0.12);
        margin: 10px 0;
    }

    /* ===== BADGE (COMPTEUR) ===== */
    .badge {
        margin-left: auto;
        background: #22c55e;
        color: #052e16;
        padding: 2px 9px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: bold;
    }

    /* ===== DECONNEXION ===== */
    .menu-item.logout i {
        color: #ef4444;
    }

    .menu-item.logout:hover {
        background: rgba(239, 68, 68, 0.18);
    }

    .menu-item.logout:hover i,
    .menu-item.logout:hover span {
        color: #fecaca;
    }

    /* ===== RESPONSIVE (OPTIONNEL) ===== */
    @media (max-width: 600px) {
        .menu_ {
            width: 100%;
            border-radius: 0;
        }
    }
</style>