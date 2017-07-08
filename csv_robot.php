<?php
require_once("config.php");



$Fetchlistpath = MYFUNC::getFullFilesPatch($Document_Path);

if($is_Csv){
	MYFUNC::createCSV($File_Path,$File_Name,$Headers, $Fetchlistpath);
}else{
	MYFUNC::createJson($File_Path,$File_Name,$Fetchlistpath);
}

echo ('Finish');
exit();

?>
