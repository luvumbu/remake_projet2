<div class="new-project">

    <form class="project-form" method="POST" action="save.php" onsubmit="return submitForm()">

        <label>
            Nom du projet
            <input type="text" name="project_name"
                   placeholder="Ex : Site vitrine, App mobile..." required>
        </label>

        <label>
            Description

            <div class="editor-wrapper">
                <div id="editor"
                     class="editor"
                     contenteditable="true"
                     spellcheck="true"
                     data-placeholder="Décris brièvement le projet...">
                </div>
            </div>

            <input type="hidden" name="description" id="description">
        </label>

        <div class="form-row">
            <label>
                Type de projet
                <select name="project_type">
                    <option>Site web</option>
                    <option>Application mobile</option>
                    <option>API / Backend</option>
                    <option>Logiciel</option>
                    <option>Autre</option>
                </select>
            </label>
        </div>

        <div class="form-row">
            <label>
                Date de début
                <input type="date" name="start_date">
            </label>
        </div>

        <button type="submit">
            <i class="fa-solid fa-check"></i> Créer le projet
        </button>

    </form>

</div>

<style>

    .editor {
    min-height: 160px;
    padding: 10px;
    border: 1px solid rgba(255, 255, 255, 0.4);
    background:rgba(0, 0, 0, 0.4);
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