<?php
error_reporting(E_ERROR | E_PARSE);
class DatabaseHandler
{
    public $servername = "localhost";
    public $username;
    public $password;
    public $dbname;
    public $verif = true;
    public $connection;
    public $tableList = [];

    // Constructeur
    function __construct($dbname, $username, $password, $servername = "localhost")
    {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;




        try {
        // Création de la connexion
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Vérification de la connexion
        if ($this->connection->connect_error) {
            $this->verif = false;
            die("Erreur de connexion à la base de données '$dbname' : " . $this->connection->connect_error);
        
        } else {
            $this->verif = true;
            $this->connection->set_charset("utf8"); // optionnel
        }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}


/*



// Création de l'objet DatabaseHandler
$db = new DatabaseHandler(
    "test", // nom de la base
    "root",               // utilisateur MySQL
    "",                   // mot de passe MySQL
    "localhost"           // serveur (optionnel)
);

// Vérifier si la connexion est OK
if ($db->verif === true) {
    echo "Connexion réussie à la base de données";
} else {
    echo "Échec de la connexion";
}

*/
    }

    // Fermer la connexion
    function closeConnection()
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }

    // Récupérer toutes les tables de la base
    function getAllTables()
    {
        if (!$this->verif) return [];

        $this->tableList = [];
        $sql = "SHOW TABLES";
        $result = $this->connection->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                $this->tableList[] = $row[0];
            }
        }

        return $this->tableList;

        /*
        // Affiche tous le noms des tables
$dbname = "test";
$username = "root";
$password = "";
 
 


// Initialisation du gestionnaire de base de données
$databaseHandler = new DatabaseHandler($dbname, $username, $password);


 $databaseHandler->getAllTables();


var_dump($databaseHandler->getAllTables());

*/
    }


    public function select_custom_safe($sql, $prefixGlobal = "")
{
    if (!$this->verif) return ['success' => false, 'message' => 'Connexion non valide'];

    try {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        $res = $this->connection->query($sql);

        if (!$res) {
            return ['success' => false, 'message' => $this->connection->error];
        }

        $rows = [];
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }

        if ($prefixGlobal !== "") {
            $GLOBALS[$prefixGlobal] = $rows;
        }

        return ['success' => true, 'data' => $rows];

    } catch (mysqli_sql_exception $e) {
        return ['success' => false, 'message' => $e->getMessage()];
    }
    /*
        $dbname = "test";
        $username = "root";
        $password = "";
        $databaseHandler = new DatabaseHandler($dbname, $username, $password);

        // Je veux ma propre requête
        $sql = "SELECT * FROM `utilisateur` WHERE `id_utilisateur`='4'";

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
}







    function getAllDataGrouped()
{
    if (!$this->verif) return [];

    $allData = [];

    // 1️⃣ Récupérer toutes les tables
    $tables = $this->getAllTables();

    // 2️⃣ Boucler sur chaque table
    foreach ($tables as $table) {

        $rows = [];
        $sql = "SELECT * FROM `$table`";
        $result = $this->connection->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }

        // 3️⃣ Regrouper par nom de table
        $allData[$table] = $rows;
    }

    return $allData;
}
// Dans la classe DatabaseHandler




function getTableNames() {
    if (!$this->verif) return [];

    $tables = [];
    $sql = "SHOW TABLES";
    $result = $this->connection->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            $tables[] = $row[0]; // On prend seulement le nom de la table
        }
    }

    return $tables;
}

// Récupérer les colonnes d'une table
function getColumnNames($table) {
    if (!$this->verif) return [];

    $columns = [];
    $sql = "SHOW COLUMNS FROM `$table`";
    $result = $this->connection->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $columns[] = $row['Field']; // 'Field' contient le nom de la colonne
        }
    }

    return $columns;
}

// ---------------------------
// Nouvelle fonction : checkWithQuery
// ---------------------------
public function checkWithQuery($sql, $params = [])
{
    if (!$this->verif) return false;

    $stmt = $this->connection->prepare($sql);
    if (!$stmt) return false;

    if (!empty($params)) {
        // Prépare les types pour bind_param
        $types = '';
        $values = [];
        foreach ($params as $value) {
            $types .= is_int($value) ? 'i' : 's';
            $values[] = $value;
        }

        // bind_param nécessite des variables par référence
        $bind_names[] = $types;
        for ($i = 0; $i < count($values); $i++) {
            $bind_name = 'bind' . $i;
            $$bind_name = $values[$i];
            $bind_names[] = &$$bind_name;
        }

        call_user_func_array([$stmt, 'bind_param'], $bind_names);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}


/**
 * Récupère toutes les tables et leurs colonnes
 * et crée des variables globales pour chaque table.
 *
 * @param string $suffix Suffixe ou préfixe à ajouter au nom de la variable globale (ex: "_" pour $projet_)
 * @param bool $initialize Si true, initialise les variables globales avec les données de la table, sinon avec tableau vide
 * @return array Tableau complet tables => colonnes
 */
 
 


// Récupérer toutes les tables et leurs colonnes dans un seul array
function getTablesAndColumns() {
    if (!$this->verif) return [];

    $tablesAndColumns = [];

    // Récupérer toutes les tables
    $tables = $this->getTables(); // Assure-toi que getTables() renvoie juste les noms des tables

    if ($tables) {
        foreach ($tables as $table) {
            $columns = $this->getColumnNames($table); // Récupère les colonnes de chaque table
            $tablesAndColumns[$table] = $columns;
        }
    }

    return $tablesAndColumns;
}




public function addElement($table, $data)
{
    if (!$this->verif) {
        return ['success' => false, 'message' => 'Connexion invalide', 'id' => null];
    }

    // Vérifie que la table existe
    $tables = $this->getTables();
    if (!in_array($table, $tables)) {
        return ['success' => false, 'message' => "Table '$table' inexistante", 'id' => null];
    }

    // Vérifie que les colonnes existent
    $columns = $this->getColumns($table);
    foreach ($data as $col => $val) {
        if (!in_array($col, $columns)) {
            return ['success' => false, 'message' => "Colonne '$col' inexistante dans '$table'", 'id' => null];
        }
    }

    // Prépare l'INSERT
    $cols = implode("`, `", array_keys($data));
    $vals = implode("', '", array_map([$this->connection, 'real_escape_string'], array_values($data)));

    $sql = "INSERT INTO `$table` (`$cols`) VALUES ('$vals')";

    if ($this->connection->query($sql) === TRUE) {
        return ['success' => true, 'message' => 'Élément ajouté', 'id' => $this->connection->insert_id];
    } else {
        return ['success' => false, 'message' => $this->connection->error, 'id' => null];
    }
}

/**
 * Récupère toutes les tables de la base et leurs colonnes,
 * et fournit un résumé complet avec le nombre de colonnes et d'enregistrements.
 *
 * @param string $suffix Optionnel : suffixe à ajouter au nom de variable globale
 * @return array Tableau multidimensionnel contenant les informations
 */
