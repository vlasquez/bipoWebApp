<?php 
	
	function validateField($value,$type){
		$result=array();
		switch ($type) {
			case 'email':
				$regex="/^[_A-Za-z0-9-\+]+(\.[_A-Za-z0-9-]+)*@".
                        "[A-Za-z0-9-]+(\.[A-Za-z0-9]+)*(\.[A-Za-z]{2,})$/";
				$result["error"]=preg_match($regex, $value);

				if($result["error"]==1){
					$result["error"]=false;
					$result["message"]=null;
				}else{
					$result["error"]=true;
					$result["message"]="El correo electrónico no es valido \n";
				}
				return $result;
				break;
			case 'document':
				$regex="/^[0-9]{10,12}$/";
				$result["error"]=preg_match($regex, $value);

				if($result["error"]==1){
					$result["error"]=false;
					$result["message"]=null;
				}else{
					$result["error"]=true;
					$result["message"]="El documento no es valido \n";
				}
				return $result;
				break;
			case 'cellphone':
				$regex="/^[0-9]{10}$/";
				$result["error"]=preg_match($regex, $value);

				if($result["error"]==1){
					$result["error"]=false;
					$result["message"]=null;
				}else{
					$result["error"]=true;
					$result["message"]="El número de celular no es valido \n";
				}
				return $result;
				break;
				case 'names':
				$regex="/^([a-zA-Zñáéíóú]+[\s]*)+$/";
				$result["error"]=preg_match($regex, $value);

				if($result["error"]==1){
					$result["error"]=false;
					$result["message"]=null;
				}else{
					$result["error"]=true;
					$result["message"]="El nombre no debe contener números o caractéres especiales \n";
				}
				return $result;
				break;
			default:
				# code...
				break;
		}
	}
	function createNickName($name,$lastname){
		$randID=rand(0,999);
		$nickname=substr($name,0,3).substr($lastname,0,3).$randID;
		return $nickname;

	}
	function createUserDirectory($dirName){
		try
		{
			//$path=(isset($_SERVER["DOCUMENT_ROOT"]) && $_SERVER["DOCUMENT_ROOT"]!="") ? $_SERVER["DOCUMENT_ROOT"]."/" : "/var/www/html/";
			//$path="bipo/public/bikeImages/";

			//Produccion
			$path="../../public/bikeImages/".$dirName;
			if(!file_exists($path)){
				mkdir($path,0777);
				chmod($path,0777);
			}
			chmod($path,0777);
			return array("error"=>false,"message"=>null);
		}
		catch(Exception $e){
			return array("error"=>true,"message"=>$e->getMessage());
		}
	}
	function createReportDirectory($dirName){
		try
		{
			//$path=(isset($_SERVER["DOCUMENT_ROOT"]) && $_SERVER["DOCUMENT_ROOT"]!="") ? $_SERVER["DOCUMENT_ROOT"]."/" : "/var/www/html/";
			//$path="bipo/public/bikeImages/";

			//Produccion
			$path="../../public/reports/".$dirName;
			if(!file_exists($path)){
				mkdir($path,0777);
				chmod($path,0777);
			}
			chmod($path,0777);
			return array("error"=>false,"message"=>null);
		}
		catch(Exception $e){
			return array("error"=>true,"message"=>$e->getMessage());
		}
	}
	function sendEmail($to,$type){
		try{
			switch ($type) {
			case 'changePassword':
				$from='registro@bipoapp.com';
				$headers="From:".$from;
				$subject='Cambio de contraseña';
				$message="Tu contraseña ha sido cambiada satisfactoriamente";
				mail($to,$subject,$message);
				break;
			
			case 'contact':
				# code...
				break;
			
			default:
				# code...
				break;
			}	
		return true;
		}
		catch(exception $e){
			return $e->getMessage();
		}
		
	}
?>