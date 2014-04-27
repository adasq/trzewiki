<?php


class Base {


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
			echo $update;
			$DB->execute($update);

		}else{
			echo $insert;
			$DB->execute($insert);

		}


	}




	public function toString(){
 
			
	   $className = get_called_class();

	   $fields = array();
	   foreach($this as $key => $value) {
	   		if($key != "fields"){
	   			 $fields[] = "<b>$key</b>: $value";
	   		}
           
       }
       $fieldsString = join(" ",$fields);

       return "<b>$className</b>: [$fieldsString];<br>";

	}
}




?>