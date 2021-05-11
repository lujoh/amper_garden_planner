<?php
/* This file contains a plant selection class that can be used inside sql queries*/

/* Source: https://phpdelusions.net/mysqli_examples/prepared_statement_with_in_clause */

class Plant_Selection {
    public $plant_array;
    
    //method to create plant selection object
    function __construct(){
        $this->plant_array = json_decode($_COOKIE['plants'], true);
    }
    
    //method to get the placeholders for queries
    function prepare_placeholders() {
        return str_repeat('?,', count($this->plant_array) - 1) . '?';
    }
    
    //method to get the parameter types
    function parameter_types() {
        return str_repeat('i', count($this->plant_array));
    }
    
    //method to get string of IDs to enter into the query
    //the array values of the plant array are the plant names, but we want the IDs for the query, so we have to get the array keys first
    function get_parameters() {
        return implode(", ", array_keys($this->plant_array));
    }
}

require_once '../pwd.php';

class Content_Query {
    private $sql;
    private $conn;
    private $statement;
    public $query_error = false;
    public $plants;
    public $result;
    
    //method to construct a new query
    function __construct(){
        $this->plants = new Plant_Selection();
    }
    
    //method that prepares and sends query
    private function send_query(){
        $this->conn = new mysqli($servername, $username, $password, $db);
        //check for error
        if ($this->conn->connect_error) {
            $this->query_error = true;
        }
        //prepare the statement for the query
        $this->statement = $this->conn->prepare($this->sql);
        //bind the parameters using methods from the Plant_Selection class
        $this->statement->bind_param($this->plants->parameter_types(), $this->plants->get_parameters());
        //check for errors
        if(!$statement->execute()) {
            $query_error = true;
        }
        //close connection
        $this->conn->close();
        
    }
}