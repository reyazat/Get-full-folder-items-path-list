<?php 
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
require_once("class.php");

// If it's true, the output will be CSV else output will be Json
$is_Csv = false;

// Csv file header
$Headers = array('document_path');

// Csv or json file name Example : filetest.csv or filetest.json if empty create auto
$File_Name = '';

// Csv or json file path
$File_Path = dirname(__FILE__).'/';

// Main folder path *Required* 
$Document_Path =  dirname(__FILE__).'/';
