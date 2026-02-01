 

<div class="profile">

    <h2><i class="fa-solid fa-user"></i> Mon profil</h2>

    <!-- INFOS PERSONNELLES -->
    <div class="profile-card">
        <h3>Informations personnelles</h3>

        <div class="profile-row">
            <label>
                Nom
                <input type="text" value="LUVUMBU">
            </label>

            <label>
                Prénom
                <input type="text" value="Maste">
            </label>
        </div>

        <label>
            Adresse email
            <input type="email" value="maste@email.com">
        </label>

        <button class="btn save">
            <i class="fa-solid fa-floppy-disk"></i> Enregistrer
        </button>
    </div>

    <!-- SECURITE -->
    <div class="profile-card">
        <h3>Sécurité</h3>

        <label>
            Mot de passe actuel
            <input type="password" placeholder="Mot de passe actuel">
        </label>

        <label>
            Nouveau mot de passe
            <input type="password" placeholder="Nouveau mot de passe">
        </label>

        <label>
            Confirmer le mot de passe
            <input type="password" placeholder="Confirmer">
        </label>

        <button class="btn password">
            <i class="fa-solid fa-lock"></i> Changer le mot de passe
        </button>
    </div>

</div>


<style>
    .profile {
    max-width: 800px;
    margin: 30px auto;
    padding: 20px;
    color: #e5e7eb;
}

.profile h2 {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 22px;
    margin-bottom: 20px;
}

/* ===== CARD ===== */
.profile-card {
    background: #0f172a;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.35);
    margin-bottom: 24px;
}

.profile-card h3 {
    margin-top: 0;
    margin-bottom: 16px;
    font-size: 18px;
}

/* ===== FORM ===== */
.profile-card label {
    display: flex;
    flex-direction: column;
    font-size: 14px;
    margin-bottom: 14px;
    color: #cbd5f5;
}

.profile-card input {
    margin-top: 6px;
    padding: 10px 12px;
    border-radius: 10px;
    border: none;
    background: #1e293b;
    color: #ffffff;
    font-size: 14px;
}

/* ===== ROW ===== */
.profile-row {
    display: flex;
    gap: 16px;
}

.profile-row label {
    flex: 1;
}

/* ===== BOUTONS ===== */
.btn {
    border: none;
    padding: 12px 18px;
    border-radius: 12px;
    font-size: 14px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: bold;
}

/* SAVE */
.btn.save {
    background: linear-gradient(135deg, #38bdf8, #0ea5e9);
    color: #082f49;
}

/* PASSWORD */
.btn.password {
    background: linear-gradient(135deg, #facc15, #eab308);
    color: #422006;
}

/* HOVER */
.btn:hover {
    opacity: 0.9;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 600px) {
    .profile-row {
        flex-direction: column;
    }
}

</style>
 