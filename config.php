<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
require_once("class.php");


// Csv file header
$Headers = array('Folder_Title','document_path','image_path');

// Csv file name Example : filetest.csv if empty create auto
$Csv_File_Name = '';

// Csv file path
$Csv_File_Path = __DIR__.'/';

// Main folder path *Required* 
$Document_Path =  '';
