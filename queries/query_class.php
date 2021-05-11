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


class Content_Query {
    private $sql;
    private $conn;
    private $statement;
    public $query_error = false;
    public $plants;
    public $result;
    private $existing_query_type;
    private $parameter_types;
    private $parameters;
    
    //method to construct a new query
    function __construct(){
        $this->plants = new Plant_Selection();
        $this->parameter_types = $this->plants->parameter_types();
        $this->parameters = $this->plants->get_parameters();
    }
    
    //method that prepares and sends query
    private function send_query(){
        
        $this->conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DB);
        //check for error
        if ($this->conn->connect_error) {
            $this->query_error = true;
            die("Connection error");
        }
        //prepare the statement for the query
        $this->statement = $this->conn->prepare($this->sql);
        //bind the parameters using methods from the Plant_Selection class
        $this->statement->bind_param($this->parameter_types, $this->parameters);
        //check for errors
        if(!$this->statement->execute()) {
            $this->query_error = true;
            die("Database query error");
        } else {
            
            $this->statement->store_result();
        }
        
        //close connection
        $this->conn->close();
    }
    
    //method to create query for the watering page
    private function get_watering(){
        $this->sql = "SELECT plant_name, watering_baby, watering_adult
        FROM plants
        WHERE plant_id IN (" . $this->plants->prepare_placeholders() . ");";
        $this->existing_query_type = "watering";
        $this->send_query();
    }
    
    //method to print the results of the watering query on the page in the seedling section
    public function print_watering_seedlings(){
        if (!$this->existing_query_type == "watering" || $this->query_error) {
            $this->get_watering();
        }
        $this->statement->bind_result($plant_name, $watering_baby, $watering_adult);
        if (!$this->statement){
            die("Please select plants to see information.");
        }
        while($this->statement->fetch()){
            echo "<h3>" . $plant_name . "</h3>";
            echo "<div class='flex_row'> <p>" . $watering_baby . "</p></div>";
        }
    }
}