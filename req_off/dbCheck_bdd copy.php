<?php
header("Access-Control-Allow-Origin: *");
require_once "../Class/DatabaseHandler.php";
$source_dbcheck = "../info_exe/dbCheck.php";

// ======================================================
// 🔐 Récupération des valeurs POST
$dbname   = $_POST["dbname"]   ?? '';
$username = $_POST["username"] ?? '';
$password = $_POST["password"] ?? '';

// ======================================================
// Connexion DB
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Récupération des tables existantes
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
$tableName = "profil_user";
if (!in_array($tableName, $tables, true)) {
    $databaseHandler->create_table($tableName, $columnsProfilUser);
}

// ======================================================
// 2️⃣ TABLE projet
$columnsProjet = [
    "id_projet" => "INT UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "id_user_projet" => "INT UNSIGNED NOT NULL",
    "google_title" => "TEXT",
    "use_html_google_title" => "TEXT",
    "use_html_metacontent" => "TEXT",
    "use_html_description_projet"=>"TEXT",
    "metacontent" => "TEXT",
    "price" => "INT UNSIGNED NOT NULL",
    "active_voix_vocale"=>"INT UNSIGNED NOT NULL",
    "active_visibilite" => "INT UNSIGNED NOT NULL",
    "active_qr_code" => "INT UNSIGNED NOT NULL",
    "name_projet" => "TEXT",
    "use_html_project_name"=>"TEXT",
    "parent_projet" => "INT UNSIGNED DEFAULT NULL",
    "description_projet" => "TEXT",
    "password_projet"=>"TEXT",
    "img_projet"=>"TEXT",
    "date_inscription_projet" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
];
$tableName = "projet";
if (!in_array($tableName, $tables, true)) {
    $databaseHandler->create_table($tableName, $columnsProjet);
}

// FK projet → profil_user
$successFK1 = $databaseHandler->addForeignKey(
    "projet",
    "id_user_projet",
    "profil_user",
    "id_user",
    "CASCADE",
    "CASCADE"
);

// FK projet → projet (parent)
$successFKParent = $databaseHandler->addForeignKey(
    "projet",
    "parent_projet",
    "projet",
    "id_projet",
    "CASCADE",
    "CASCADE"
);

// ======================================================
// 3️⃣ TABLE style
$columnsStyle = [
    "id_style" => "INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "id_projet_style" => "INT(10) UNSIGNED",
    "color_text" => "VARCHAR(20)",
    "background_color" => "VARCHAR(20)",
    "border_color" => "VARCHAR(20)",
    "gradient_background" => "VARCHAR(255)",
    "font_family" => "VARCHAR(100)",
    "font_size" => "VARCHAR(10)",
    "font_weight" => "VARCHAR(20)",
    "font_style" => "VARCHAR(20)",
    "line_height" => "VARCHAR(10)",
    "text_align" => "VARCHAR(20)",
    "text_decoration" => "VARCHAR(20)",
    "text_transform" => "VARCHAR(20)",
    "letter_spacing" => "VARCHAR(10)",
    "word_spacing" => "VARCHAR(10)",
    "border_width" => "VARCHAR(10)",
    "border_style" => "VARCHAR(20)",
    "border_radius" => "VARCHAR(10)",
    "margin_top" => "VARCHAR(10)",
    "margin_bottom" => "VARCHAR(10)",
    "margin_left" => "VARCHAR(10)",
    "margin_right" => "VARCHAR(10)",
    "padding_top" => "VARCHAR(10)",
    "padding_bottom" => "VARCHAR(10)",
    "padding_left" => "VARCHAR(10)",
    "padding_right" => "VARCHAR(10)",
    "box_shadow" => "VARCHAR(100)",
    "text_shadow" => "VARCHAR(100)",
    "width" => "VARCHAR(20)",
    "height" => "VARCHAR(20)",
    "max_width" => "VARCHAR(20)",
    "max_height" => "VARCHAR(20)",
    "min_width" => "VARCHAR(20)",
    "min_height" => "VARCHAR(20)",
    "display" => "VARCHAR(20)",
    "position" => "VARCHAR(20)",
    "top" => "VARCHAR(20)",
    "bottom" => "VARCHAR(20)",
    "left" => "VARCHAR(20)",
    "right" => "VARCHAR(20)",
    "z_index" => "INT(11)",
    "flex_direction" => "VARCHAR(20)",
    "justify_content" => "VARCHAR(20)",
    "align_items" => "VARCHAR(20)",
    "flex_wrap" => "VARCHAR(20)",
    "grid_template_columns" => "VARCHAR(255)",
    "grid_template_rows" => "VARCHAR(255)",
    "grid_gap" => "VARCHAR(20)",
    "transition" => "VARCHAR(255)",
    "animation" => "VARCHAR(255)",
    "overflow" => "VARCHAR(20)",
    "overflow_x" => "VARCHAR(20)",
    "overflow_y" => "VARCHAR(20)",
    "visibility" => "VARCHAR(20)",
    "cursor" => "VARCHAR(50)",
    "date_inscription_style" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
];
$tableName = "style";
if (!in_array($tableName, $tables, true)) {
    $databaseHandler->create_table($tableName, $columnsStyle);
}
$successFKStyle = $databaseHandler->addForeignKey(
    "style",
    "id_projet_style",
    "projet",
    "id_projet",
    "CASCADE",
    "CASCADE"
);

