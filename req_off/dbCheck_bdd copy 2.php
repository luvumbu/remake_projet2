<?php
header("Access-Control-Allow-Origin: *");
require_once "../Class/DatabaseHandler.php";

$source_dbcheck = "../info_exe/dbCheck.php";

// ======================================================
// 🔐 RÉCUPÉRATION POST
$dbname   = $_POST["dbname"]   ?? '';
$username = $_POST["username"] ?? '';
$password = $_POST["password"] ?? '';

// ======================================================
// 🔌 CONNEXION DB
$databaseHandler = new DatabaseHandler($dbname, $username, $password);
$tables = $databaseHandler->getAllTables();

// ======================================================
// 1️⃣ TABLE profil_user
$columnsProfilUser = [
    "id_user" => "INT UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "nom_user" => "VARCHAR(100) NOT NULL",
    "prenom_user" => "VARCHAR(100) NOT NULL",
    "email_user" => "VARCHAR(150) NOT NULL UNIQUE",
    "password_user" => "VARCHAR(255) NOT NULL",
    "date_inscription_user" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
];
if (!in_array("profil_user", $tables, true)) {
    $databaseHandler->create_table("profil_user", $columnsProfilUser);
}

// ======================================================
// 2️⃣ TABLE projet (✅ image liée par ID)
$columnsProjet = [
    "id_projet" => "INT UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "id_user_projet" => "INT UNSIGNED NOT NULL",

    "id_projet_img" => "INT UNSIGNED DEFAULT NULL", // 🔗 image principale
    "lieu_projet"   => "VARCHAR(150) DEFAULT NULL",

    "google_title" => "TEXT",
    "use_html_google_title" => "TEXT",
    "use_html_metacontent" => "TEXT",
    "use_html_description_projet" => "TEXT",
    "metacontent" => "TEXT",

    "price" => "INT UNSIGNED NOT NULL",
    "active_voix_vocale" => "TINYINT(1) DEFAULT 0",
    "active_visibilite" => "TINYINT(1) DEFAULT 1",
    "active_qr_code" => "TINYINT(1) DEFAULT 0",

    "name_projet" => "TEXT",
    "use_html_project_name" => "TEXT",
    "parent_projet" => "INT UNSIGNED DEFAULT NULL",

    "description_projet" => "TEXT",
    "password_projet" => "TEXT",

    "date_inscription_projet" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
];
if (!in_array("projet", $tables, true)) {
    $databaseHandler->create_table("projet", $columnsProjet);
}

// FK projet → user
$databaseHandler->addForeignKey(
    "projet",
    "id_user_projet",
    "profil_user",
    "id_user",
    "CASCADE",
    "CASCADE"
);

// FK projet → projet (parent)
$databaseHandler->addForeignKey(
    "projet",
    "parent_projet",
    "projet",
    "id_projet",
    "SET NULL",
    "CASCADE"
);

// ======================================================
// 3️⃣ TABLE projet_img (📸 stockage images)
$columnsProjetImg = [
    "id_projet_img_auto" => "INT UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "id_user_img"        => "INT UNSIGNED NOT NULL",
    "id_projet_img"      => "INT UNSIGNED NOT NULL",

    "img_projet_src_img" => "LONGTEXT NOT NULL",
    "extension_img"      => "VARCHAR(10)",

    "is_selected" => "TINYINT UNSIGNED DEFAULT 0",
    "is_checked"  => "TINYINT UNSIGNED DEFAULT 0",

    "date_inscription_projet_img" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
];
if (!in_array("projet_img", $tables, true)) {
    $databaseHandler->create_table("projet_img", $columnsProjetImg);
}

// FK projet_img → user
$databaseHandler->addForeignKey(
    "projet_img",
    "id_user_img",
    "profil_user",
    "id_user",
    "CASCADE",
    "CASCADE"
);

// FK projet_img → projet
$databaseHandler->addForeignKey(
    "projet_img",
    "id_projet_img",
    "projet",
    "id_projet",
    "CASCADE",
    "CASCADE"
);