public function getTablesSummary($suffix = "")
{
    if (!$this->verif) return [];

    $summary = [];
    $tables = $this->getTablesAndColumns(); // récupère tables => colonnes

    foreach ($tables as $tableName => $columns) {
        // Compter les colonnes
        $nombreColonnes = count($columns);

        // Compter les enregistrements dans la table
        $resCount = $this->connection->query("SELECT COUNT(*) AS total FROM `$tableName`");
        $nombreEnregistrements = ($resCount && $resCount->num_rows > 0) 
            ? $resCount->fetch_assoc()['total'] 
            : 0;

        // Remplir le tableau résumé
        $summary[$tableName] = [
            'nom' => $tableName,
            'nombre_colonnes' => $nombreColonnes,
            'colonnes' => $columns,
            'nombre_enregistrements' => $nombreEnregistrements
        ];

        // Crée aussi une variable globale pour accès direct
        $globalVarName = $tableName . $suffix;
        $GLOBALS[$globalVarName] = $columns; // contient uniquement la liste des colonnes
    }

    return $summary;

    /*

    
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Récupérer le résumé de toutes les tables avec un suffixe "_" pour les variables globales
$tablesSummary = $databaseHandler->getTablesSummary("_");

// Afficher le résumé complet
echo "<pre>";
var_dump($tablesSummary);
echo "</pre>";

// Exemple d’accès aux variables globales
// Si tu as une table 'utilisateur', tu peux accéder à ses colonnes via $utilisateur_
echo "<pre>";
if (isset($utilisateur_)) {
    echo "Colonnes de la table 'utilisateur':\n";
    var_dump($utilisateur_);
}

if (isset($projet_)) {
    echo "Colonnes de la table 'projet':\n";
    var_dump($projet_);
}
echo "</pre>";

// Fermer la connexion
$databaseHandler->closeConnection();


*/
}


public function select_custom_safe_to_php($sql, $prefixGlobal = "", $filename = "")
{
    if (!$this->verif) return ['success' => false, 'message' => 'Connexion non valide'];

    try {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        $res = $this->connection->query($sql);

        if (!$res) {
            return ['success' => false, 'message' => $this->connection->error];
        }

        $rows = [];
        while ($row = $res->fetch_assoc()) {
            $rows[] = $row;
        }

        // Crée la variable globale si demandé
        if ($prefixGlobal !== "") {
            $GLOBALS[$prefixGlobal] = $rows;
        }

        // Génère le fichier PHP si filename fourni
        if ($filename !== "") {
            $phpContent = "<?php\n\n\$data = " . var_export($rows, true) . ";\n\n?>";
            file_put_contents($filename, $phpContent);
        }

        return ['success' => true, 'data' => $rows];

    } catch (mysqli_sql_exception $e) {
        return ['success' => false, 'message' => $e->getMessage()];
    }

    /*

    $dbname = "test";
$username = "root";
$password = "";
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Requête personnalisée
$sql = "SELECT * FROM `utilisateur` WHERE 1";

// Exécuter la requête, créer une variable globale $users_, et générer un fichier PHP
$result = $databaseHandler->select_custom_safe_to_php($sql, 'users_', 'users_data.php');

if ($result['success']) {
    echo "Fichier PHP généré et variable globale créée !";
    echo "<pre>";
    var_dump($users_); // Accès direct aux données
    echo "</pre>";
} else {
    echo "Erreur : " . $result['message'];
}


*/
}








 public function insert_safe($table, $data, $uniqueColumn)
{
    if (!$this->verif) {
        return ['success' => false, 'message' => 'Connexion à la base invalide', 'id' => null];
    }

    // 1️⃣ Vérifier si la table existe
    $tables = $this->getTables();
    if (!in_array($table, $tables)) {
        return ['success' => false, 'message' => "La table '$table' n'existe pas.", 'id' => null];
    }

    // 2️⃣ Vérifier que toutes les colonnes de $data existent dans la table
    $columns = $this->getColumns($table);
    foreach ($data as $col => $val) {
        if (!in_array($col, $columns)) {
            return ['success' => false, 'message' => "La colonne '$col' n'existe pas dans la table '$table'.", 'id' => null];
        }
    }

    // 3️⃣ Vérifier si la valeur unique existe déjà
    if (!in_array($uniqueColumn, $columns)) {
        return ['success' => false, 'message' => "La colonne unique '$uniqueColumn' n'existe pas dans '$table'.", 'id' => null];
    }

    $value = $this->connection->real_escape_string($data[$uniqueColumn]);
    $checkSql = "SELECT * FROM `$table` WHERE `$uniqueColumn` = '$value'";
    $res = $this->connection->query($checkSql);
    if ($res && $res->num_rows > 0) {
        return ['success' => false, 'message' => "$uniqueColumn '$value' existe déjà.", 'id' => null];
    }

    // 4️⃣ Préparer et exécuter l'INSERT
    $columnsStr = implode("`, `", array_keys($data));
    $valuesStr  = implode("', '", array_map([$this->connection, 'real_escape_string'], array_values($data)));
    $sql = "INSERT INTO `$table` (`$columnsStr`) VALUES ('$valuesStr')";

    if ($this->connection->query($sql) === TRUE) {
        return ['success' => true, 'message' => 'Enregistrement inséré avec succès.', 'id' => $this->connection->insert_id];
    } else {
        return ['success' => false, 'message' => "Erreur SQL: ".$this->connection->error, 'id' => null];
    }

    /*
    

$dbname = "test";
$username = "root";
$password = "";

$databaseHandler = new DatabaseHandler($dbname, $username, $password);

$user = [
    'nom'   => 'Alicdsdse_paris',
    'email' => 'Exem02gggggple@mail.com' // colonne incorrecte
];

$result = $databaseHandler->insert_safe('utilisateur', $user, 'email');

if ($result['success']) {
    echo "✅ ".$result['message']." (ID ".$result['id'].")";
} else {
    echo "⚠️ ".$result['message'];
}

$databaseHandler->closeConnection();


*/
}




    // Générer toutes les variables dynamiques sous forme de tableaux

/**
 * Insère automatiquement des données d'un fichier PHP dans une table SQL
 * de manière sécurisée et autonome.
 *
 * @param string $host       Nom d'hôte MySQL (ex: 'localhost')
 * @param string $username   Nom d'utilisateur MySQL
 * @param string $password   Mot de passe MySQL
 * @param string $dbname     Nom de la base de données
 * @param string $table      Nom de la table cible
 * @param string $file       Chemin vers le fichier PHP contenant $data
 * @param string $uniqueKey  (optionnel) Nom de la colonne unique pour éviter les doublons
 * @return array             Résumé des insertions
 */
/**
 * Ajoute une ligne dans une table de manière sécurisée et autonome
 * @param string $dbname Nom de la base de données
 * @param string $username Nom d'utilisateur
 * @param string $password Mot de passe
 * @param string $table Nom de la table
 * @param array $data Tableau associatif colonne => valeur
 * @return array Résultat ['success' => bool, 'message' => string, 'id' => int|null]
 */




    // ---------------------
