<?php
class MYFUNC{
	
	
	public function __construct($options=null){
	
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
	
	 public function isImage($file_name = "", $options = Array())
    {	$defult = array('.gif', '.jpg', '.jpeg', '.png');
        if (empty($file_name)) {
            return false;
        }
		if(!empty($options)){
			$ext_arr = $this->arrayplus($options,$defult);
		}else{ 
			$ext_arr = $defult;
			}

        $sp = strrpos($file_name, '.');
        $ep = strlen($file_name);
        $ext = substr($file_name, $sp, $ep);
        return in_array(strtolower($ext), $ext_arr) ? true : false;
    }
	public function arrayplus($arr1=array(),$arr2=array()){
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
		$addnum=0;
		foreach ($tables_content as $key=>$row)
		{    
		
			fputcsv($out,$row);
		}

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