// FK projet → image principale
$databaseHandler->addForeignKey(
    "projet",
    "id_projet_img",
    "projet_img",
    "id_projet_img_auto",
    "SET NULL",
    "CASCADE"
);

// ======================================================
// 4️⃣ TABLE projet_params
$columnsProjetParams = [
    "id_param" => "INT UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "id_projet_param" => "INT UNSIGNED NOT NULL",

    "lieu" => "VARCHAR(150) DEFAULT NULL",

    "active_qr_code" => "TINYINT(1) DEFAULT 0",
    "active_visibilite" => "TINYINT(1) DEFAULT 1",

    "title" => "VARCHAR(255) DEFAULT ''",
    "description" => "TEXT DEFAULT NULL",
    "prix" => "DECIMAL(10,2) DEFAULT 0.00",

    "metacontent" => "TEXT DEFAULT NULL",
    "google_title" => "VARCHAR(255) DEFAULT ''",

    "date_debut" => "DATE DEFAULT NULL",
    "date_fin" => "DATE DEFAULT NULL",

    "date_inscription_param" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
];
if (!in_array("projet_params", $tables, true)) {
    $databaseHandler->create_table("projet_params", $columnsProjetParams);
}

// FK projet_params → projet
$databaseHandler->addForeignKey(
    "projet_params",
    "id_projet_param",
    "projet",
    "id_projet",
    "CASCADE",
    "CASCADE"
);

// ======================================================
// 5️⃣ TABLE social_media
$columnsSocialMedia = [
    "id_social_media" => "INT UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "id_user_social_media" => "INT UNSIGNED NOT NULL",
    "name_social_media" => "VARCHAR(100) NOT NULL",
    "statut_social_media" => "VARCHAR(50)",
    "date_inscription_social_media" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
];
if (!in_array("social_media", $tables, true)) {
    $databaseHandler->create_table("social_media", $columnsSocialMedia);
}
$databaseHandler->addForeignKey(
    "social_media",
    "id_user_social_media",
    "profil_user",
    "id_user",
    "CASCADE",
    "CASCADE"
);

// ======================================================
// 6️⃣ TABLE comment (⚠️ mot réservé évité)
$columnsComment = [
    "id_comment" => "INT UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "id_user_comment" => "INT UNSIGNED NOT NULL",
    "comment_text" => "TEXT NOT NULL",
    "date_inscription_comment" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
];
if (!in_array("comment", $tables, true)) {
    $databaseHandler->create_table("comment", $columnsComment);
}
$databaseHandler->addForeignKey(
    "comment",
    "id_user_comment",
    "profil_user",
    "id_user",
    "CASCADE",
    "CASCADE"
);

// ======================================================
// 7️⃣ TABLE req_quiz
$columnsReqQuiz = [
    "id_req_quiz" => "INT UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "id_projet_req_quiz" => "INT UNSIGNED NOT NULL",
    "question_req_quiz" => "TEXT NOT NULL",
    "date_inscription_req_quiz" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
];
if (!in_array("req_quiz", $tables, true)) {
    $databaseHandler->create_table("req_quiz", $columnsReqQuiz);
}
$databaseHandler->addForeignKey(
    "req_quiz",
    "id_projet_req_quiz",
    "projet",
    "id_projet",
    "CASCADE",
    "CASCADE"
);

// ======================================================
// 👤 INSERT USER (email unique auto)
$userData = [
    "nom_user" => $dbname,
    "prenom_user" => $username,
    "email_user" =>"",
    "password_user" => $password
];
$databaseHandler->insert_safe("profil_user", $userData, "email_user");

// ======================================================
// 🔐 CRÉATION dbCheck.php
$content = <<<PHP
<?php
\$dbname = "{$dbname}";
\$username = "{$username}";
\$password = "{$password}";
?>
PHP;

file_put_contents($source_dbcheck, $content);

// ======================================================
$databaseHandler->closeConnection();
