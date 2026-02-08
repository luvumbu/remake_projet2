 <div id="generatedFileName" class="display_none"></div>



 <style>
     h2 {
         color: #333;
     }



     /* Input file masqué */
     input[type="file"] {
         display: none;
     }

     /* Bouton stylé pour choisir un fichier */
     .label-file {
         padding: 12px 25px;
         font-size: 16px;
         border: none;
         border-radius: 8px;
         cursor: pointer;
         background: linear-gradient(45deg, #ff7f50, #ff6347);
         color: white;
         font-weight: bold;
         transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.3s ease;
     }

     .label-file:hover {
         transform: scale(1.05);
         box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
         background: linear-gradient(45deg, #ff6347, #ff7f50);
     }

     .label-file:active {
         transform: scale(0.98);
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
     }

     /* Bouton Uploader */
     button {
         padding: 12px 25px;
         font-size: 16px;
         border: none;
         border-radius: 8px;
         cursor: pointer;
         background: linear-gradient(45deg, #1e90ff, #00bfff);
         width: 300px;
         padding: 30px;
         color: white;
         font-weight: bold;
         transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.3s ease;
     }

     button:hover {
         transform: scale(1.05);
         box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
         background: linear-gradient(45deg, #00bfff, #1e90ff);
     }

     button:active {
         transform: scale(0.98);
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
     }

     /* Barre de progression */
     #progressContainer {
         width: 100%;
         max-width: 400px;
         background: #eee;
         border-radius: 10px;
         overflow: hidden;
         margin-top: 10px;
         height: 20px;
     }

     #progressBar {
         width: 0;
         height: 100%;
         background: linear-gradient(90deg, #1e90ff, #00bfff);
         transition: width 0.2s ease;
     }

     #progressText {
         margin-top: 5px;
         font-weight: bold;
         color: #333;
     }

     /* Image uploadée */
     #uploadedImageContainer img {
         margin-top: 20px;
         max-width: 400px;
         border-radius: 8px;
         box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
     }
 </style>

 <div class="" id="file_dowload" title="<?= $url ?>">


     <h2>Telechargement de fichier ici</h2>

     <form id="uploadForm">
         <!-- Bouton personnalisé pour choisir un fichier -->
         <label class="label-file" for="fileInput">Choisir un fichier</label>
         <input type="file" id="fileInput" required>
         <button type="submit" class="Uploader">Uploader</button>
     </form>


     <div class="bprogress">
         <div id="progressContainer">
             <div id="progressBar"></div>
         </div>
         <p id="progressText"></p>

         <div id="uploadedImageContainer"></div>
         <div class="file_dowload_src2">
             <img id="file_dowload_src2" style="display:none" alt="" srcset="">
         </div>
     </div>

     <script>
         const CHUNK_SIZE = 10 * 1024 * 1024; // 10 Mo par chunk

         document.getElementById('uploadForm').addEventListener('submit', async (e) => {
             e.preventDefault();

             const file = document.getElementById('fileInput').files[0];
             if (!file) return;

             const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
             const fileName = file.name;

             const uploadedImageContainer = document.getElementById('uploadedImageContainer');
             uploadedImageContainer.innerHTML = ''; // Réinitialise l'affichage

             try {
                 for (let i = 0; i < totalChunks; i++) {
                     const start = i * CHUNK_SIZE;
                     const end = Math.min(start + CHUNK_SIZE, file.size);
                     const chunk = file.slice(start, end);

                     const formData = new FormData();
                     formData.append('file', chunk);
                     formData.append('chunkIndex', i);
                     formData.append('totalChunks', totalChunks);
                     formData.append('fileName', fileName);

                     const res = await fetch('file_dowload/upload_chunk.php', {
                         method: 'POST',
                         body: formData
                     });

                     const data = await res.json();

                     // Mise à jour de la barre de progression
                     const progress = Math.round(((i + 1) / totalChunks) * 100);
                     document.getElementById('progressBar').style.width = progress + '%';
                     document.getElementById('progressText').innerText = `Progression: ${progress}%`;

                 }

                 // ✅ Tout est uploadé, on peut faire le push vers PHP
                 const file_dowload = document.getElementById("file_dowload").title;
                 var ok = new Information("req_on/insert_file.php"); // création de la classe 
                 ok.add("insert_file", fileName); // ajout de l'information pour l'envoi 
                 ok.add("file_dowload", file_dowload); // ajout de l'information pour l'envoi 
                 console.log(ok.info());
                 ok.push(); // envoie l'information au code PHP

                 document.getElementById('progressText').innerText += ' ✅ Upload terminé !';



                 const xhttp = new XMLHttpRequest();
                 xhttp.onload = function() {
                     document.getElementById("generatedFileName").innerHTML =
                         this.responseText;


                     document.getElementById("file_dowload_src").src = "file_dowload/uploads/" + this.responseText;
                     document.getElementById("file_dowload_src2").src = "file_dowload/uploads/" + this.responseText;
                     document.getElementById("file_dowload_src2").className = "file_dowload_src2";
                     document.getElementById("file_dowload_src2").style.display = "block";



        



                 }
                 xhttp.open("GET", "file_dowload/generatedFileName.php");
                 xhttp.send();







                 // Si ce n'est pas une image, affiche le nom du fichier
                 if (!file.type.startsWith("image/")) {
                     uploadedImageContainer.innerHTML = `<p>Fichier uploadé : ${fileName}</p>`;
                 }

             } catch (err) {
                 alert("Erreur d'upload : " + err);
             }
         });
     </script>




     <style>
         .file_dowload {

             width: 50%;
             margin: auto;
         }
         #Uploader{
            width: 300px;
            padding: 15px;
         }
     </style>
 </div>
 

 <?php 

