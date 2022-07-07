<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Commonhelper {

	function AssociativeArrayToStr($array, $key_to_concat, $sep) {
		$i = 0;
		$string = "";
		foreach ($array as $key => $values) {
			foreach ($values as $k => $v) {
				if($k == $key_to_concat) {
					if($i == 0)
						$string = $v;
					else
						$string .= $sep .$v;
					$i++;
				}
			}
		}
		return $string;
	}

	function tj_array_column($assoc_array, $column){
		$i = 0;
		$return_array = array();
		if (is_array($assoc_array)) {
			foreach ($assoc_array as $array) {
				$return_array[$i] = $array[$column];
				$i++;
			}
		}
		return $return_array;
	}

	function getCreateCommonFields($user, $tenantid) {
		$now = date("Y-m-d h:i:s");
		if(isset($user) && $user != '') {
			$array['createdby_user'] = $user;
			$array['modifiedby_user'] = $user;
		}
		$array['created_date'] = $now;
		$array['modified_date'] = $now;
		if(isset($tenantid) && $tenantid != '') {
			$array['tenant_id'] = $tenantid;
		}
		$array['is_deleted'] = -1;
		return $array;
	}

	function getModifiedCommonFields($user) {
		$now = date("Y-m-d h:i:s");
		$array['modifiedby_user'] = $user;
		$array['modified_date'] = $now;
		return $array;
	}

	function myUrlDecode($string) {
		$entities =     array('!26','!26', '!2A', '!27', '!28', '!29', '!3B', '!3A', '!40', '!3D', '!2B', '!24', '!2C', '!2F', '!3F', '!25', '!23', '!5B', '!5D', '!6A', '!6B');
		$replacements = array("&amp;",'&', '*',   "'",   "(",   ")",   ";",   ":",   "@",    "=",   "+",   "$",   ",",   "/",   "?",   "%",   "#",   "[",   "]",   ' '  , '.' );
		return str_replace($entities, $replacements, $string);
	}

	function myUrlEncode($string) {
		$replacements =  array('!26', '!26', '!2A', '!27', '!28', '!29', '!3B', '!3A', '!40', '!3D', '!2B', '!24', '!2C', '!2F', '!3F', '!25', '!23', '!5B', '!5D', '!6A', '!6B');
		$entities     =  array('&amp; ','&',   '*',   "'",   "(",   ")",   ";",   ":",   "@",    "=",   "+",   "$",   ",",   "/",   "?",   "%",   "#",   "[",   "]",   ' '  , '.' );
		return str_replace($entities, $replacements, $string);
	}

	function print_array($array){
		echo "<pre>";
		print_r($array);
		exit;
	}

	function getResultArray($Q){
		$data=array();
		if($Q->num_rows()>0){
			foreach($Q->result_array() as $row){
				$data[]=$row;
			}
		}
		return $data;
	}

	function getResultArraySimpleArray($Q){
		$data=array();
		if($Q->num_rows()>0){
			foreach($Q->result_array() as $row){
				foreach($row as $k => $v) $data[]=$v;
			}
		}
		return $data;
	}

	function getCurrentDate(){
		$now = date("Y-m-d h:i:s");
		return $now;
	}

	function getMonthsDD(){
		$month_array=array(
				'0'=>"Month",
				'1'=>"January",
				'2'=>"February",
				'3'=>"March",
				'4'=>"April",
				'5'=>"May",
				'6'=>"June",
				'7'=>"July",
				'8'=>"August",
				'9'=>"September",
				'10'=>"October",
				'11'=>"November",
				'12'=>"December");
		return $month_array;
	}

	function getMonthsSmall(){
		$month_array=array(
				'6'=>"Jun",
				'7'=>"Jul",
				'8'=>"Aug",
				'9'=>"Sep",
				'10'=>"Oct",
				'11'=>"Nov",
				'12'=>"Dec",
				'1'=>"Jan",
				'2'=>"Feb",
				'3'=>"Mar",
				'4'=>"Apr",
				'5'=>"May",);
		return $month_array;
	}


	/*
		|--------------------------------------------------------------------------
		| Following Functions Created By Paperplane @rv!nd
		|--------------------------------------------------------------------------
	*/

	function findKey($array, $keySearch) {
		foreach ($array as $key => $item) {
			if ($key == $keySearch) {
				return 1;
			} else {
				if (isset($array[$key]))
					findKey($array[$key], $keySearch);
			}
		}
		return 0;
	}

	function filter_unique_array($arrs, $id) {
	    foreach($arrs as $k => $v) 
	    {
	        foreach($arrs as $key => $value) 
	        {
	            if($k != $key && $v[$id] == $value[$id])
	            {
	                unset($arrs[$k]);
	            }
	        }
	    }
	    return $arrs;
	}


	/*END OF @rv!nd*/

	function copyImage($imageSrc, $imageDest) {
		$src = urldecode($imageSrc);
		$len1 = strlen($src);
		$len2 = strlen(base_url());
		$fpath = substr($src, $len2 - 1, $len1);
		$pathParts = explode('/', $src);
		$oldFileName = $pathParts[count($pathParts) - 1];
		$ext = explode('.',$oldFileName);
		$newFileName = generateRandomCode().'.'.$ext[1];
		$srcCopy = $_SERVER['DOCUMENT_ROOT'].$fpath;
		$destCopy = $_SERVER['DOCUMENT_ROOT'].$imageDest.$newFileName;
		
		$copy = copy($srcCopy, $destCopy);
		unlink($srcCopy);
		if($copy == false) {
			return false;
		}
		return $newFileName;
	}

	function generateRandomCode() {
		$d=date ("d");
		$m=date ("m");
		$y=date ("Y");
		$t=time();
		$dmt=$d+$m+$y+$t;
		$ran= rand(0,10000000);
		$dmtran= $dmt+$ran;
		$un=  uniqid();
		$dmtun = $dmt.$un;
		$mdun = md5($dmtran.$un);
		$sort=substr($mdun, 16); // if you want sort length code.
		return $mdun;
	}

	/**
	 *
	 * Function to make URLs into links
	 *
	 * @param string The url string
	 *
	 * @return string
	 *
	 **/
	function makeLink($string, $label){

		/*** make sure there is an http:// on all URLs ***/
		$string = preg_replace("/([^\w\/])(www\.[a-z0-9\-]+\.[a-z0-9\-]+)/i", "$1http://$2",$string);
		/*** make all URLs links ***/
		$string = preg_replace("/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i","<a target=\"_blank\" href=\"$1\">.$label.</a>",$string);
		/*** make all emails hot links ***/
		$string = preg_replace("/([\w-?&;#~=\.\/]+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?))/i","<a href=\"mailto:$1\">$1</a>",$string);

		return $string;
	}

	function highlightkeyword($str, $search) {
	    $highlightcolor = "#FE7A15";
	    $occurrences = substr_count(strtolower($str), strtolower($search));
	    $newstring = $str;
	    $match = array();
	 
	    for ($i=0;$i<$occurrences;$i++) {
	        $match[$i] = stripos($str, $search, $i);
	        $match[$i] = substr($str, $match[$i], strlen($search));
	        $newstring = str_replace($match[$i], '[#]'.$match[$i].'[@]', strip_tags($newstring));
	    }
	 
	    $newstring = str_replace('[#]', '<span style="color: '.$highlightcolor.';">', $newstring);
	    $newstring = str_replace('[@]', '</span>', $newstring);
	    return $newstring;
	 
	}

	function getStudentGrade($total=""){
	    $grade;
	    if ($total >= 1  && $total <= 20){
	        $grade = 'E-2';
	    }else if($total >= 21 && $total <= 32){
	        $grade = 'E-1';
	    }else if($total >= 33 && $total <= 40) {
	        $grade = 'D';
	    }else if($total >= 41 && $total <= 50) {
	        $grade = 'C-2';
	    }else if($total >= 51 && $total <= 60) {
	        $grade = 'C-1';
	    }else if($total >= 61 && $total <= 70) {
	        $grade = 'B-2';
	    }else if($total >= 71 && $total <= 80) {
	        $grade = 'B-1';
	    }else if($total >= 81 && $total <= 90) {
	        $grade = 'A-2';
	    }else if($total >= 91 && $total <= 100) {
	        $grade = 'A-1';
	    }else{
	        $grade = '';
	    }
	    return $grade;
	}


	function percentage($numerator="",$denomenator="",$precision='0'){
		if($denomenator>0){
			$res = round( ($numerator / $denomenator) * 100, $precision );
			return $res;
		}else{
			return 0;
		}
	}

	function percentageCategory($percentage=""){
		$percentage = round($percentage);
		//if($percentage>0){
			if($percentage>=75){
				return "Excellent";
			}else if($percentage>=60 && $percentage <= 74){
				return "Very Good";
			}else if($percentage>=35 && $percentage <= 59){
				return "Satisfactory";
			}else{
				return "Need Improvement";
			}
		//}
	}

	function CollegePTGrade($pt_marks_obtained=""){
		if($pt_marks_obtained >= 30){
	        $marks_obtained = 'A';
	    }else if($pt_marks_obtained >= 18 && $pt_marks_obtained<30){
	        $marks_obtained = 'B';
	    }else if($pt_marks_obtained >= 10 && $pt_marks_obtained<18){
	        $marks_obtained = 'C';
	    }else if($pt_marks_obtained < 10) {
	        $marks_obtained = 'D';
	    }else{
	        $marks_obtained = '';
	    }
	    return $marks_obtained;
	}


	function CollegeGrade($percentage=""){
		$percentage = number_format($percentage, 2);
		if($percentage>=75 ){
	        $PerObtained = 'DISTINCTION';
	    }else if($percentage>= 60 && $percentage<75){
	        $PerObtained = 'A';
	    }else if($percentage>= 40 && $percentage<60){
	        $PerObtained = 'B';
	    }else if($percentage>= 35 && $percentage<40) {
	        $PerObtained = 'PASS';
	    }else{
	        $PerObtained = '-';
	    }
	    return $PerObtained;
	}



}?>
 