// ======================================================
// 4️⃣ TABLE projet_params
$columnsProjetParams = [
    "id_param" => "INT UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "id_projet_param" => "INT UNSIGNED NOT NULL",
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
$tableName = "projet_params";
if (!in_array($tableName, $tables, true)) {
    $databaseHandler->create_table($tableName, $columnsProjetParams);
}
$successFKParams = $databaseHandler->addForeignKey(
    "projet_params",
    "id_projet_param",
    "projet",
    "id_projet",
    "CASCADE",
    "CASCADE"
);

// ======================================================
// 5️⃣ TABLE projet_img (✅ MODIFIÉE : id_user_img OBLIGATOIRE)
$columnsProjetImg = [
"id_projet_img_auto"       => "INT UNSIGNED AUTO_INCREMENT PRIMARY KEY",
"id_user_img"              => "INT UNSIGNED NOT NULL",
"id_projet_img"            => "INT UNSIGNED NOT NULL",
"img_projet_src_img"       => "LONGTEXT NOT NULL",
"extension_img"            => "VARCHAR(10)",
"date_inscription_projet_img" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
"is_selected"              => "TINYINT UNSIGNED DEFAULT 0",   // valeur de 0 à 10 pour la radio
"is_checked"               => "TINYINT UNSIGNED DEFAULT 0"    // valeur de 0 à 10 pour la checkbox


];
$tableName = "projet_img";
if (!in_array($tableName, $tables, true)) {
    $databaseHandler->create_table($tableName, $columnsProjetImg);
}

// FK projet_img → profil_user
$successFKImgUser = $databaseHandler->addForeignKey(
    "projet_img",
    "id_user_img",
    "profil_user",
    "id_user",
    "CASCADE",
    "CASCADE"
);

// FK projet_img → projet
$successFK2 = $databaseHandler->addForeignKey(
    "projet_img",
    "id_projet_img",
    "projet",
    "id_projet",
    "CASCADE",
    "CASCADE"
);

// ======================================================
// 6️⃣ TABLE social_media
$columnsSocialMedia = [
    "id_social_media" => "INT UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "id_user_social_media" => "INT UNSIGNED NOT NULL",
    "name_social_media" => "VARCHAR(100) NOT NULL",
    "statut_social_media" => "VARCHAR(50)",
    "date_inscription_social_media" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
];
$databaseHandler->create_table("social_media", $columnsSocialMedia);
$successFK3 = $databaseHandler->addForeignKey(
    "social_media",
    "id_user_social_media",
    "profil_user",
    "id_user",
    "CASCADE",
    "CASCADE"
);

// ======================================================
// 7️⃣ TABLE comment
$columnsComment = [
    "id_comment" => "INT UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "id_user_comment" => "INT UNSIGNED NOT NULL",
    "comment_text" => "TEXT NOT NULL",
    "date_inscription_comment" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
];
$tableName = "comment";
if (!in_array($tableName, $tables, true)) {
    $databaseHandler->create_table($tableName, $columnsComment);
}
$successFK4 = $databaseHandler->addForeignKey(
    "comment",
    "id_user_comment",
    "profil_user",
    "id_user",
    "CASCADE",
    "CASCADE"
);

// ======================================================
// 8️⃣ TABLE req_quiz
$columnsReqQuiz = [
    "id_req_quiz" => "INT UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "id_projet_req_quiz" => "INT UNSIGNED NOT NULL",
    "question_req_quiz" => "TEXT NOT NULL",
    "date_inscription_req_quiz" => "TIMESTAMP DEFAULT CURRENT_TIMESTAMP"
];
$databaseHandler->create_table("req_quiz", $columnsReqQuiz);
$successFK5 = $databaseHandler->addForeignKey(
    "req_quiz",
    "id_projet_req_quiz",
    "projet",
    "id_projet",
    "CASCADE",
    "CASCADE"
);

// ======================================================
// 👤 AJOUT UTILISATEUR
$userData = [
    'nom_user' => $dbname,
    'prenom_user' => $username,
    'email_user' => "",
    'password_user' => $password
];
$resultUser = $databaseHandler->insert_safe("profil_user", $userData, "email_user");

// ======================================================
// ✅ CRÉATION dbCheck.php
if (
    $successFK1 &&
    $successFKParent &&
    $successFKStyle &&
    $successFKParams &&
    $successFK2 &&
    $successFKImgUser &&
    $successFK3 &&
    $successFK4 &&
    $successFK5
) {
    $content = <<<PHP
<?php
\$dbname = "{$dbname}";
\$username = "{$username}";
\$password = "{$password}";
?>
PHP;
    file_put_contents($source_dbcheck, $content);
}

// ======================================================
$databaseHandler->closeConnection();