// Méthode pour insérer un enregistrement
// ---------------------
 

public function insert_sql_safe($table, $data, $uniqueColumn = null)
{
    if (!$this->verif) {
        return ['success' => false, 'message' => 'Connexion non valide'];
    }

    if (empty($table) || empty($data)) {
        return ['success' => false, 'message' => 'Table ou données manquantes'];
    }

    try {
        // Connexion
        $this->connection = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );

        // Vérifier que la table existe
        $tables = $this->getTables(); // récupère toutes les tables
        if (!in_array($table, $tables)) {
            return ['success' => false, 'message' => "Table '$table' inexistante"];
        }

        // Vérifier que les colonnes existent
        $columnsInTable = $this->getColumns($table); // récupère toutes les colonnes
        foreach ($data as $col => $val) {
            if (!in_array($col, $columnsInTable)) {
                return ['success' => false, 'message' => "Colonne '$col' inexistante dans '$table'"];
            }
        }

        // Si une colonne unique est définie, vérifier qu'elle n'existe pas déjà
        if ($uniqueColumn && isset($data[$uniqueColumn])) {
            $uniqueVal = $this->connection->real_escape_string($data[$uniqueColumn]);
            $checkSql = "SELECT COUNT(*) AS total FROM `$table` WHERE `$uniqueColumn` = '$uniqueVal'";
            $res = $this->connection->query($checkSql);
            if ($res && $res->fetch_assoc()['total'] > 0) {
                return ['success' => false, 'message' => ucfirst($uniqueColumn) . " déjà présent"];
            }
        }

        // Construire la requête INSERT
        $columns = implode("`, `", array_keys($data));
        $values  = implode("', '", array_map([$this->connection, 'real_escape_string'], array_values($data)));

        $sql = "INSERT INTO `$table` (`$columns`) VALUES ('$values')";

        // Exécution
        $this->connection->query($sql);

        return ['success' => true, 'id' => $this->connection->insert_id];

    } catch (mysqli_sql_exception $e) {
        return [
            'success' => false,
            'message' => 'Erreur base de données : ' . $e->getMessage()
        ];
    }

    /*
$dbname = "test";
$username = "root";
$password = "";
 
 
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Insérer un utilisateur en évitant les doublons d'email
$user = [
    'nom'   => 'Alice',
    'email' => 'alic02e@test.com'
];

$result = $databaseHandler->insert_sql_safe('utilisateur', $user, 'email');

if ($result['success']) {
    echo "Utilisateur ajouté avec ID : " . $result['id'];
} else {
    echo "Impossible d'ajouter l'utilisateur : " . $result['message'];
}

$databaseHandler->closeConnection();

*/
}






    // 🌟 Fonction pour insérer en batch depuis un fichier PHP avec $data existant
    public function insert_safe_direct($table, $filePath) {
        if (!$this->verif) {
            return ['success' => false, 'message' => 'Connexion non valide'];
        }

        if (!file_exists($filePath)) {
            return ['success' => false, 'message' => "Fichier $filePath introuvable"];
        }

        // Inclure le fichier et récupérer la variable $data
        include $filePath;

        if (!isset($data) || !is_array($data)) {
            return ['success' => false, 'message' => "Aucune donnée valide dans $filePath"];
        }

        $countInserted = 0;
        foreach ($data as $row) {
            if (!is_array($row) || empty($row)) continue;

            // Préparer la requête INSERT
            $columns = implode("`, `", array_keys($row));
            $values  = implode("', '", array_map([$this->connection, 'real_escape_string'], array_values($row)));
            $sql = "INSERT INTO `$table` (`$columns`) VALUES ('$values')";

            try {
                $this->connection->query($sql);
                $countInserted++;
            } catch (mysqli_sql_exception $e) {
                // Ignorer les doublons
                if ($e->getCode() === 1062) {
                    continue;
                } else {
                    return ['success' => false, 'message' => $e->getMessage()];
                }
            }
        }

        return [
            'success' => true,
            'inserted' => $countInserted
        ];
    }

 

 
 



public function selectAllTablesSafe($suffix = '')
{
    if (!$this->verif) {
        return ['success' => false, 'message' => 'Connexion non valide'];
    }

    $this->connection = new mysqli(
        $this->servername,
        $this->username,
        $this->password,
        $this->dbname
    );

    if ($this->connection->connect_error) {
        return ['success' => false, 'message' => 'Erreur de connexion'];
    }

    // Récupérer toutes les tables de la base
    $tables = $this->getAllTables(); // suppose que getAllTables() renvoie ['utilisateur','projet',...]
    $allData = [];

    foreach ($tables as $table) {
        $sql = "SELECT * FROM `$table`";
        $result = $this->connection->query($sql);

        if ($result) {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            // Stocker dans un tableau global récapitulatif
            $allData[$table] = $data;

            // Créer une variable globale pour cette table
            $globalVarName = $table . $suffix;
            $GLOBALS[$globalVarName] = $data;
        } else {
            $allData[$table] = [];
            $GLOBALS[$table . $suffix] = [];
        }
    }

    return ['success' => true, 'data' => $allData];
    /*
$dbname = "test";
$username = "root";
$password = "";
 
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Récupère toutes les tables de la base et crée des variables globales pour chacune avec un suffixe "_"
$databaseHandler->selectAllTablesSafe('');

// Maintenant tu peux accéder automatiquement aux variables globales
// par exemple si ta base a "utilisateur" et "projet" :
echo "<pre>";
print_r($utilisateur); // toutes les données de la table utilisateur

echo "</pre>";

// Tu n'as jamais besoin de connaître les noms à l'avance, même si tu ajoutes une table dans la base

*/
}


public function remove_sql_safe($table, $where)
{
    // 🔹 Vérification de la connexion
    if (!$this->verif) {
        return ['success' => false, 'message' => 'Connexion non valide'];
    }

    // 🔹 Vérification des paramètres
    if (empty($table) || empty($where)) {
        return ['success' => false, 'message' => 'Table ou condition WHERE manquante'];
    }

    try {
        // 🔹 Connexion à la base
        $this->connection = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );

        // 🔹 Préparer les conditions WHERE
        $whereClauses = [];
        foreach ($where as $col => $val) {
            $val = $this->connection->real_escape_string($val);
            $whereClauses[] = "`$col` = '$val'";
        }
        $whereString = implode(" AND ", $whereClauses);

        // 🔹 Requête DELETE
        $sql = "DELETE FROM `$table` WHERE $whereString";

        // 🔹 Exécution
        $this->connection->query($sql);

        if ($this->connection->affected_rows > 0) {
            return [
                'success' => true,
                'affected_rows' => $this->connection->affected_rows
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Aucune ligne correspondante à supprimer'
            ];
        }

    } catch (mysqli_sql_exception $e) {

        // 🔴 Colonne inexistante
        if ($e->getCode() === 1054) {
            return [
                'success' => false,
                'message' => 'Colonne inexistante dans la table'
            ];
        }

        // 🔴 Autre erreur SQL
        return [
            'success' => false,
            'message' => 'Erreur base de données : ' . $e->getMessage()
        ];
    }

    /*
    $dbname = "test";
$username = "root";
$password = "";
 
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Supprimer l'utilisateur dont id_utilisateur = 3
$where = ['id_utilisateur' => 2];

$result = $databaseHandler->remove_sql_safe('utilisateur', $where);

if ($result['success']) {
    echo "Suppression réussie, lignes affectées : " . $result['affected_rows'];
} else {
    echo "Impossible de supprimer : " . $result['message'];
}

$databaseHandler->closeConnection();
*/
}



 

