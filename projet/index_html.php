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
                'name_projet'      => $row['name_projet'],
                'description_projet' => $row['description_projet'],
                'price'     => $row['price'],
                'parent_projet'    => $row['parent_projet'],

                'user' => [
                    'id_user'     => $row['id_user'],
                    'nom_user'    => $row['nom_user'],
                    'prenom_user' => $row['prenom_user'],
                    'email_user'  => $row['email_user'],
                ],

                'style' => [
                    'id_style'   => $row['id_style'],
                    'name_style' => $row['name_style'],
                ],

                'params' => [
                    'param_visibilite'     => $row['param_visibilite'],
                    'param_qr'     => $row['param_qr'],
                    'param_prix'        => $row['param_prix'],
                    'param_title'       => $row['param_title'],
                    'param_description' => $row['param_description'],
                ],

                'image_principale' => $row['main_img_id'] ? [
                    'main_img_id'  => $row['main_img_id'],
                    'main_img_src' => $row['main_img_src'],
                    'main_img_ext' => $row['main_img_ext'],
                ] : null,

                'images' => []
            ];
        }

        // ============================
        // AJOUT IMAGE GALERIE
        // ============================
        if (!empty($row['galerie_img_id'])) {
            $projets[$idProjet]['images'][$row['galerie_img_id']] = [
                'galerie_img_id'         => $row['galerie_img_id'],
                'galerie_img_src'        => $row['galerie_img_src'],
                'galerie_img_ext'        => $row['galerie_img_ext'],
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
 

 





?>




<?php 
/*
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
 
*/







 
$name_projet               = [];
$name_projet_span_1        = [];
$name_projet_span_2        = [];

$description_projet        = [];
$description_projet_span_1 = [];
$description_projet_span_2 = [];

for ($i = 0; $i < count($xx); $i++) {

    /* ===============================
       NAME PROJET
    =============================== */

    // valeur brute
    $name_brut = html_vers_texte_brut($xx[$i]["name_projet"]);

    // structure HTML
    $name_html = '<div>' . $name_brut . '</div>';

    // span premier caractère
    $name_html_span = html_premier_caractere($name_html, 'span', 'colors_title');

    // stockage
    $name_projet[]        = $name_html;
    $name_projet_span_1[] = $name_brut;
    $name_projet_span_2[] = $name_html_span;


    /* ===============================
       DESCRIPTION PROJET
    =============================== */

    $desc_brut = html_vers_texte_brut($xx[$i]["description_projet"]);

    $desc_html = '<div>' . $desc_brut . '</div>';

    $desc_html_span = html_premier_caractere($desc_html, 'span', 'colors_description');

    $description_projet[]        = $desc_html;
    $description_projet_span_1[] = $desc_brut;
    $description_projet_span_2[] = $desc_html_span;
}





echo '<div class="elements">' ; 
for ($i=0; $i <count($name_projet) ; $i++) { 


if($mes_projet_parent[$i]["name_projet"]!=""){
    echo '<a href="#x'.$xx[$i]["id_projet"] .'">  <div>'.$name_projet_span_2[$i].'</div></a>' ; 

}
 }

?>


  <input type="text" id="searchInput" placeholder="Rechercher un article...">
 
<?php 
 echo '</div>' ;
?>

 <div style="margin-top: 100px;"></div>
<style>
    .articles{
        margin-top: 350px;
    }
  body {
    font-family: Arial, sans-serif;
 
    padding: 20px;
  }

  h1 {
    text-align: center;
    color: #0001ad;
    margin-bottom: 20px;
  }

  .search-bar {
    display: flex;
    justify-content: center;
    margin-bottom: 30px;
  }

  .search-bar input {
    width: 300px;
    padding: 10px;
    font-size: 16px;
    border: 2px solid #0001ad;
    border-radius: 5px;
    outline: none;
  }

  .articles {
    max-width:80%;
    margin: auto;
  }

  .article {
    background: white;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: all 0.2s ease;
  }

  .hidden {
    display: none;
  }
</style>
 



 

<div class="articles">
<?php 


for ($i=0; $i <count($name_projet) ; $i++) { 





if($xx[$i]["name_projet"]!=""){
echo '<div id="x'.$xx[$i]["id_projet"].'" class="article titre">'.$name_projet[$i].'</div>';

}
 


if($xx[$i]['image_principale']['main_img_src']!=""){


?>

<div class="zoom-wrapper">
    <img
        src="<?= 'file_dowload/uploads/' . $xx[$i]['image_principale']['main_img_src'] ?>"
        alt=""
    >
</div>
<?php 
    
}


if($xx[$i]["description_projet"]!=""){
echo '<div class="article ar_c">'.$description_projet[$i].'</div>';

}
}
?>

 


 <a href="../">
     <div class="article ar_c"><img width="60" height="60" src="https://img.icons8.com/doodle-line/60/home.png" alt="home"/></div>
 </a>
</div>
<script>
const input = document.getElementById('searchInput');
const articles = document.querySelectorAll('.article');

input.addEventListener('input', () => {
  const filter = input.value.toLowerCase();

  articles.forEach(article => {
    const text = article.textContent.toLowerCase();
    article.classList.toggle('hidden', !text.includes(filter));
  });
});
</script>

<style>
    .ar_c{
        text-align: justify;
    }
.titre{
   
    border-radius: 0;
     
    text-align: center;
    font-size: 2em;
    color: rgba(240, 0, 45, 0.90);
}
.colors_title{
 
        background-color: rgb(24, 68, 24);
        padding: 10px;
        margin: 0;
}

    .colors_description{
        color: greenyellow;
    }

    .elements{
        display: flex;
        justify-content: space-around;
        background-color: black;
        color: white;
     
    }
    .elements div div {
        padding: 15px;
    }


      .elements div div {
       color: white;
       background-color: rgba(225, 225, 240, 0.61);
       cursor: pointer;
    }
    body{
        margin: 0;
        padding: 0;
    }
</style>

 <style>
    /* ==============================
   ZOOM WRAPPER
============================== */
.zoom-wrapper {
    position: relative;
    width: 50%;            /* largeur contrôlée */
    height: 460px;           /* hauteur contrôlée */
    overflow: hidden;
 margin: auto;

    background: #0b0f1a;
    box-shadow:
        0 0 0 1px rgba(255,255,255,0.05),
        0 15px 40px rgba(0,0,0,0.8),
        inset 0 0 40px rgba(0,255,255,0.04);

    cursor: zoom-in;
    margin-top: 100px;
    margin-bottom: 100px;

}

/* ==============================
   IMAGE
============================== */
.zoom-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;

    transition:
        transform 0.6s cubic-bezier(.25,.8,.25,1),
        filter 0.4s ease;

    transform-origin: center;
}

/* ==============================
   ZOOM LOCALISÉ (ZONE CENTRALE)
============================== */
 

/* ==============================
   OVERLAY FUTURISTE
============================== */
.zoom-wrapper::after {
    content: '';
    position: absolute;
    inset: 0;
    pointer-events: none;

    background:
        radial-gradient(
            circle at center,
            rgba(0,255,255,0.15) 0%,
            rgba(0,0,0,0.75) 70%
        );

    opacity: 0;
    transition: opacity 0.4s ease;
}

.zoom-wrapper:hover::after {
    opacity: 1;
}

/* ==============================
   CADRE LUMINEUX
============================== */
.zoom-wrapper::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 14px;

    border: 1px solid rgba(0,255,255,0.25);
    box-shadow:
        0 0 12px rgba(0,255,255,0.3),
        inset 0 0 12px rgba(0,255,255,0.15);

    opacity: 0;
    transition: opacity 0.4s ease;
}

.zoom-wrapper:hover::before {
    opacity: 1;
}

a {
    text-decoration: none;
    color: white;
}
</style>