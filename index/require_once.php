<?php 
require_once "Class/Element_.php";
require_once "Class/Group_.php";
require_once "Class/GroupManager_.php";
require_once "Class/DatabaseHandler.php";
require_once "Class/Get_anne_2.php";

$filename = 'req_form/dbCheck.php';
$filename_bool = false ; 

if (file_exists($filename)) {
 
require_once $filename;
$filename_bool = true ; 
   
} 
 
?>