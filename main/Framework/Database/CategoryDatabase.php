<?php

namespace Database;
class CategoryDatabase
{
    private $data;

    public function getData(){
        return $this->data;
    }
    public function select($username = null) : GReturn{
        $request = "SELECT * FROM " . $this->dbName;
        if(empty($username) === false){
            $request .= " WHERE username = '" . $username . "'";
        }
        $result = $this->conn->query($request);
        $row = [];
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }
        return new GReturn("ok", content: $row);
    }
}