<?php


class DataBase{

	private $host='localhost';
	private $login='root';
	private $password='';
	private $dbname='asher';
	private $db;
	private $lastResult;

	private $transactionError=false;

	function __construct() {
		$this->db = mysql_connect("localhost","root","") or die("Błąd podczas połączenia z bazą danych.");
		mysql_select_db($this->dbname,$this->db) or die('Błąd podczas wybierania bazy danych.');
		$this->lastResult=null;
	}

	public function getLastResult(){
		return $this->lastResult;
	}

	public function focusTransactionError(){
		$this->transactionError=true;
	}


	public function execute($query){

	 $this->lastResult=	mysql_query($query, $this->db);
	 $this->errorCode=null;
	  
	 if($this->lastResult){
	 	return true;
	 }else{
	 	$this->transactionError=true;
	 	$this->errorCode=mysql_errno($this->db);
	 	return null;
	 }

	}

	public function getNumRows($result = NULL)
	{
		if($result == NULL){
			$result = $this->lastResult;
		}

		if ($result)
			return mysql_num_rows($result);
		else
			return null;
	}

	public function getLastId()
	{
		return mysql_insert_id();
	}

	public function getNextObject($result = NULL)
	{
		if ($result == NULL)
			$result = $this->lastResult;

		if ($result == NULL || mysql_num_rows($result) < 1)
			return NULL;
		else
			return mysql_fetch_object($result);

	}


	public function getNextArray($result = NULL)
	{
		if ($result == NULL)
			$result = $this->lastResult;

		if ($result == NULL || mysql_num_rows($result) < 1)
			return NULL;
		else
			return mysql_fetch_assoc($result);
	}



	public function beginTransaction() {
		mysql_query("BEGIN", $this->db);
		$this->transactionError=false;
	}


	public function endTransaction(){

		if($this->transactionError){
			mysql_query("ROLLBACK", $this->db);
			return false;
		}else{
			mysql_query("COMMIT", $this->db);
			return true;
		}

	}

	public function disconnect(){
		mysql_close($this->db);
	}


}

?>