function insert_sql($table, $data)
{
    if (!$this->verif) {
        return ['success' => false, 'message' => 'Connexion non valide'];
    }

    if (empty($table) || empty($data)) {
        return ['success' => false, 'message' => 'Table ou données manquantes'];
    }

    try {
        // Connexion
        $this->connection = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );

        // Construction de la requête
        $columns = implode("`, `", array_keys($data));
        $values  = implode("', '", array_map(
            [$this->connection, 'real_escape_string'],
            array_values($data)
        ));

        $sql = "INSERT INTO `$table` (`$columns`) VALUES ('$values')";

        // Exécution
        $this->connection->query($sql);

        return [
            'success' => true,
            'id' => $this->connection->insert_id
        ];

    } catch (mysqli_sql_exception $e) {

        // 🔴 DUPLICATE ENTRY
        if ($e->getCode() === 1062) {

            // Message clair et humain
            if (strpos($e->getMessage(), 'email') !== false) {
                return [
                    'success' => false,
                    'message' => 'Email déjà présent'
                ];
            }

            return [
                'success' => false,
                'message' => 'Donnée déjà existante'
            ];
        }

        // 🔴 Autre erreur SQL
        return [
            'success' => false,
            'message' => 'Erreur base de données'
        ];
    }

            /*


        $dbname = "test";    // ta base
        $username = "root";  // ton utilisateur
        $password = "";      // ton mot de passe

        

        

        $databaseHandler = new DatabaseHandler($dbname, $username, $password);

        // Données à insérer
        $data = [
            'nom_test' =>  rand(5, 15),
        ];

        // Insérer dans la table nom_test
        $insertedId = $databaseHandler->insert_sql('test2', $data);

        if ($insertedId) {
            echo "Enregistrement inséré avec l'ID : $insertedId";
        } else {
            echo "Échec de l'insertion";
        }

        $databaseHandler->closeConnection();




*/

/*
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// 4️⃣ Ajouter des utilisateurs supplémentaires
$users = [
    ['nom' => 'Alice', 'email' => 'alice@test.com'],
    ['nom' => 'Bob', 'email' => 'bob@test.com'],
    ['nom' => 'Charlie', 'email' => 'charlie@test.com'],
    ['nom' => 'Diana', 'email' => 'diana@test.com']
];

foreach ($users as $user) {
    $databaseHandler->insert_sql('utilisateur', $user);
}

// 5️⃣ Ajouter des projets supplémentaires liés aux utilisateurs
$projects = [
    ['id_utilisateur' => 1, 'nom_projet' => 'Projet Alpha', 'description' => 'Description du projet Alpha'],
    ['id_utilisateur' => 1, 'nom_projet' => 'Projet Beta', 'description' => 'Description du projet Beta'],
    ['id_utilisateur' => 2, 'nom_projet' => 'Projet Gamma', 'description' => 'Description du projet Gamma'],
    ['id_utilisateur' => 3, 'nom_projet' => 'Projet Delta', 'description' => 'Description du projet Delta'],
    ['id_utilisateur' => 3, 'nom_projet' => 'Projet Epsilon', 'description' => 'Description du projet Epsilon'],
    ['id_utilisateur' => 4, 'nom_projet' => 'Projet Zeta', 'description' => 'Description du projet Zeta']
];

foreach ($projects as $proj) {
    $databaseHandler->insert_sql('projet', $proj);
}
    */
}





 

public function update_sql_safe($table, $data, $where)
{
    if (!$this->verif) {
        return ['success' => false, 'message' => 'Connexion non valide'];
    }

    if (empty($table) || empty($data) || empty($where)) {
        return ['success' => false, 'message' => 'Table, données ou condition WHERE manquante'];
    }

    try {
        // Connexion
        $this->connection = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );

        // Préparer les paires colonne='valeur'
        $sets = [];
        foreach ($data as $col => $val) {
            $val = $this->connection->real_escape_string($val);
            $sets[] = "`$col` = '$val'";
        }
        $setString = implode(", ", $sets);

        // Construire la clause WHERE
        $whereClauses = [];
        foreach ($where as $col => $val) {
            $val = $this->connection->real_escape_string($val);
            $whereClauses[] = "`$col` = '$val'";
        }
        $whereString = implode(" AND ", $whereClauses);

        // Requête UPDATE
        $sql = "UPDATE `$table` SET $setString WHERE $whereString";

        // Exécution
        $this->connection->query($sql);

        return [
            'success' => true,
            'affected_rows' => $this->connection->affected_rows
        ];

    } catch (mysqli_sql_exception $e) {

        // 🔴 Colonne inexistante ou autre erreur SQL
        if ($e->getCode() === 1054) { // Unknown column
            return [
                'success' => false,
                'message' => 'Colonne inexistante dans la table'
            ];
        }

        // 🔴 Autre erreur SQL
        return [
            'success' => false,
            'message' => 'Erreur base de données : ' . $e->getMessage()
        ];
    }

    /*
$dbname = "test";
$username = "root";
$password = "";
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Mettre à jour le nom du projet dont id_projet = 2
$data = ['nom_projet' => 'Projet Beta Modifié'];
$where = ['id_projet' => 2];

$result = $databaseHandler->update_sql_safe('projet', $data, $where);

if ($result['success']) {
    echo "Mise à jour réussie, lignes affectées : " . $result['affected_rows'];
} else {
    echo "Erreur : " . $result['message'];
}

$databaseHandler->closeConnection();
*/


/*
$dbname = "test";
$username = "root";
$password = "";
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Mettre à jour le nom du projet dont id_projet = 2
 
    $data = [
    'name_projet' => 'Projet Beta Modifié',
    'description_projet' => 'Projet Beta Modifié'
    ];


  
$where = ['id_projet' => $_POST["id_envoyer"]];

$result = $databaseHandler->update_sql_safe('projet', $data, $where);

if ($result['success']) {
    echo "Mise à jour réussie, lignes affectées : " . $result['affected_rows'];
} else {
    echo "Erreur : " . $result['message'];
}

$databaseHandler->closeConnection();


*/
}


