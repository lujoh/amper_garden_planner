<?php
/* This file contains a plant selection class that can be used inside sql queries*/

/* Source for how to format placeholder variables: https://phpdelusions.net/mysqli_examples/prepared_statement_with_in_clause */

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
            if ($section == 'calendar'){
                $this->image_array[$plant_id] = "<img src='images/" . $image_url . "' alt='" . $alt . "' class='float_img'>";
            } else{
                $this->image_array[$plant_id] = "<img src='images/" . $image_url . "' alt='" . $alt . "'>";
            }
        }
        return $this->image_array;
    }
}

//class that is used to get content for the page
class Content_Query extends Base_Query {
    protected $image_object;
    protected $images;
    protected $section_variable;
    protected $existing_counter = [];
    protected $list_array = [];
    protected $plant_item = [];
    
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
    
    //method to create query for the plant care page - top section with pruning guide and Fertilization needs
    protected function get_care(){
        $this->sql = "
        SELECT plant_id, plant_name, fertilization, pruning
        FROM plants
        WHERE plant_id IN (" . $this->plants->prepare_placeholders() . ");";
        $this->send_query();
    }
    
    //method to print the results of the plant care query on the page
    public function print_care($section){
        $this->get_care();
        $this->statement->bind_result($plant_id, $plant_name, $fertilization, $pruning);
        $this->image_object = new Image_Query();
        $this->images = $this->image_object->get_images($section);
        if (!$this->statement){
            die("Please select plants to see information.");
        }
        while($this->statement->fetch()){
            if ($section == 'fertilization'){
                $this->section_variable = $fertilization;
            } else {
                $this->section_variable = $pruning;
            }
            echo "<h3>" . $plant_name . "</h3>";
            echo "<div class='flex_row'>";
            //insert pictures if available
            if (isset($this->images[$plant_id])){
                echo $this->images[$plant_id];
            }
            echo "<p>" . $this->section_variable . "</p></div>";
        }
    }
    
    //method to create query for the plant care page - bottom section with pests and diseases
    protected function get_pests(){
        $this->sql = "
        SELECT plants.plant_id, plants.plant_name, pest_name, pests.pest_id, pest_description
        FROM plants, plant_pest, pests
        WHERE plant_pest.plant_id IN (" . $this->plants->prepare_placeholders() . ")
        AND plants.plant_id = plant_pest.plant_id
        AND pests.pest_id = plant_pest.pest_id
        ORDER BY pests.pest_id;";
        $this->send_query();
    }
    
    
    //method to print the results of the pest section queries
    public function print_pests(){
        $this->get_pests();
        $this->statement->bind_result($plant_id, $plant_name, $pest_name, $pest_id, $pest_description);
        if (!$this->statement){
            die("Please select plants to see information.");
        }
        while($this->statement->fetch()){
            if (empty($this->existing_counter[$pest_id])){
                //this is entered the first time that each pest occurs. 
                //The starts with a closing paragraph tag, because it will be set within a paragraph tag on the page as a workaround to get the ending paragraph to close
                $this->existing_counter[$pest_id]= "</p><h3>" . $pest_name . "</h3><p>" . $pest_description . "</p><h4>Plants that often have this disease or pest</h4><p>";

            }
            //this part is saved for every loop and it consists of a list of each individual plant
            $this->existing_counter[$pest_id] .= $plant_name . "<br>";
        }
        foreach($this->existing_counter as $pest){
            echo $pest;
        }
    }
    
    //method to create query for the location page
    protected function get_location(){
        $this->sql = "
        SELECT plant_id, plant_name, soil_requirements, shade_requirements, spacing_requirements, plant_near, plant_far
        FROM plants
        WHERE plant_id IN (" . $this->plants->prepare_placeholders() . ");";
        $this->send_query();
    }
    
    //method to print a html list from an input comma separated list
    protected function print_list($input){
        $this->list_array = explode(", ", $input);
        echo "<ul>";
        foreach ($this->list_array as $li){
            echo "<li>" . $li . "</li>";
        }
        echo "</ul>";
    }
    
    //method to print the results of the location query on the page
    public function print_location(){
        $this->get_location();
        $this->statement->bind_result($plant_id, $plant_name, $soil_requirements, $shade_requirements, $spacing_requirements, $plant_near, $plant_far);
        if (!$this->statement){
            die("Please select plants to see information.");
        }
        while($this->statement->fetch()){
            echo "<article class='plant_info location'>";
            echo "<h2>" . $plant_name . "</h2>";
            echo "<h3>Soil Requirements:</h3><p>" . $soil_requirements . "</p>";
            echo "<h3>Shade Requirements:</h3><p>" . $shade_requirements . "</p>";
            echo "<h3>Spacing:</h3><p>" . $spacing_requirements . "</p>";
            echo "<h3>Companion Planting:</h3>";
            echo "<h4>Plant near:</h4>";
            $this->print_list($plant_near);
            echo "<h4>Plant away from:</h4>";
            $this->print_list($plant_far);
            echo "</article>";
        }
    }
    
