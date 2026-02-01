
<?php
function checkFileExists($filePath) {
    if (file_exists($filePath)) {
        return true; // The file exists
    } else {
        return false; // The file does not exist
    }
}

/*
// Example usage
$path = "path/to/your/file.php";
if (checkFileExists($path)) {
    echo "The file exists.";
} else {
    echo "The file does not exist.";
}
    */


 
 
?>