public function select_sql($sql)
{
    if (!$this->verif) return false;

    $result = $this->connection->query($sql);

    if (!$result) {
        echo "Erreur SQL : " . $this->connection->error;
        return false;
    }

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    return $rows; // Retourne un tableau de tous les résultats

    /*
    $sql = "SELECT * FROM utilisateur";
$users = $databaseHandler->select_sql($sql);

echo "<pre>";
var_dump($users);
echo "</pre>";

*/
}

 

// ---------------------
// Méthode pour mettre à jour un enregistrement
// ---------------------
// ---------------------
// Méthode pour mettre à jour un enregistrement
// ---------------------
function update_sql($table, $data, $where)
{
    if (!$this->verif) return false;

    if (empty($table) || empty($data) || empty($where)) {
        echo "Table, données ou condition WHERE manquante.";
        return false;
    }

    // Construction de la partie SET de la requête
    $setParts = [];
    foreach ($data as $column => $value) {
        $escapedValue = $this->connection->real_escape_string($value);
        $setParts[] = "`$column` = '$escapedValue'";
    }
    $setString = implode(", ", $setParts);

    $sql = "UPDATE `$table` SET $setString WHERE $where";

    $result = $this->connection->query($sql);

    if ($result) {
        return $this->connection->affected_rows; // Nombre de lignes modifiées
    } else {
        echo "Erreur SQL: " . $this->connection->error;
        return false;
    }


    /*


                $databaseHandler = new DatabaseHandler($dbname, $username, $password);

                // Données à mettre à jour
                $data = [
                    'nom_test' =>'exemple_modifie', // Exemple de valeur modifiée
                ];

                // Condition WHERE pour identifier l'enregistrement
                $where = "id_test = 1"; // Modifier le bon id

                // Mise à jour dans la table test2
                $affectedRows = $databaseHandler->update_sql('test2', $data, $where);

                if ($affectedRows !== false) {
                    echo "Nombre de lignes modifiées : $affectedRows";
                } else {
                    echo "Échec de la mise à jour";
                }

                $databaseHandler->closeConnection();




*/
}



/**
 * Récupère les données de deux tables liées par une clé étrangère
 *
 * @param string $table1 Table principale
 * @param string $table2 Table secondaire
 * @param string $table1Key Clé primaire dans la table principale
 * @param string $table2ForeignKey Clé étrangère dans la table secondaire
 * @param array $columns Colonnes à sélectionner ['t1.col1', 't2.col2']
 * @return array
 */
public function select_join($table1, $table2, $table1Key, $table2ForeignKey, $columns = [])
{
    if (!$this->verif) return false;

    $select = "*";
    if (!empty($columns)) {
        $select = implode(", ", $columns);
    }

    $sql = "SELECT $select
            FROM `$table1` t1
            INNER JOIN `$table2` t2 ON t1.`$table1Key` = t2.`$table2ForeignKey`";

    $result = $this->connection->query($sql);

    if (!$result) {
        die("Erreur SQL : " . $this->connection->error);
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    return $data;


    /*

    <?php
// 🔹 Création d'une instance de la classe DatabaseHandler
//    Cela permet de se connecter à la base de données.
//    $dbname : nom de la base de données
//    $username : utilisateur MySQL
//    $password : mot de passe MySQL
$databaseHandler = new DatabaseHandler($dbname, $username, $password);


// 🔹 Utilisation d'une jointure entre deux tables : utilisateur et projet
//    Ici, on veut récupérer des informations des futilisateurs ET leurs projets associés.
//    On utilise une clé primaire (dans la table principale) et une clé étrangère (dans la table secondaire)
$projects = $databaseHandler->select_join(
    'utilisateur',         // table principale (celle qui contient la clé primaire)
    'projet',              // table secondaire (celle qui contient la clé étrangère)
    'id_utilisateur',      // clé primaire dans la table utilisateur
    'id_utilisateur',      // clé étrangère dans la table projet (qui correspond à id_utilisateur de utilisateur)
    [
        // Colonnes à récupérer
        't1.nom AS nom_utilisateur',   // 't1.nom' : colonne nom de la table principale
                                        // 'AS nom_utilisateur' : on renomme la colonne pour le résultat
        't1.email',                     // colonne email de la table principale
        't2.nom_projet',                // colonne nom_projet de la table secondaire
        't2.description'                // colonne description de la table secondaire
    ]
);

// 🔹 Affichage du résultat pour vérifier ce que contient $projects
//    <pre> permet d'afficher proprement le tableau multidimensionnel
echo "<pre>";
var_dump($projects);
echo "</pre>";



*/
}


    public function join_tables($table1, $table2, $key) {
        if (!$this->verif) return false;

        // Construction de la requête JOIN automatique
        $sql = "
            SELECT $table1.*, $table2.*
            FROM `$table1`
            JOIN `$table2` ON `$table1`.`$key` = `$table2`.`$key`
        ";

        $result = $this->connection->query($sql);

        if (!$result) {
            echo "Erreur SQL: " . $this->connection->error;
            return false;
        }

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;

        /*
        $dbname = "test";
$username = "root";
$password = "";
$databaseHandler = new DatabaseHandler($dbname, $username, $password);
// Utilisateurs → Projets
$projects = $databaseHandler->join_tables('utilisateur', 'projet', 'id_utilisateur');
echo "<pre>";
var_dump($projects);
echo "</pre>";

*/
    }

/**
 * Récupère toutes les tables de la base de données actuelle
 *
 * @return array|false Tableau des noms de tables ou false si aucune table
 */
function getTables() {
    if (!$this->verif) return false;

    $tables = [];
    $sql = "SHOW TABLES";
    $result = $this->connection->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            $tables[] = $row[0];
        }
    } else {
        return false;
    }

    return $tables;
    /*
    $dbname = "test";
$username = "root";
$password = "";
 
// Initialisation du gestionnaire de base de données
$db = new DatabaseHandler($dbname, $username, $password);

// Récupération de toutes les tables de la base
$tables = $db->getTables();

if ($tables) {
    echo "<pre>";
    print_r($tables); // Affiche toutes les tables
    echo "</pre>";
} else {
    echo "Aucune table trouvée ou erreur de connexion.";
}

// Fermeture de la connexion
$db->closeConnection();
 
*/
}


// ---------------------
// Supprimer un ou plusieurs enregistrements d'une table
// ---------------------
function delete_sql($table, $where)
{
    if (!$this->verif) return false;

    if (empty($table) || empty($where)) {
        echo "Table ou condition WHERE manquante.";
        return false;
    }

    $sql = "DELETE FROM `$table` WHERE $where";
    $result = $this->connection->query($sql);

    if ($result) {
        return $this->connection->affected_rows; // Nombre de lignes supprimées
    } else {
        echo "Erreur SQL: " . $this->connection->error;
        return false;
    }

    /*

    $dbname = "test";    // ta base
$username = "root";  // ton utilisateur
$password = "";      // ton mot de passe

 

 
 

$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Condition WHERE pour identifier l'enregistrement à supprimer
$where = "id_test =    2"; // Supprime l'enregistrement avec id_test = 1

// Suppression dans la table test2
$deletedRows = $databaseHandler->delete_sql('test2', $where);

if ($deletedRows !== false) {
    echo "Nombre de lignes supprimées : $deletedRows";
} else {
    echo "Échec de la suppression";
}

$databaseHandler->closeConnection();


*/
}

