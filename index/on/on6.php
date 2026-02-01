<div class="settings">
    <h2><i class="fa-solid fa-gear"></i> Paramètres</h2>
    <!-- AFFICHAGE -->
    <div class="settings-card">
        <h3>Affichage</h3>

        <div class="setting-row">
            <span>Mode sombre</span>
            <label class="switch">
                <input type="checkbox" checked>
                <span class="slider"></span>
            </label>
        </div>

        <div class="setting-row">
            <span>Animations</span>
            <label class="switch">
                <input type="checkbox" checked>
                <span class="slider"></span>
            </label>
        </div>
    </div>
    <!-- NOTIFICATIONS -->
    <div class="settings-card">
        <h3>Notifications</h3>

        <div class="setting-row">
            <span>Email</span>
            <label class="switch">
                <input type="checkbox" checked>
                <span class="slider"></span>
            </label>
        </div>

        <div class="setting-row">
            <span>Notifications projets</span>
            <label class="switch">
                <input type="checkbox">
                <span class="slider"></span>
            </label>
        </div>
    </div>

    <!-- GENERAL -->
    <div class="settings-card">
        <h3>Général</h3>

        <label>
            Langue
            <select>
                <option>Français</option>
                <option>English</option>
            </select>
        </label>

        <label>
            Fuseau horaire
            <select>
                <option>Europe/Paris</option>
                <option>UTC</option>
            </select>
        </label>
    </div>
    <button class="btn save-settings">
        <i class="fa-solid fa-floppy-disk"></i> Enregistrer les paramètres
    </button>
</div>
<style>
    .settings {
    max-width: 800px;
    margin: 30px auto;
    padding: 20px;
    color: #e5e7eb;
}

.settings h2 {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 22px;
    margin-bottom: 20px;
}

/* ===== CARD ===== */
.settings-card {
    background: #0f172a;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.35);
    margin-bottom: 24px;
}

.settings-card h3 {
    margin-top: 0;
    margin-bottom: 16px;
    font-size: 18px;
}

/* ===== ROW ===== */
.setting-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
    font-size: 14px;
}

/* ===== SELECT ===== */
.settings-card label {
    display: flex;
    flex-direction: column;
    font-size: 14px;
    margin-bottom: 14px;
    color: #cbd5f5;
}

.settings-card select {
    margin-top: 6px;
    padding: 10px 12px;
    border-radius: 10px;
    border: none;
    background: #1e293b;
    color: #ffffff;
}

/* ===== SWITCH ===== */
.switch {
    position: relative;
    width: 44px;
    height: 24px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    inset: 0;
    background: #475569;
    border-radius: 999px;
    transition: 0.3s;
}

.slider::before {
    content: "";
    position: absolute;
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background: white;
    border-radius: 50%;
    transition: 0.3s;
}

.switch input:checked + .slider {
    background: #22c55e;
}

.switch input:checked + .slider::before {
    transform: translateX(20px);
}

/* ===== BOUTON ===== */
.btn.save-settings {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: #052e16;
    border: none;
    padding: 14px 22px;
    border-radius: 14px;
    font-size: 15px;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
}

.btn.save-settings:hover {
    opacity: 0.9;
}

</style>
 


 