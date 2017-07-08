<?php
require_once("config.php");

$Fetchlistfile=MYFUNC::getFullDirLising($Document_Path);

$out = array();
	
	foreach($Fetchlistfile as $key=>$rows){
	
		$out[$key][] = $key;
		if(is_array($rows)){
			$img = array();
			$doc = array();
			foreach($rows as $ky){
				if(MYFUNC::isImage($ky)){
					$img[] = $key.'/'.$ky;
				}else{
					$doc[] = $key.'/'.$ky;
				}
			}
		}
		$out[$key][] = implode(' | ' , $doc) ;
		$out[$key][] = implode(' | ' , $img) ;

		
	}

MYFUNC::createCSV($Csv_File_Path,$Csv_File_Name,$Headers, $out);

echo ('Finish');
exit();

?>
