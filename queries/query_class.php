<?php
/* This file contains a plant selection class that can be used inside sql queries*/

/* Source: https://phpdelusions.net/mysqli_examples/prepared_statement_with_in_clause */

class Plant_Selection {
    public $plant_array;
    
    //method to create plant selection object
    function __construct(){
        if (isset($_COOKIE['plants'])){
            $this->plant_array = json_decode($_COOKIE['plants'], true);
            if (empty($this->plant_array)){
                $this->plant_array[0] = "Please select plants to see information.";
            }
        } else {
            die("Please select plants to see information.");
        }
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
        return array_keys($this->plant_array);
    }
}

//General Query class that uses prepared statements that can be used in content and image queries
class Base_Query {
    protected $sql;
    protected $conn;
    protected $statement;
    public $query_error = false;
    public $plants;
    protected $parameter_types;
    protected $parameters;
    
    //method to construct a new query
    function __construct(){
        $this->plants = new Plant_Selection();
        $this->parameter_types = $this->plants->parameter_types();
        $this->parameters = $this->plants->get_parameters();
    }
    
    //method that prepares and sends query
    protected function send_query(){
        
        $this->conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DB);
        //check for error
        if ($this->conn->connect_error) {
            $this->query_error = true;
            die("Connection error");
        }
        //prepare the statement for the query
        $this->statement = $this->conn->prepare($this->sql);
        //bind the parameters using methods from the Plant_Selection class
        $this->statement->bind_param($this->parameter_types, ...$this->parameters);
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
}

//class that is used to get images for the page
class Image_Query extends Base_Query {
    protected $image_array;
    
    //method to get images for any query
    public function get_images($section){
        $this->sql = "
        SELECT images.plant_id, image_url, alt
        FROM plants, images
        WHERE images.plant_id IN (" . $this->plants->prepare_placeholders(). ")
        AND image_section = '" . $section ."'
        AND images.plant_id = plants.plant_id;";
        $this->send_query();
        
        //bind and format the query results in a loop
        $this->statement->bind_result($plant_id, $image_url, $alt);
        if (!$this->statement){
            die("Please select plants to see information.");
        }
        while($this->statement->fetch()){
            $this->image_array[$plant_id] = "<img src='images/" . $image_url . "' alt='" . $alt . "'>";
        }
        return $this->image_array;
    }
}

//class that is used to get content for the page
class Content_Query extends Base_Query {
    protected $image_object;
    protected $images;
    protected $section_variable;
    
    //method to create query for the watering page
    protected function get_watering(){
        $this->sql = "
        SELECT plant_id, plant_name, watering_baby, watering_adult
        FROM plants
        WHERE plant_id IN (" . $this->plants->prepare_placeholders() . ");";
        $this->send_query();
    }
    
    //method to print the results of the watering query on the page in both the seedling section and adult section
    public function print_watering($section){
        $this->get_watering();
        $this->statement->bind_result($plant_id, $plant_name, $watering_baby, $watering_adult);
        $this->image_object = new Image_Query();
        $this->images = $this->image_object->get_images($section);
        if (!$this->statement){
            die("Please select plants to see information.");
        }
        while($this->statement->fetch()){
            if ($section == 'seedling'){
                $this->section_variable = $watering_baby;
            } else {
                $this->section_variable = $watering_adult;
            }
            echo "<h3>" . $plant_name . "</h3>";
            echo "<div class='flex_row'> ";
            //insert pictures if available
            if (isset($this->images[$plant_id])){
                echo $this->images[$plant_id];
            }
            echo "<p>" . $this->section_variable . "</p></div>";
        }
    }
    
    //method to create query for the harvest page
    protected function get_harvest(){
        $this->sql = "
        SELECT plant_id, plant_name, harvest_ready, harvest_instruct
        FROM plants
        WHERE plant_id IN (" . $this->plants->prepare_placeholders() . ");";
        $this->send_query();
    }
    
    //method to print the results of the harvest query on the page
    public function print_harvest(){
        $this->get_harvest();
        $this->statement->bind_result($plant_id, $plant_name, $harvest_ready, $harvest_instruct);
        $this->image_object = new Image_Query();
        $this->images = $this->image_object->get_images('harvest');
        if (!$this->statement){
            die("Please select plants to see information.");
        }
        while($this->statement->fetch()){
            echo "<article class='plant_info harvest'>";
            echo "<h2>" . $plant_name . "</h2><h3>Is it ready to be harvested?</h3>";
            echo "<div class='flex_row'>";
            //insert pictures if available
            if (isset($this->images[$plant_id])){
                echo $this->images[$plant_id];
            }
            echo "<p>" . $harvest_ready . "</p></div>";
            echo "<h3>How to harvest?</h3>";
            echo "<p>" . $harvest_instruct . "</p></article>";
        }
    }
}