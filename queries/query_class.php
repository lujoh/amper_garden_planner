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