<?php

class Base {

    public function __construct($obj = null) {
        if ($obj) {
            foreach ($this->fields as $key => $value) {
                $this->{$key} = $obj->{$key};
            }
        } else {
            if ($this->id) {
                $this->{$this->id} = null;
            }
        }
    }

    public function getSQL() {
        $idKey = $this->id;
        if ($idKey) {
            $idVal = $this->{$this->id};
        } else {
            $idVal = null;
        }
        $table = $this->table;
        $subInsert = "";
        $subUpdate = "";
        foreach ($this->fields as $key => $value) {
            if ($key === $this->id) {
                $subInsert.="null";
            } else {
                $val = $this->{$key};
                if ($value == "string") {
                    $val = '"' . $val . '"';
                }
                $subUpdate.= $key . "= " . $val;
                $subInsert.= $val;
            }
            $subInsert.=", ";
            $subUpdate.=", ";
        };

        $subInsert = substr($subInsert, 0, -2);
        $subUpdate = substr($subUpdate, 1, -2);
        $insert = "INSERT INTO $table VALUES ($subInsert);";

        $update = ($idVal) ? "UPDATE $table SET $subUpdate WHERE $idKey = $idVal" : "";

        return array("insert" => $insert, "update" => $update);
    }

    public function save() {
        global $DB;
        $sqls = $this->getSQL();
        $insert = $sqls["insert"];
        $update = $sqls["update"];


        if ($this->id) {
            if ($this->{$this->id}) {
                echo $update;
                $DB->execute($update);
            } else {
                echo $insert;
                $DB->execute($insert);
            }
        } else {
            
        }
    }

    public function delete() {
        $this->deleted = 1;
        $this->save();
    }

    public function get($where = null) {

        global $DB;

        if ($where) {
            if (substr($where, 0, 5) == "WHERE") {
                $where.= " AND deleted = 0";
            } else {
                $where.= " WHERE deleted = 0";
            }
        } else {
            $where = "";
        }


        $sql = "SELECT * FROM " . $this->table . " " . $where;

        $DB->execute($sql);
        if ($DB->getNumRows() == null) {
            return null;
        }
        $array = array();
        $className = get_called_class();
        while ($obj = $DB->getNextObject()) {
            $array[] = new $className($obj);
        }

        return $array;
    }

    public function getById($id) {
        $item = $this->get("WHERE " . $this->id . " = " . $id);
        if ($item) {
            return $item[0];
        }
    }

    public function getByColumn($column, $val) {
        if (!array_key_exists($column, $this->fields)) {
            return null;
        }
        $val = ($this->fields[$column] === "string") ? ("'" . $val . "'") : $val;
        $sql = "WHERE " . $column . " = " . $val;
        $item = $this->get($sql);
        if ($item) {
            return $item[0];
        }
    }

    public function getAllByColumn($column, $val) {
        if (!array_key_exists($column, $this->fields)) {
            return null;
        }
        $val = ($this->fields[$column] === "string") ? ("'" . $val . "'") : $val;
        $sql = "WHERE " . $column . " = " . $val;
        $item = $this->get($sql);
        return $item;
    }

    public function getByColumna($column, $val) {
        if (!array_key_exists($column, $this->fields)) {
            return null;
        }
        $val = ($this->fields[$column] === "string") ? ("'" . $val . "'") : $val;
        $sql = "WHERE " . $column . " = " . $val;
        $item = $this->get($sql);
        return $item;
    }

    public function setData($post) {
        foreach ($this->fields as $key => $value) {

            if ($key === $this->id || !isset($post[$key])) {
                continue;
            }
            $this->{$key} = $post[$key];
        }
    }

    public function toString() {

        $className = get_called_class();
        $fields = array();
        foreach ($this->fields as $key => $value) {
            $val = $this->{$key};
            $fields[] = "<b>$key</b>: $val";
        }
        $fieldsString = join(" ", $fields);

        return "<br/><b>$className</b>: [$fieldsString];<br>";
    }

    /*     * **** Z POZDROWIENIAMI DLA ADAMA ***** */

    public function findByPk($id) {
        return $this->find("$this->id = :$this->id", array(":$this->id" => $id));
    }

    public function find($condition = null, $parameters = null) {
        $query = "SELECT * FROM " . $this->table;

        if ($condition !== null) {
            $query .= " WHERE " . $condition;
        }

        $st = PDODataBase::get()->prepare($query);

        if ($parameters !== null) {
            foreach ($parameters as $key => &$value) {
                $st->bindParam($key, $value, PDO::PARAM_STR | PDO::PARAM_INT);
            }
        }

        if ($st->execute()) {
            $result = $st->fetchAll(PDO::FETCH_CLASS);

            if (count($result) > 0) {
                $className = get_called_class();
                return new $className($result[0]);
            } else {
                return null;
            }
        } else {
            print_r($st->errorInfo());
        }
    }

    public function findAll($condition = null, $parameters = null) {
        $query = "SELECT * FROM " . $this->table;

        if ($condition !== null) {
            $query .= " WHERE " . $condition;
        }

        $st = PDODataBase::get()->prepare($query);

        if ($parameters !== null) {
            foreach ($parameters as $key => &$value) {
                $st->bindParam($key, $value, PDO::PARAM_STR | PDO::PARAM_INT);
            }
        }

        if ($st->execute()) {
            $results = $st->fetchAll(PDO::FETCH_CLASS);

            $results_class = array();

            $className = get_called_class();
            foreach ($results as $result) {
                $results_class[] = new $className($result);
            }
            return $results_class;
        } else {
            print_r($st->errorInfo());
        }
    }

    public function findBySql($query, $parameters = null) {
        $st = PDODataBase::get()->prepare($query);

        if ($parameters !== null) {
            foreach ($parameters as $key => &$value) {
                $st->bindParam($key, $value, PDO::PARAM_STR | PDO::PARAM_INT);
            }
        }
        
        if ($st->execute()) {
            $results = $st->fetchAll();

            $results_class = array();

            $className = get_called_class();
            foreach ($results as $result) {
                $result_class = new stdClass();
                foreach ($result as $key => $value) {
                    $result_class->$key = $value;
                }
                $results_class[] = $result_class;
            }
            return $results_class;
        } else {
            print_r($st->errorInfo());
        }
    }

}

?>