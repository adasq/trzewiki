<?php


class Base {
	
	public function __construct($obj = null)
	{ 		if($obj){
			foreach ($this->fields as $key => $value) {		
			$this->{$key} = $obj->{$key};
			}
		}else{
			$this->{$this->id}= null;
		}
	}

	public function getSQL(){
		$idKey= $this->id;
		$idVal= $this->{ $this->id };
		$table = $this->table;
		$subInsert = "";
		$subUpdate = "";
		foreach ($this->fields as $key => $value) {
		    if($key === $this->id){
		    	$subInsert.="null";		    	 
		    }else{
		    	$val = $this->{$key};		    		
		    	if($value == "string"){
		    		$val = '"'.$val.'"';
		    	}
		    	$subUpdate.= $key."= ".$val;
		    	$subInsert.= $val;
		    }
		    $subInsert.=", ";	 
		    $subUpdate.=", ";	 
		};

		  $subInsert= substr( $subInsert, 0, -2);
		  $subUpdate= substr( $subUpdate, 1, -2);
		  $insert = "INSERT INTO $table VALUES ($subInsert);";
		  $update = "UPDATE $table SET $subUpdate WHERE $idKey = $idVal";

		  return array("insert" => $insert, "update" => $update);
	}


	public function save(){
		global $DB;
			
		$sqls = $this->getSQL();		
		$insert = $sqls["insert"];
		$update = $sqls["update"];
		 
		if($this->{$this->id}){
			//echo $update;
			$DB->execute($update);

		}else{
			//echo $insert;
			$DB->execute($insert);

		}


	}

	public function get($where = ""){
		 
		global $DB;
		echo $sql = "SELECT * FROM ".$this->table." ".$where;
		$DB->execute($sql);
		if($DB->getNumRows() == null){
			return null;
		}
		$array=array();
		$className = get_called_class();
		while($obj = $DB->getNextObject()){			
			$array[]=new $className($obj);
		}

		return $array;
	}

	public function getById($id){		 
		 $item=  $this->get("WHERE ".$this->id." = ".$id);
		 if($item){
		 	return $item[0];
		 }
	}


	public function toString(){
 	
	   $className = get_called_class();
	   $fields = array();
	   foreach($this->fields as $key => $value) {
	   			 $val = $this->{$key};
	   			 $fields[] = "<b>$key</b>: $val";
       }
       $fieldsString = join(" ",$fields);

       return "<br/><b>$className</b>: [$fieldsString];<br>";

	}
}




?>