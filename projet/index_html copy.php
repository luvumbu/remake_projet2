<?php 
 
// ======================================
// 🔹 Sécurité basique
// ======================================
$url = (int) $url; // force en INT (id_projet)

// ======================================
// 🔹 Connexion DB
// ======================================
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// ======================================
// 🔹 Requête SQL avec parent
// ======================================
$sql = "
SELECT
    p.id_projet,
    p.id_user_projet,
    p.name_projet,
    p.description_projet,
    p.parent_projet,
    p.price,
    p.active_visibilite,
    p.active_qr_code,
    p.img_projet AS img_principale_id,

    ip.id_projet_img_auto   AS main_img_id,
    ip.img_projet_src_img  AS main_img_src,
    ip.extension_img       AS main_img_ext,

    gi.id_projet_img_auto  AS galerie_img_id,
    gi.img_projet_src_img AS galerie_img_src,
    gi.extension_img      AS galerie_img_ext,
    gi.is_selected,
    gi.is_checked,

    s.id_style,
    s.name_style,

    pp.id_param,
    pp.active_visibilite   AS param_visibilite,
    pp.active_qr_code      AS param_qr,
    pp.prix                AS param_prix,
    pp.title               AS param_title,
    pp.description         AS param_description,

    u.id_user,
    u.nom_user,
    u.prenom_user,
    u.email_user

FROM projet p

LEFT JOIN projet_img ip
    ON p.img_projet = ip.id_projet_img_auto

LEFT JOIN projet_img gi
    ON p.id_projet = gi.id_projet_img

LEFT JOIN style s
    ON p.id_projet = s.id_projet_style

LEFT JOIN projet_params pp
    ON p.id_projet = pp.id_projet_param

LEFT JOIN profil_user u
    ON p.id_user_projet = u.id_user

WHERE p.id_projet = {$url} OR p.parent_projet = {$url}
";

// ======================================
// 🔹 Exécution
// ======================================
$result = $databaseHandler->select_custom_safe($sql, 'xx');

if ($result['success']) {

    $projets = [];

    foreach ($xx as $row) {

        $idProjet = $row['id_projet'];

        // ============================
        // INIT PROJET
        // ============================
        if (!isset($projets[$idProjet])) {
            $projets[$idProjet] = [
                'id_projet' => $row['id_projet'],
                'name'      => $row['name_projet'],
                'description' => $row['description_projet'],
                'price'     => $row['price'],
                'parent'    => $row['parent_projet'],

                'user' => [
                    'id'     => $row['id_user'],
                    'nom'    => $row['nom_user'],
                    'prenom' => $row['prenom_user'],
                    'email'  => $row['email_user'],
                ],

                'style' => [
                    'id_style'   => $row['id_style'],
                    'name_style' => $row['name_style'],
                ],

                'params' => [
                    'visible'     => $row['param_visibilite'],
                    'qr_code'     => $row['param_qr'],
                    'prix'        => $row['param_prix'],
                    'title'       => $row['param_title'],
                    'description' => $row['param_description'],
                ],

                'image_principale' => $row['main_img_id'] ? [
                    'id'  => $row['main_img_id'],
                    'src' => $row['main_img_src'],
                    'ext' => $row['main_img_ext'],
                ] : null,

                'images' => []
            ];
        }

        // ============================
        // AJOUT IMAGE GALERIE
        // ============================
        if (!empty($row['galerie_img_id'])) {
            $projets[$idProjet]['images'][$row['galerie_img_id']] = [
                'id'         => $row['galerie_img_id'],
                'src'        => $row['galerie_img_src'],
                'ext'        => $row['galerie_img_ext'],
                'is_selected'=> $row['is_selected'],
                'is_checked' => $row['is_checked'],
            ];
        }
    }

    // ============================
    // FINAL
    // ============================
    foreach ($projets as &$p) {
        $p['images'] = array_values($p['images']);
    }
    unset($p);

    $xx = array_values($projets);
 

} else {
    echo "Erreur SQL : " . $result['message'];
}
 

 


    echo count($xx) ; 



?>




<?php 

$description_projet = $mes_projet_parent[0]["description_projet"];
$description_projet_n = html_vers_texte_brut($description_projet);
// Ensuite entourer d'une div pour avoir une structure HTML
$description_projet_n = '<div>' .  $description_projet_n . '</div>';

// Enfin ajouter le span au premier caractère
$description_projet_n = html_premier_caractere($description_projet_n, 'span', 'rouge');






$name_projet = $mes_projet_parent[0]["name_projet"];
$name_projet_n = html_vers_texte_brut($name_projet);
// Ensuite entourer d'une div pour avoir une structure HTML
$name_projet_n = '<div>' .  $name_projet_n . '</div>';
// Enfin ajouter le span au premier caractère
$name_projet_n = html_premier_caractere($name_projet_n, 'span', 'jaune');



?>
<div class="display_flex">
    <?php

    if ($mes_projet_parent[0]["use_html_project_name"] == 0) {
        echo '<div>' . $name_projet . '</div>';
    } else {

        echo '<div>' . $name_projet_n . '</div>';
    }
    ?>
</div>
 

<div>
    <img src="" alt="" srcset="">
</div>

<div class="description_projet">
    <?php

    if ($mes_projet_parent[0]["use_html_description_projet"] == 0) {
        echo '<div>' . $description_projet . '</div>';
    } else {
        echo '<div>' . $description_projet_n . '</div>';
    }
    ?>
</div>



<style>
        .rouge {
        background-color: green;
        font-size: 2em;
        padding: 2px;
        color: white;
        box-shadow: 1px 1px black;
    }



            .jaune {
        background-color: yellowgreen;
        font-size: 2em;
        padding: 2px;
        color: white;
        box-shadow: 1px 1px black;
    }

 
</style>



<?php
     

 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 
 echo "<br/>" ; 






     var_dump(   $databaseHandler) ; 

// Je veux ma propre requête
$sql = "SELECT * FROM `projet_img` WHERE 1";

// On exécute et on crée une variable globale $mes_projets
$result = $databaseHandler->select_custom_safe($sql, 'mes_images');





var_dump($mes_images) ; 