/**
 * Crée une table dans la base de données
 *
 * @param string $table Nom de la table à créer
 * @param array $columns Tableau associatif avec clé = nom de colonne, valeur = type SQL
 *                       Exemple : ['id' => 'INT AUTO_INCREMENT PRIMARY KEY', 'nom' => 'VARCHAR(100)']
 * @return bool True si création réussie, false sinon
 */
function create_table($table, $columns)
{
    if (!$this->verif) return false;

    if (empty($table) || empty($columns)) {
        echo "Nom de table ou colonnes manquants.";
        return false;
    }

    // Construction de la liste des colonnes
    $cols = [];
    foreach ($columns as $name => $type) {
        $cols[] = "`$name` $type";
    }

    // Création de la requête SQL
    $sql = "CREATE TABLE IF NOT EXISTS `$table` (" . implode(", ", $cols) . ") ENGINE=InnoDB DEFAULT CHARSET=utf8";

    // Exécution de la requête
    $result = $this->connection->query($sql);

    if ($result) {
        return true;
    } else {
        echo "Erreur SQL: " . $this->connection->error;
        return false;
    }

    /*
$dbname = "test";
$username = "root";
$password = "";
 
$db = new DatabaseHandler($dbname, $username, $password);

// Colonnes à créer
$columns = [
    'id_test' => 'INT AUTO_INCREMENT PRIMARY KEY',
    'nom_test' => 'VARCHAR(100)',
    'valeur_test' => 'TEXT',
    'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
];

// Création de la table
$success = $db->create_table('test4', $columns);

if ($success) {
    echo "Table 'test4' créée avec succès !";
} else {
    echo "Échec de la création de la table.";
}

$db->closeConnection();

*/


/*
$dbname = "test";
$username = "root";
$password = "";
 



 
 


 

 

$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// 1️⃣ Création de la table utilisateur
$columnsUser = [
    'id_utilisateur' => 'INT AUTO_INCREMENT PRIMARY KEY',
    'nom' => 'VARCHAR(100)',
    'email' => 'VARCHAR(150) UNIQUE',
    'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
];

$successUser = $databaseHandler->create_table('utilisateur', $columnsUser);
if ($successUser) echo "Table 'utilisateur' créée avec succès !\n";
else echo "Échec de la création de 'utilisateur'.\n";

// 2️⃣ Création de la table projet
$columnsProjet = [
    'id_projet' => 'INT AUTO_INCREMENT PRIMARY KEY',
    'id_utilisateur' => 'INT',
    'nom_projet' => 'VARCHAR(100)',
    'description' => 'TEXT',
    'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
];

$successProjet = $databaseHandler->create_table('projet', $columnsProjet);
if ($successProjet) echo "Table 'projet' créée avec succès !\n";
else echo "Échec de la création de 'projet'.\n";

// 3️⃣ Ajouter la clé étrangère pour relier projet → utilisateur
$successFK = $databaseHandler->addForeignKey(
    "projet",          // Table qui contient la clé étrangère
    "id_utilisateur",  // Colonne clé étrangère
    "utilisateur",     // Table référencée
    "id_utilisateur",  // Colonne référencée
    "CASCADE",         // Si utilisateur supprimé, ses projets aussi
    "CASCADE"          // Si ID utilisateur modifié, mise à jour dans projet
);

if ($successFK) echo "Clé étrangère ajoutée avec succès !\n";
else echo "Échec de l'ajout de la clé étrangère.\n";

$databaseHandler->closeConnection();


*/
}



/**
 * Vérifie si une table existe dans la base de données
 *
 * @param string $tableName Nom de la table à vérifier
 * @return bool true si la table existe, false sinon
 */
function tableExists($tableName)
{
    if (!$this->verif) return false;

    $sql = "SHOW TABLES LIKE '$tableName'";
    $result = $this->connection->query($sql);

    return ($result && $result->num_rows > 0);
}

/**
 * Récupère toutes les données d'une table et crée des variables dynamiques
 * 
 * @param string $tableName Nom de la table à exporter
 * @return array Tableau associatif contenant toutes les données
 */
function exportTable($tableName) {
    if (!$this->verif) {
        return false;
    }

    // Vérifie si la table existe
    $check = $this->connection->query("SHOW TABLES LIKE '$tableName'");
    if ($check->num_rows == 0) {
        die("La table '$tableName' n'existe pas !");
    }

    $result = $this->connection->query("SELECT * FROM `$tableName`");
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Création de variables dynamiques pour chaque colonne
            foreach ($row as $col => $val) {
                if (!isset($$col)) { // pour ne pas écraser les anciennes variables
                    $$col = [];
                }
                $$col[] = $val;
            }
            $data[] = $row;
        }

        // Pour chaque colonne, crée des variables dynamiques globales
        foreach ($row as $col => $val) {
            $GLOBALS[$col] = $$col;
        }
    }

    return $data;

    /*
    $dbname = "test";
$username = "root";
$password = "";

$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Colonnes à créer
$columns = [
    'id_test' => 'INT AUTO_INCREMENT PRIMARY KEY',
    'nom_test' => 'VARCHAR(100)',
    'valeur_test' => 'TEXT',
    'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
];

// Création de la table
$success = $databaseHandler->create_table('test3', $columns);

if ($success) {
    echo "Table 'test3' créée avec succès !";
} else {
    echo "Échec de la création de la table.";
}

$databaseHandler->closeConnection();

*/
}



/**
 * Récupère toutes les colonnes d'une table
 *
 * @param string $table Nom de la table
 * @return array|false Tableau des colonnes ou false si erreur
 */
function getColumns($table) {
    if (!$this->verif) return false; // Vérifie la connexion

    if (empty($table)) {
        echo "Nom de table manquant.";
        return false;
    }

    $columns = [];
    $sql = "SHOW COLUMNS FROM `$table`";
    $result = $this->connection->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $columns[] = $row['Field']; // On prend uniquement le nom des colonnes
        }
    } else {
        return false;
    }

    return $columns;


    /*
$dbname = "test";
$username = "root";
$password = "";
$db = new DatabaseHandler($dbname, $username, $password);
$tableName = "test2"; // Nom de la table dont on veut les colonnes
$columns = $db->getColumns($tableName);

if ($columns) {
    echo "<pre>";
    print_r($columns); // Affiche toutes les colonnes
    echo "</pre>";
} else {
    echo "Aucune colonne trouvée ou erreur.";
}
$db->closeConnection(); 

*/
}


