<?php


class Base {


	public function toString(){
		
	   $className = get_called_class();

	   $fields = array();
	   foreach($this as $key => $value) {
            $fields[] = "<b>$key</b>: $value";
       }
       $fieldsString = join(" ",$fields);

       return "<b>$className</b>: [$fieldsString];<br>";

	}
}




?>