 <?php

    session_start();
    require_once "../Class/DatabaseHandler.php";
    require_once "../req_form/dbCheck.php";
    echo "<br/>_____";
    echo "<br/>_____";
    echo "<br/>_____";
    echo "<br/>_____";
    echo "<br/>_____";
    echo "<br/>_____";
    echo "<br/>_____";
    echo "<br/>_____";




    $id_user_index = $_SESSION["info_index"][1][0]["id_user"];
    echo "<br/>_____";

    $databaseHandler = new DatabaseHandler($dbname, $username, $password);

    // Je veux ma propre requête
    $sql = "SELECT *
FROM projet AS p           -- p : table principale des projets

-- 🔹 Style du projet
LEFT JOIN style AS s 
    ON p.id_projet = s.id_projet_style    -- s : style associé à chaque projet

-- 🔹 Images du projet
LEFT JOIN projet_img AS pi 
    ON p.id_projet = pi.id_projet_img     -- pi : toutes les images liées au projet

-- 🔹 Paramètres du projet
LEFT JOIN projet_params AS pp
    ON p.id_projet = pp.id_projet_param   -- pp : paramètres comme QR code, visibilité, prix, etc.

-- 🔹 Commentaires de l'utilisateur
LEFT JOIN comment AS c 
    ON p.id_user_projet = c.id_user_comment  -- c : tous les commentaires de l'utilisateur du projet

-- 🔹 Réseaux sociaux de l'utilisateur
LEFT JOIN social_media AS sm 
    ON p.id_user_projet = sm.id_user_social_media  -- sm : infos réseaux sociaux de l'utilisateur

-- 🔹 Questions du quiz du projet
LEFT JOIN req_quiz AS rq 
    ON p.id_projet = rq.id_projet_req_quiz   -- rq : questions du quiz associées au projet

-- 🔹 Profil complet de l'utilisateur
LEFT JOIN profil_user AS u
    ON p.id_user_projet = u.id_user        -- u : infos de l'utilisateur (nom, prénom, email, mot de passe...)

-- 🔹 Filtre pour ne récupérer que les projets de l'utilisateur spécifique
WHERE p.id_user_projet = $id_user_index;


";
/*
p → Projet principal

s → Style du projet

pi → Images du projet

pp → Paramètres du projet

c → Commentaires de l’utilisateur

sm → Réseaux sociaux de l’utilisateur

rq → Questions du quiz liées au projet

u → Profil complet de l’utilisateur (nom, prénom, email, mot de passe…)

WHERE p.id_user_projet = 1 → Filtre sur l’utilisateur pour ne récupérer que ses projets



*/
    // On exécute et on crée une variable globale $mes_projets
    $result = $databaseHandler->select_custom_safe($sql, 'mes_projets');
/*
    if ($result['success']) {
        echo "<pre>";
   var_dump($mes_projets); // accès direct via la variable globale
        echo "</pre>";
    } else {
        echo "Erreur : " . $result['message'];
    }


*/



$structuredProjects = [];

foreach ($mes_projets as $p) {
    $id = $p['id_projet'];

    // Si le projet n'existe pas encore dans le tableau structuré
    if (!isset($structuredProjects[$id])) {
        $structuredProjects[$id] = [
            'projet' => [
                'id_projet' => $p['id_projet'],
                'name_projet' => $p['name_projet'],
                'description_projet' => $p['description_projet'],
                // … ajoute d'autres champs si besoin
            ],
            'style' => [],
            'images' => [],
            'params' => [],
            'comments' => [],
            'social_media' => [],
            'quiz' => [],
            'user' => [
                'id_user' => $p['id_user'],
                'nom_user' => $p['nom_user'],
                'prenom_user' => $p['prenom_user'],
                'email_user' => $p['email_user'],
                'password_user' => $p['password_user'],
            ],
        ];
    }

    // 🔹 Ajouter style si présent
    if ($p['id_style'] ?? false) {
        $structuredProjects[$id]['style'][] = $p;
    }

    // 🔹 Ajouter images si présent
    if ($p['id_projet_img'] ?? false) {
        $structuredProjects[$id]['images'][] = [
            'src' => $p['img_projet_src_img'],
            'extension' => $p['extension_img']
        ];
    }

    // 🔹 Ajouter params si présent
    if ($p['id_param'] ?? false) {
        $structuredProjects[$id]['params'][] = $p;
    }

    // 🔹 Ajouter commentaires
    if ($p['id_comment'] ?? false) {
        $structuredProjects[$id]['comments'][] = $p;
    }

    // 🔹 Ajouter réseaux sociaux
    if ($p['id_social_media'] ?? false) {
        $structuredProjects[$id]['social_media'][] = $p;
    }

    // 🔹 Ajouter quiz
    if ($p['id_req_quiz'] ?? false) {
        $structuredProjects[$id]['quiz'][] = $p;
    }
}

// 🔹 Réindexer pour avoir des indices 0,1,2…
$structuredProjects = array_values($structuredProjects);

// Exemple d'accès direct au premier projet et à tous ses quiz
$firstProjectQuizzes = $structuredProjects[0]['quiz'];
$firstProjectquiz = $structuredProjects[0]['style'];
 

echo "<pre>";
 var_dump($structuredProjects[1]) ; 

 
echo "</pre>";
    
    ?>



 