/**
 * Recherche avec LIKE dans une table et limite le nombre de résultats
 *
 * @param string $table Nom de la table
 * @param string $column Nom de la colonne à chercher
 * @param string $value Valeur à chercher
 * @param int $limit Nombre maximum de résultats (par défaut 10)
 * @return array|false Tableau des résultats ou false si erreur
 */
function searchLike($table, $column, $value, $limit = 10) {
    if (!$this->verif) return false;

    if (empty($table) || empty($column) || empty($value)) {
        echo "Table, colonne ou valeur manquante.";
        return false;
    }

    // Échappe les valeurs pour éviter les injections SQL
    $table = $this->connection->real_escape_string($table);
    $column = $this->connection->real_escape_string($column);
    $value = $this->connection->real_escape_string($value);
    $limit = intval($limit);

    $sql = "SELECT * FROM `$table` WHERE `$column` LIKE '%$value%' LIMIT $limit";
    $result = $this->connection->query($sql);

    if ($result && $result->num_rows > 0) {
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    } else {
        return false; // Aucun résultat
    }
}





function searchLikeMultiple($table, $columns, $value, $limit = 10) {
    if (!$this->verif) return false;
    if (empty($columns) || !is_array($columns)) return false;

    $table = $this->connection->real_escape_string($table);
    $value = $this->connection->real_escape_string($value);

    // Construire la condition LIKE pour chaque colonne
    $likeParts = [];
    foreach ($columns as $col) {
        $col = $this->connection->real_escape_string($col);
        $likeParts[] = "`$col` LIKE '%$value%'";
    }
    $where = implode(' OR ', $likeParts);

    $sql = "SELECT * FROM `$table` WHERE $where LIMIT " . intval($limit);
    $result = $this->connection->query($sql);

    $rows = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    return false;
    /*
$dbname = "test";
$username = "root";
$password = "";


$db = new DatabaseHandler($dbname, $username, $password);

// Chercher dans plusieurs colonnes
$columns = ['nom_test2', 'nom_test'];
$results = $db->searchLikeMultiple('test2', $columns, 'ex', 5);

echo '<pre>';
var_dump($results);
echo '</pre>';

$db->closeConnection();

*/
}



/**
 * Crée une relation entre deux tables via clé étrangère
 *
 * @param string $table      La table qui aura la clé étrangère
 * @param string $column     La colonne dans $table qui sera la clé étrangère
 * @param string $refTable   La table référencée
 * @param string $refColumn  La colonne référencée (clé primaire de la table cible)
 * @param string $onDelete   Action lors de la suppression (CASCADE, SET NULL, RESTRICT)
 * @param string $onUpdate   Action lors de la mise à jour (CASCADE, SET NULL, RESTRICT)
 * @return bool              Retourne true si la relation a été créée avec succès
 */
function addForeignKey(
    $table,
    $column,
    $refTable,
    $refColumn,
    $onDelete = 'CASCADE',
    $onUpdate = 'CASCADE'
) {
    if (!$this->verif) return false;

    // Nom UNIQUE de la contrainte
    $constraint = "fk_{$table}_{$column}_{$refTable}_{$refColumn}";

    // Vérifier si la clé étrangère existe déjà
    $checkSql = "
        SELECT CONSTRAINT_NAME
        FROM information_schema.KEY_COLUMN_USAGE
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME = '$table'
          AND CONSTRAINT_NAME = '$constraint'
    ";

    $check = $this->connection->query($checkSql);
    if ($check && $check->num_rows > 0) {
        // Clé déjà existante → on ne fait rien
        return true;
    }

    // Création de la clé étrangère
    $sql = "
        ALTER TABLE `$table`
        ADD CONSTRAINT `$constraint`
        FOREIGN KEY (`$column`)
        REFERENCES `$refTable`(`$refColumn`)
        ON DELETE $onDelete
        ON UPDATE $onUpdate
    ";

    return $this->connection->query($sql);
}



/**
 * Export dynamique d'une table vers un tableau associatif
 * et création de variables globales pour chaque colonne.
 *
 * @param string $tableName Nom de la table à exporter
 * @return array Contenu complet de la table
 */
function exportTable2($tableName) {
    if (!$this->verif) return false;

    // Vérifier si la table existe
    $check = $this->connection->query("SHOW TABLES LIKE '$tableName'");
    if ($check->num_rows == 0) {
        die("La table '$tableName' n'existe pas !");
    }

    $result = $this->connection->query("SELECT * FROM `$tableName`");
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            foreach ($row as $col => $val) {
                if (!isset($$col)) $$col = [];
                $$col[] = $val;
            }
            $data[] = $row;
        }

        // Crée les variables globales dynamiques pour chaque colonne
        foreach ($row as $col => $val) {
            $GLOBALS[$col] = $$col;
        }
    }

    return $data;
}


    function action_sql($sql) {
        if (!$this->verif) return false;

        // Reconnexion (optionnel si déjà connecté)
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->connection->connect_error) {
            die("Erreur de connexion : " . $this->connection->connect_error);
        }

        if ($this->connection->query($sql) === TRUE) {
            // Si c'est un INSERT, on peut renvoyer l'ID inséré
            return $this->connection->insert_id ? $this->connection->insert_id : true;
        } else {
            echo "Erreur SQL : " . $sql . "<br>" . $this->connection->error;
            return false;
        }

        $this->connection->close();
    }



    function countTable($table)
{
    if (!$this->verif) return false;

    $sql = "SELECT COUNT(*) AS total FROM `$table`";
    $result = $this->connection->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        return (int)$row['total'];
    }

    return false;


    /*


$dbname = "test";
$username = "root";
$password = "";

$databaseHandler = new DatabaseHandler($dbname, $username, $password);

$total = $databaseHandler->countTable("test3");

echo "<pre>";
var_dump($total);
echo "</pre>";

$databaseHandler->closeConnection();


*/
}

    function getFirstRow($table, $orderBy)
{
    if (!$this->verif) return false;

    if (empty($table) || empty($orderBy)) {
        return false;
    }

    $sql = "SELECT * FROM `$table` ORDER BY `$orderBy` ASC LIMIT 1";
    $result = $this->connection->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return false;

    /*
    
$dbname = "test";
$username = "root";
$password = "";

  $db = new DatabaseHandler($dbname, $username, $password);

// Table test2 avec une clé primaire nommée id_test
$first = $db->getFirstRow("test2", "id_test");

echo "<pre>";
var_dump($first);
echo "</pre>";

$db->closeConnection();



*/
}
function getLastRow($table, $orderBy)
{
    if (!$this->verif) return false;

    if (empty($table) || empty($orderBy)) {
        return false;
    }

    $sql = "SELECT * FROM `$table` ORDER BY `$orderBy` DESC LIMIT 1";
    $result = $this->connection->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return false;

    /*
    $db = new DatabaseHandler($dbname, $username, $password);

// Dernier enregistrement via id_test
$last = $db->getLastRow("test2", "id_test");

echo "<pre>";
var_dump($last);
echo "</pre>";

$db->closeConnection();


*/
}

