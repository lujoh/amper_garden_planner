<aside class="plant_selection">
    <header>
        
        <button class="hide_button" aria-expanded="true" onclick="toggle_visibility(this, 'selection_hidden', 'Hide plant selection', 'Show plant selection')">Hide plant selection</button>
        <h2>Choose your plants</h2>
    </header>
    <section class="hidden_area visible" id="selection_hidden">
<!--        Here we insert the file where the plant selection query happens-->
        <?php
        include 'plant_selection_query.php';
        ?>
<!--        Here we will check to see if the form has been submitted 
and go over each plant from the query results to see if they have been selected and add them to the your_plants variable-->
        <div>
            <h3>Selected plants:</h3>
<!--            Here we will go over all the plants in your_plants and create a list item to show that it has been selected-->
            <ul>
                <li>Nasturtium</li>
                <li>Basil</li>
            </ul>
        </div>
        <div>
            <form name="plant_selection">
                <h3>Add plants:</h3>

<!--                This will go over each plant in the results of the plant selection query and reate a checkbox-->
                <?php
                while($row = $selection_result->fetch_assoc()){
                    //checks if the item was previously selected
                    $checked_status = "";
                    if (isset($your_plants[$row['p.plant_id']])){
                        $checked_status = "checked";
                    }
                    
                    //create checkboxes
                    echo "<input type='checkbox' name='" . $row['p.plant_id'] . "' id='" . $row['p.plant_id'] . "' value='" . $row['p.plant_id'] . "' " . $checked_status . ">";
                    //create label
                    echo "<label for='" . $row['p.plant_id'] . "'>" . $row['p.plant_name'] . "</label><br>";
                }
                ?>
                <input type="submit" value="Submit plant selection">
            </form>
        </div>
    </section>
</aside>