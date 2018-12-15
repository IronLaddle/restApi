<?php
class user{
 
    // database connection and table name
    private $conn;
    private $table_name = "tb_user";
 
    // object properties
    public $user_id;
    public $username;
    public $password;
    public $firstname;
    public $lastname;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // signup user
    function signup(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    username='".$this->username."', 
                    password='".$this->password."', 
                    firstname='".$this->firstname."', 
                    lastname='".$this->lastname."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        // $this->username=htmlspecialchars(strip_tags($this->username));
        // $this->password=htmlspecialchars(strip_tags($this->password));
        // $this->firstname=htmlspecialchars(strip_tags($this->firstname));
        // $this->lastname=htmlspecialchars(strip_tags($this->lastname));
    
        // bind values
        // $stmt->bindParam(":username", $this->username);
        // $stmt->bindParam(":password", $this->password);
        // $stmt->bindParam(":firstname", $this->firstname);
        // $stmt->bindParam(":lastname", $this->lastname);
    
        // execute query
        $stmt->execute();
        return $stmt;
        // if($stmt->execute()){
        //     $this->user_id = $this->conn->lastInsertId();
        //     return true;
        // }
        // return false;
    }

    // login user
    function login(){
        // select all query
        $query = "SELECT
                    *
                FROM
                    " . $this->table_name . " ";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                username='".$this->username."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}