function getLastByDate($table, $dateColumn)
{
    if (!$this->verif) return false;

    if (empty($table) || empty($dateColumn)) {
        return false;
    }

    $sql = "SELECT * FROM `$table` ORDER BY `$dateColumn` DESC LIMIT 1";
    $result = $this->connection->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return false;
    /*
    $db = new DatabaseHandler($dbname, $username, $password);

 

// Dernier enregistrement selon la date
$last = $db->getLastByDate("test3", "created_at");

echo "<pre>";
var_dump($last);
echo "</pre>";

$db->closeConnection();


*/
}
function getFirstByDate($table, $dateColumn)
{
    if (!$this->verif) return false;

    if (empty($table) || empty($dateColumn)) {
        return false;
    }

    $sql = "SELECT * FROM `$table` ORDER BY `$dateColumn` ASC LIMIT 1";
    $result = $this->connection->query($sql);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return false;
    /*
    $db = new DatabaseHandler("test", "root", "");

// Enregistrement le plus ancien
$first = $db->getFirstByDate("test2", "created_at");

echo "<pre>";
var_dump($first);
echo "</pre>";

$db->closeConnection();

*/
}
function getFirstByDateAuto($table)
{
    $sql = "SHOW COLUMNS FROM `$table`";
    $res = $this->connection->query($sql);

    if (!$res) return false;

    $dateColumn = null;

    while ($col = $res->fetch_assoc()) {
        if (
            stripos($col['Type'], 'timestamp') !== false ||
            stripos($col['Type'], 'datetime') !== false ||
            stripos($col['Type'], 'date') !== false
        ) {
            $dateColumn = $col['Field'];
            break;
        }
    }

    if (!$dateColumn) return false;

    return $this->getFirstByDate($table, $dateColumn);

    /*
    $db = new DatabaseHandler($dbname, $username, $password);

 

$first = $db->getFirstByDateAuto("test3");

echo "<pre>";
var_dump($first);
echo "</pre>";


*/
}
function getLastAuto($table)
{
    if (!$this->verif) return false;

    /* 1️⃣ Cherche la clé primaire */
    $sql = "SHOW KEYS FROM `$table` WHERE Key_name = 'PRIMARY'";
    $res = $this->connection->query($sql);

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $primaryKey = $row['Column_name'];

        // Dernier par clé primaire
        $sql = "SELECT * FROM `$table` ORDER BY `$primaryKey` DESC LIMIT 1";
        $r = $this->connection->query($sql);

        if ($r && $r->num_rows > 0) {
            return $r->fetch_assoc();
        }
    }

    /* 2️⃣ Sinon : cherche une colonne DATE / DATETIME / TIMESTAMP */
    $sql = "SHOW COLUMNS FROM `$table`";
    $res = $this->connection->query($sql);

    $dateColumn = null;

    while ($col = $res->fetch_assoc()) {
        if (
            stripos($col['Type'], 'timestamp') !== false ||
            stripos($col['Type'], 'datetime') !== false ||
            stripos($col['Type'], 'date') !== false
        ) {
            $dateColumn = $col['Field'];
            break;
        }
    }

    if ($dateColumn) {
        $sql = "SELECT * FROM `$table` ORDER BY `$dateColumn` DESC LIMIT 1";
        $r = $this->connection->query($sql);

        if ($r && $r->num_rows > 0) {
            return $r->fetch_assoc();
        }
    }

    return false;
    /*
    $dbname = "test";
$username = "root";
$password = "";

 

$db = new DatabaseHandler($dbname, $username, $password);

 

 

$last = $db->getLastAuto("test3");

echo "<pre>";
var_dump($last);
echo "</pre>";

$db->closeConnection();


*/
}



function deleteById($table, $idColumn, $idValue)
{
    if (!$this->verif) return false;

    $idValue = (int)$idValue; // sécurité
    $sql = "DELETE FROM `$table` WHERE `$idColumn` = $idValue";

    return $this->action_sql($sql);

    /*
$dbname = "test";
$username = "root";
$password = "";
$db = new DatabaseHandler($dbname, $username, $password);

$db->deleteById("test3", "id_test", 1);
echo "Supprimé";
$db->closeConnection();

*/
}


  

/*


<?php
$dbname = "test";
$username = "root";
$password = "";

// Initialisation du gestionnaire de base de données
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Exemple de DELETE : supprimer l'enregistrement avec id_test = 4
$sql = "DELETE FROM `test2` WHERE `test2`.`id_test` = 4";

// Exécution de la requête
$result = $databaseHandler->action_sql($sql);

if ($result) {
    echo "Enregistrement supprimé avec succès !";
} else {
    echo "Échec de la suppression.";
}

// Fermer la connexion
$databaseHandler->closeConnection();
?>




*/


/*


<?php
$dbname = "test";
$username = "root";
$password = "";

// Initialisation du gestionnaire de base de données
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Exemple de INSERT avec id_test = 4
$sql = "INSERT INTO `test2` (`id_test`, `nom_test`) 
        VALUES (4, 'Exemple')";

// Exécution de la requête
$result = $databaseHandler->action_sql($sql);

 

// Fermer la connexion
$databaseHandler->closeConnection();
 
?>



*/

/*
<?php
$dbname = "test";
$username = "root";
$password = "";

// Initialisation du gestionnaire de base de données
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Exemple de UPDATE pour id_test = 4
$sql = "UPDATE `test2` 
        SET `nom_test` = 'ExempleModifié', `valeur_test` = '456' 
        WHERE `id_test` = 4";

// Exécution de la requête
$result = $databaseHandler->action_sql($sql);

if ($result) {
    echo "Enregistrement mis à jour avec succès !";
} else {
    echo "Échec de la mise à jour.";
}

// Fermer la connexion
$databaseHandler->closeConnection();
?>


*/

/*
$dbname = "test";
$username = "root";
$password = "";



// Instanciation de la classe
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Requête UPDATE pour modifier uniquement 'nom_test'
$databaseHandler->action_sql("
UPDATE `test2`
SET `nom_test` = 'ValeurModifiee'
WHERE `id_test` = 5
");

// Confirmation
echo "Mise à jour effectuée !";

// Fermer la connexion
$databaseHandler->closeConnection();


*/


/*
//005
$dbname   = "test";
$username = "root";
$password = "";

// Connexion
$databaseHandler = new DatabaseHandler($dbname, $username, $password);

// Récupération des tables (array)
$tables = $databaseHandler->getAllTables();

// Nom de la table à vérifier
$tableName = "profil_user";

// Vérification
if (in_array($tableName, $tables, true)) {
    echo "✅ La table '$tableName' existe";
} else {
    echo "❌ La table '$tableName' n'existe pas";
}

// Debug si besoin
// var_dump($tables);

*/
}




?>