    //method to create query for the calendar page - bottom section with pests and diseases
    protected function get_calendar(){
        $this->sql = "
        SELECT plants.plant_id, plants.plant_name, planting_instructions, date_id, days_to_start, days_to_end
        FROM plants, planting_dates
        WHERE plants.plant_id IN (" . $this->plants->prepare_placeholders() . ")
        AND plants.plant_id = planting_dates.plant_id;";
        $this->send_query();
    }
    
    //method to calculate dates for the calendar section
    private function calculate_dates($frost_dates, $difference, $date_id){
        //check if date is related to the first or last frost date
        if ($date_id == 1){
            //check to see if difference is positive or negative
            if ($difference >= 0){
                //create new Datetime object from the related frost date with the difference added
                return new DateTime('@' . strtotime($frost_dates['last']->format('Y-m-d') . '+' . $difference . ' days'));
            } else {
                return new DateTime('@' . strtotime($frost_dates['last']->format('Y-m-d') . $difference . ' days'));
            }
        } else {
            if ($difference >= 0){
                return new DateTime('@' . strtotime($frost_dates['first']->format('Y-m-d') . '+' . $difference . ' days'));
            } else {
                return new DateTime('@' . strtotime($frost_dates['first']->format('Y-m-d') . $difference . ' days'));
            }
        }
    }
    
    //method to sort calendar list items by date
    function sort_dates() {
        usort($this->existing_counter, function($a, $b) {
            if ($a['start_date'] == $b['start_date']) return 0;
            return ($a['start_date'] < $b['start_date'])?-1:1;
        });
    }
    
    
    //method to print the results of the calendar section queries
    public function print_calendar($frost_dates){
        $this->get_calendar();
        $this->statement->bind_result($plant_id, $plant_name, $planting_instructions, $date_id, $days_to_start, $days_to_end);
        $this->image_object = new Image_Query();
        $this->images = $this->image_object->get_images('calendar');
        if (!$this->statement){
            die("Please select plants and enter the frost dates for your region to see information.");
        }
        while($this->statement->fetch()){
            //add variables to an array so they can be sorted by date before echoing
            $this->plant_item['plant_name'] = $plant_name;
            $this->plant_item['planting_instructions'] = $planting_instructions;
            $this->plant_item['start_date'] = $this->calculate_dates($frost_dates, $days_to_start, $date_id);
            $this->plant_item['end_date'] = $this->calculate_dates($frost_dates, $days_to_end, $date_id);
            //this can be the unique id of the div for javascript purposes
            //will be combined from the plant id and date id to make it unique
            $this->plant_item['record_id'] = 'P' . $plant_id . 'D' . $date_id;
            //insert pictures if available
            if (isset($this->images[$plant_id])){
                $this->plant_item['image'] = $this->images[$plant_id];
            } else {
                $this->plant_item['image'] = "";
            }
            echo '<br>';
            $this->existing_counter[]= $this->plant_item;
        }
        //sort the dates then display them on the page
        $this->sort_dates();
        foreach($this->existing_counter as $item){
            echo '<article class="plant_row"><div class="plant_date">' . $item['start_date']->format('M jS') . ' - ' . $item['end_date']->format('M jS') . '</div>';
            echo '<div class="plant_name_calendar"><h3>' . $item['plant_name'] . '</h3>';
            echo '<button class="hide_button" aria-expanded="false" onclick="toggle_visibility(this, \'' . $item['record_id'] . '\', \'Hide planting instructions\', \'Show planting instructions\')">Show planting instructions</button>';
            echo '<div class="hidden" id="' . $item['record_id'] . '">';
            if (!empty($item['image'])){
                echo $item['image'];
            }
            echo "<p>" . $item['planting_instructions'] . "</p></div></div></article>";
        }
    }
    
    //methods to get sources to be displayed in the footer
    protected function get_sources_plants(){
        $this->sql = "
        SELECT plant_name, source
        FROM plants
        WHERE plant_id IN (" . $this->plants->prepare_placeholders() . ");";
        $this->send_query();
    }
    
    protected function get_sources_pests(){
        $this->sql = "
        SELECT DISTINCT pest_name, pest_source
        FROM  plant_pest, pests
        WHERE plant_pest.plant_id IN (" . $this->plants->prepare_placeholders() . ")
        AND pests.pest_id = plant_pest.pest_id;";
        $this->send_query();
    }
    
    
    //method to print the results of the sources queries
    public function print_sources(){
        //sources for the plants
        $this->get_sources_plants();
        $this->statement->bind_result($plant_name, $source);
        if (!$this->statement){
            die("Please select plants to see information.");
        }
        while($this->statement->fetch()){
            echo "<li><a href='" . $source . "'>" . $plant_name . " Source</a></li>";
        }
        //sources for the pests
        $this->get_sources_pests();
        $this->statement->bind_result($pest_name, $pest_source);
        if (!$this->statement){
            die("Please select plants to see information.");
        }
        while($this->statement->fetch()){
            echo "<li><a href='" . $pest_source . "'>" . $pest_name . " Source</a></li>";
        }
        
    }
  
}