<?php




class Validator
{
	

	public static function parseNumber($val){
	
		$pattern = '/^\d+$/';
		if( preg_match($pattern, $val)){
			return intval($val);
		}else{
			return null;
		}
	}
	
	
	public static function validVerifyToken($token){
		return preg_match("/^[0-9z-zA-Z]{20}$/i", $token);	
	}
	
	public static function validPassword($pswd)
	{		//6+
	$len = strlen($pswd);
	return $len>5;
	}
	
	
	public static function validUsername($username)
	{		//5 - 15
	$len = strlen($username);
	return Validator::validName($username) && $len>4 && $len<16;
	}
	
	
	public static function validDescription($description){
		//10+
		$len = strlen($description);
		return $len>9;
	}
	
	public static function validMail($email)
	{
		return preg_match('/^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/', $email);
	}
	
	
	public static function validCatalogName($catalogName)
	{		//5 - 15
	$len = strlen($catalogName);
	return Validator::validName2($catalogName) && $len>2 && $len<16;
	}
	
	
	public static function validGroupName($groupName)
	{		//5 - 15
	$len = strlen($groupName);
	return Validator::validName2($groupName) && $len>4 && $len<16;
	}
	
	public static function validTag($tag)
	{			
		return preg_match('/^[a-zA-Z0-9]+$/i', $tag) && strlen($tag)>1;
	}
	
	public static function validSearchUsername($name){
		
		return preg_match('/^[a-zA-Z0-9]+$/i', $name);
	}
	
	
	public static function validURL($url){
		return filter_var($url, FILTER_VALIDATE_URL);
	}
	
	public static function clean($input){
		
		$input= preg_replace( '/\s+/', ' ', $input);
		$input= trim($input);	
		$input=strip_tags($input);
		$input= mysql_real_escape_string($input);
		
		return $input;
		
	}
	
	private static function validName($name)
	{
		return preg_match('/^[A-Za-z][a-zA-Z0-9]+$/i', $name);
	}
	
	private static function validName2($name)
	{
		return preg_match('/^[a-zA-Z0-9!@#$%\^&\*\(\)-_=\+\\\|]+$/i', $name);
	}
	
	
	
	
	
	
	
}

















?>