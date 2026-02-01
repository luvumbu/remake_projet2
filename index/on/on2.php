 <div class="projects-overview">
     <div class="project-card active">
         <div class="project-header">
             <h3>Site e-commerce</h3>
             <span class="status">Actif</span>
         </div>

         <p class="project-desc">
             Boutique en ligne avec paiement sécurisé.
         </p>

         <div class="project-meta">
             <span><i class="fa-solid fa-user"></i> Maste</span>
             <span><i class="fa-solid fa-calendar"></i> 12/01/2026</span>
         </div>
     </div>

     <?php
        /*
 SELECT *
FROM projet p
LEFT JOIN style s ON p.id_projet = s.id_projet_style
LEFT JOIN projet_img pi ON p.id_projet = pi.id_projet_img
WHERE p.id_user_projet = 1;


*/

echo "ok/on2_ajax.php" ;
 /*
        $databaseHandler = new DatabaseHandler($dbname, $username, $password);

        // Je veux ma propre requête
        $sql = " SELECT *
                FROM projet p
                LEFT JOIN style s ON p.id_projet = s.id_projet_style
                LEFT JOIN projet_img pi ON p.id_projet = pi.id_projet_img
                WHERE p.id_user_projet = 1;";

        // On exécute et on crée une variable globale $mes_projets
        $result = $databaseHandler->select_custom_safe($sql, 'mes_projets');

        if ($result['success']) {
            echo "<pre>";
            var_dump($mes_projets); // accès direct via la variable globale
            echo "</pre>";
        } else {
            echo "Erreur : " . $result['message'];
        }

        */

echo "ok/on2_ajax.php" ;





echo "<div id='on2_ajax'></div>"




/*
// Connexion
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

 
$projectData = [
    'id_user_projet' =>  1,
    'img_projet_src_img' => '123456789' 
];

$resultProjet = $databaseHandler->insert_safe('projet_img', $projectData, 'id_projet');

*/
        ?>


 </div>

 <style>
     .projects-overview {
         display: grid;
         grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
         gap: 20px;
         padding: 20px;
     }

     /* ===== CARTE ===== */
     .project-card {
         background: #0f172a;
         border-radius: 16px;
         padding: 18px;
         box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
         color: #e5e7eb;
         transition: transform 0.2s ease, box-shadow 0.2s ease;
         cursor: pointer;
     }

     .project-card:hover {
         transform: translateY(-6px);
         box-shadow: 0 15px 40px rgba(0, 0, 0, 0.45);
     }

     /* ===== HEADER ===== */
     .project-header {
         display: flex;
         justify-content: space-between;
         align-items: center;
         margin-bottom: 10px;
     }

     .project-header h3 {
         font-size: 17px;
         margin: 0;
     }

     /* ===== STATUS ===== */
     .status {
         font-size: 12px;
         padding: 4px 10px;
         border-radius: 999px;
         font-weight: bold;
     }

     /* ===== DESCRIPTION ===== */
     .project-desc {
         font-size: 14px;
         color: #cbd5f5;
         margin: 10px 0 14px;
         line-height: 1.4;
     }

     /* ===== META ===== */
     .project-meta {
         display: flex;
         justify-content: space-between;
         font-size: 13px;
         color: #94a3b8;
     }

     .project-meta i {
         margin-right: 6px;
     }

     /* ===== COULEURS PAR ETAT ===== */
     .project-card.active .status {
         background: #22c55e;
         color: #052e16;
     }

     .project-card.paused .status {
         background: #facc15;
         color: #422006;
     }

     .project-card.done .status {
         background: #38bdf8;
         color: #082f49;
     }
 </style>


<script>
      const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
    document.getElementById("on2_ajax").innerHTML =
    this.responseText;
  }
  xhttp.open("GET", "on/on2_ajax.php");
  xhttp.send();
</script>