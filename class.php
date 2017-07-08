<?php
class MYFUNC{
	
	
	public function __construct($options=null){
	
	}
	
	public function getFullFilesPatch($base='', &$data=array()) {
  
	  $array = array_diff(scandir($base), array('.', '..')); # remove ' and .. from the array */

	  foreach($array as $value) : /* loop through the array at the level of the supplied $base */

		if (is_dir($base.$value)) : /* if this is a directory */
		  //$data[] = $base.$value.'/'; /* add it to the $data array */
		  $data = self::getFullFilesPatch($base.$value.'/', $data); /* then make a recursive call with the 
		  current $value as the $base supplying the $data array to carry into the recursion */

		elseif (is_file($base.$value)) : /* else if the current $value is a file */
		  $data[] = $base.$value; /* just add the current $value to the $data array */

		endif;

	  endforeach;

	  return $data; // return the $data array

	}
	
	public function getFullDirLising($dir = null){
        $listDir = array();
        if (!isset($dir)) return $listDir;

        if ($handler = opendir($dir)) {
            while (($sub = readdir($handler)) !== FALSE) {
                if ($sub != "." && $sub != ".." && $sub != "Thumb.db" && $sub != "Thumbs.db") {
                    if (is_file($dir . "/" . $sub)) {
                        $listDir[] = $sub;
                    } elseif (is_dir($dir . "/" . $sub)) {
                        $listDir[$sub] = self::getFullDirLising($dir . "/" . $sub);
                    }
                }
            }
            closedir($handler);
        }

        return $listDir;
    }
	
	 private function isImage($file_name = "", $options = Array())
    {	$defult = array('.gif', '.jpg', '.jpeg', '.png');
        if (empty($file_name)) {
            return false;
        }
		if(!empty($options)){
			$ext_arr = self::arrayplus($options,$defult);
		}else{ 
			$ext_arr = $defult;
			}

        $sp = strrpos($file_name, '.');
        $ep = strlen($file_name);
        $ext = substr($file_name, $sp, $ep);
        return in_array(strtolower($ext), $ext_arr) ? true : false;
    }
	private function arrayplus($arr1=array(),$arr2=array()){
		$out = array();
		$arr1=array_filter($arr1);
		$arr2=array_filter($arr2);
		if(!empty($arr1) && !empty($arr2))$out = array_merge($arr1, $arr2);
		else if(empty($arr1) && !empty($arr2))$out = $arr2;
		else if(!empty($arr1) && empty($arr2))$out = $arr1;
		$out = array_unique($out);
		return $out;
	}
		
	public function createCSV($patch,$fileName,$thparams,$tables_content){
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream'); 
		header('Content-Disposition: attachment; filename=file.csv');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		
		 $sp = strrpos($fileName, '.');
		 if(!empty($fileName) && $sp){
			$ep = strlen($fileName);
			$ext = substr($fileName, $sp, $ep);
			$ext = strtolower($ext) ;
			if(!in_array($ext, array('.csv'))){
				$fileName = date('YmdHis').'.csv'; 
			}
		 }else{
			$fileName = date('YmdHis').'.csv'; 
		 }
		$out = fopen($patch.$fileName, 'w');

		fputcsv($out,$thparams);
		foreach ($tables_content as $key=>$row)
		{    
		
			fputcsv($out,array($row));
		}

		fclose($out);
	  }
	
	public function createJson($patch,$fileName,$content){
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream'); 
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		
		 $sp = strrpos($fileName, '.');
		 if(!empty($fileName) && $sp){
			$ep = strlen($fileName);
			$ext = substr($fileName, $sp, $ep);
			$ext = strtolower($ext) ;
			if(!in_array($ext, array('.json'))){
				$fileName = date('YmdHis').'.json'; 
			}
		 }else{
			$fileName = date('YmdHis').'.json'; 
		 }
		
		$out = fopen($patch.$fileName, 'w');
		fwrite($out, json_encode($content));	
		fclose($out);

	}
	
}

	function replaceSpecial($str){
		$chunked = str_split($str,1);
		$str = ""; 
			foreach($chunked as $chunk){
				$num = ord($chunk);
				if ($num >= 32 && $num <= 123){
						$str.=$chunk;
				}
			}   
		$str = trim($str);
		return addslashes($str);
	} 
	function pre($v = NULL)
	{
		pr($v);exit;
	}
	function pr($v = NULL)
	{
		$v = isset($v) ? $v : "";
		if ($v) {
			echo "<pre>";
			print_r($v);
			echo "</pre>";
		}
	}
?>
