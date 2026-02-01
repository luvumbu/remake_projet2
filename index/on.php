<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<?php
//var_dump( $_SESSION["info_index"]) ; 
require_once "Class/Js.php";
require_once "on/on1.php";
require_once "on/on2.php" ;
  
require_once "on/all_projet_sql.php" ;
require_once "on/all_projet.php" ;
?>
<script>
    function session_destroy() {
        var ok = new Information("req_on/session_destroy.php"); // création de la classe 
        console.log(ok.info()); // demande l'information dans le tableau
        ok.push(); // envoie l'information au code pkp 
        const myTimeout = setTimeout(xx, 250);

        function xx() {
            location.reload();
        }
    }
</script>
<div id="on"></div>
<script>
    function add_element(_this) {
        $id_div ="";
        _this.style.display = "none";
        var ok = new Information("../req_on/insert_projet.php"); // création de la classe 
        console.log(ok.info()); // demande l'information dans le tableau
        ok.push(); // envoie l'information au code pkp  
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById("on").innerHTML =
                this.responseText;
                 $id_div =      this.responseText;
        }
        xhttp.open("GET", "index/on/on33.php");
        xhttp.send();
        const myTimeout = setTimeout(add, 250);
        function add() {
        window.location.href = $id_div;
/*
            _this.style.display = "block";
            var dor = document.getElementById("on") ; 
document.getElementById("id_envoyer").value=dor.innerHTML ; 
document.getElementById("main_container").style.display="block";
  */      



}
    }
</script>

<style>
    #on{
        display: none;
    }
</style>