$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Je veux ma propre requête
$sql = "SELECT * FROM `projet_img` WHERE `id_projet_img`='$url'";

// On exécute et on crée une variable globale $mes_projets
$result = $databaseHandler->select_custom_safe($sql, 'mes_images');



?>
 <img src="https://fr.pinterest.com/pin/106960559895129692/" alt="">
<div id="file_dowload">
    <img id="file_dowload_src" src="<?= 'file_dowload/uploads/' . $mes_projet_parent[0]["img_projet"] ?>" alt="" srcset="">
</div>
<div class="all_img" title="<?= $url ?>" id="all_img">
    <?php foreach ($mes_images as $img) { ?>


        <?php

        if ($img['id_projet_img_auto'] == $mes_projet_parent[0]["img_projet"]) {
        ?>

            <script>
                document.getElementById("file_dowload_src").src = "file_dowload/uploads/<?= $img['img_projet_src_img'] ?>";
            </script>

        <?php
        }

        ?>
        <div class="image_block" data-id="<?= $img['id_projet_img_auto'] ?>">
            <img src="file_dowload/uploads/<?= $img['img_projet_src_img'] ?>" alt="" srcset="">

            <div class="buttons">
                <!-- Bouton Supprimer -->
                <button class="delete_btn" title="<?= $img['img_projet_src_img'] ?>" onclick="deleteImage(this)">Supprimer</button>

                <!-- Radio pour sélectionner UNE seule image -->
                <label>
                    <input type="radio" onclick="select_radio(this)" title="<?= $img['id_projet_img_auto'] ?>" name="selected_img" class="select_radio" id="<?= "radio_" . $img['id_projet_img_auto'] ?>" value="<?= $img['img_projet_src_img'] ?>">
                    Sélectionner
                </label>

                <!-- Checkbox pour cocher librement -->
                <label>
                    <input   type="checkbox" onclick="handleCheckboxClick(this)" class="check_btn"  name="check_<?= $img['id_projet_img_auto'] ?>" value="<?= $img['id_projet_img_auto'] ?>">
                    Cocher
                </label>
            </div>
        </div>
    <?php } ?>
</div>

 <style>
    #file_dowload img {
        width: 100%;
    }

        #file_dowload   {
        width: 60%;
        margin: auto;
    }
    .rouge {
        background-color: green;
        font-size: 2em;
        padding: 5px;
        color: white;
    }

 
</style>

 <script>

 
    // -------------------- RADIO (sélection unique) --------------------
    function select_radio(_this) {
     
            // Retire la classe selected de tous les blocs
            document.querySelectorAll('.image_block').forEach(b => b.classList.remove('selected'));          
                const block = _this.closest('.image_block');
                block.classList.add('selected');

                // Console log pour radio sélectionnée
                console.log(_this.title);


                const img_projet = document.getElementById("all_img").title;



                document.getElementById("file_dowload_src").src = "file_dowload/uploads/" + _this.value;




                var ok = new Information("req_on/update_img_projet.php"); // création de la classe



                // Envoi des tableaux complets
                ok.add("img_projet", _this.title); // ex: [1,2,3]
                ok.add("id_projet", img_projet); // ex: [4,5,6]

                console.log(ok.info()); // debug : voir le contenu envoyé
                ok.push(); // 🔥 UN SEUL envoi








         
        
    };
    // -------------------- CHECKBOX (cocher multiple) --------------------
function handleCheckboxClick(clickedCheckbox) {

    const presentIds = [];
    const absentIds  = [];

    document.querySelectorAll('.check_btn').forEach(cb => {

        const id = cb.value; // valeur réelle du checkbox

        if (cb.checked) {
            presentIds.push(id);
        } else {
            absentIds.push(id);
        }
    });

    console.log('🟢 PRÉSENTS (checked) →', presentIds);
    console.log('🔴 ABSENTS  (unchecked) →', absentIds);

    // 🔹 Envoi backend
    var ok = new Information("req_on/id_projet_img_auto.php");
    ok.add("presentIds", presentIds);
    ok.add("absentIds", absentIds);

    console.log('PAYLOAD →', ok.info());
    ok.push();
}

</script>