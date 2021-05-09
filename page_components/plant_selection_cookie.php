<?php

/* In this file we will check to see if the plant selection has been submitted and save the selection as a cookie*/

    // Here we insert the file where the plant selection query happens
include 'queries/plant_selection_query.php';
require_once 'queries/query_class.php';

if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['submit_plants']) && !$selection_error){
    while($row = $selection_result->fetch_assoc()){
        /*Check to see if each plant id from the query is set and add it to the plants variable*/
        if (isset($_GET[$row['p.plant_id']]) && is_numeric($_GET[$row['p.plant_id']])){
            $your_plants[$row['p.plant_id']] = $row['p.plant_name'];
        }
        /*encode array to store it in cookie. Cookie set to expire in about 2 months*/
        $cookie_plants = json_encode($your_plants);
        setcookie('plants', $cookie_plants, time() + (86400 * 60), "/");
    }
}
/*Check to see if cookie is set and decode to use the value on rest of site*/
if (isset($_COOKIE['plants'])) {
    $your_plants = new Plant_Selection();
}
?>