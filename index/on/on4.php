  <?php
    $databaseHandler = new DatabaseHandler($dbname, $username, $password);
    // Je veux ma propre requête
    $sql = "SELECT * FROM `projet` WHERE 1";
    // On exécute et on crée une variable globale $mes_projets
    $result = $databaseHandler->select_custom_safe($sql, 'mes_projets');
    if ($result['success']) {
        echo "<pre>";
        //  var_dump($mes_projets); // accès direct via la variable globale
        echo "</pre>";
    } else {
        echo "Erreur : " . $result['message'];
    }
    ?>
  <div class="archives">
      <?php
        for ($i = 0; $i < count($mes_projets); $i++) {
            // Date cible (format accepté par strtotime)
            $objectif = $mes_projets[$i]["date_inscription_projet"];
            $name_projet = $mes_projets[$i]["name_projet"];
            $description_projet = $mes_projets[$i]["description_projet"];
            $id_projet = $mes_projets[$i]["id_projet"];
        ?>

          <div class="archives-list" id="<?= $id_projet  ?>">

              <div class="archive-card">
                  <div class="archive-header">
                      <p class="id_projet"><?= $mes_projets[$i]["id_projet"] ?> </p>
                      <h3><?= $name_projet ?> </h3>
                      <span class="archive-date">Archivé le <?php echo date("H:i:s d/m/Y", strtotime($objectif)); ?></span>
                  </div>
                  <div class="projet_img">
                      <img src="https://i.pinimg.com/736x/81/ed/aa/81edaa6f641088a97bb4b7fe23c0c9b7.jpg" alt="" srcset="">
                  </div>

                  <div class="archive-actions">
                      <button class="btn view" onclick="consulter(this)" title="<?= $id_projet  ?>">
                          <i class="fa-solid fa-eye"></i> Consulter
                      </button>

                      <button class="btn delete" onclick="remove_projet(this)" title="<?= $id_projet  ?>">
                          <i class="fa-solid fa-trash"></i>
                      </button>
                  </div>
                  <p class="archive-desc">
                      <?= $description_projet ?>
                  </p>

              </div>
          </div>
      <?php
        }
        ?>
  </div>
  <style>
      .projet_img {
          width: 100%;
          height: 150px;
          overflow: hidden;
          /* coupe ce qui dépasse */
      }

      .projet_img img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          /* remplit sans déformer */
          display: block;
          border-radius: 8px;
      }

      .id_projet {
          color: rgba(245, 245, 245, 0.84);
          background-color: rgba(0, 0, 0, 0.35);
          padding: 10px;
          margin: 25px;
          transition: 1s all;



          top: 0;
          position: relative;
          text-align: center;

          box-shadow: 1px 1px rgba(240, 120, 120, 0.35);
      }

      .id_projet:hover {
          transition: 1s all;
          box-shadow: 1px 1px rgba(240, 11, 11, 0.35);

      }

      .archives-list {
          margin-bottom: 40px;
      }

      .archives h2 {
          display: flex;
          align-items: center;
          gap: 10px;
          font-size: 22px;
          margin-bottom: 20px;
      }

      /* ===== LISTE ===== */
      .archives-list {
          display: flex;
          flex-direction: column;
          gap: 18px;
      }

      /* ===== CARTE ARCHIVE ===== */
      .archive-card {
          background: #0f172a;
          border-radius: 16px;
          padding: 20px;
          box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
      }

      .archive-card {
          max-width: 500px;
          /* largeur max */
          max-height: 500px;
          /* hauteur max */
          width: 100%;
          /* prend toute la largeur disponible jusqu'à 500px */
          height: 100%;
          /* s'adapte à max-height */
          overflow: hidden;
          /* tout ce qui dépasse sera caché */
          box-sizing: border-box;
          /* inclut padding et border dans la taille max */
      }

      /* ===== HEADER ===== */
      .archive-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
      }

      .archive-header h3 {
          margin: 0;
          font-size: 17px;
      }

      .archive-date {
          font-size: 12px;
          color: #94a3b8;
      }

      /* ===== DESC ===== */
      .archive-desc {
          margin: 10px 0 16px;
          font-size: 14px;
          color: #cbd5f5;
      }

      /* ===== ACTIONS ===== */
      .archive-actions {
          display: flex;
          gap: 10px;
          flex-wrap: wrap;
      }

      /* ===== BOUTONS ===== */
      .btn {
          border: none;
          padding: 8px 14px;
          border-radius: 10px;
          font-size: 13px;
          cursor: pointer;
          display: flex;
          align-items: center;
          gap: 6px;
      }

      /* RESTAURER */
      .btn.restore {
          background: #22c55e;
          color: #052e16;
      }

      /* CONSULTER */
      .btn.view {
          background: #38bdf8;
          color: #082f49;
      }

      /* SUPPRIMER */
      .btn.delete {
          background: #ef4444;
          color: #fff;
      }

      /* HOVER */
      .btn:hover {
          opacity: 0.85;
      }



      .archives {
          display: flex;
          justify-content: space-around;

          width: 100%;
          flex-wrap: wrap;
      }

      h3 {
          font-size: 2em;
          color: white;
          max-width: 100px;
          /* largeur maximale */
          position: relative;
          white-space: nowrap;
          /* empêche le texte de passer à la ligne */
          overflow: hidden;
          /* cache le texte qui dépasse */
          text-overflow: ellipsis;
          /* ajoute "..." si le texte est trop long */
      }
      .archive-actions{
        margin-top: 50px;
        margin-bottom: 20px;

      }
  </style>

  <script>
      function remove_projet(_this) {

          document.getElementById(_this.title).style.display = "none";
          _this.style.display = "none";
          var ok = new Information("../info_exe/remove_projet.php"); // création de la classe 

          ok.add("remove_projet", _this.title); // ajout d'une deuxieme information denvoi
          console.log(ok.info()); // demande l'information dans le tableau
          ok.push(); // envoie l'information au code pkp 
      }


      function consulter(_this) {
          window.location.href = _this.title;
      }
  </script>

 