<aside class="plant_selection">
    <header>
        
        <button class="hide_button" aria-expanded="true" onclick="toggle_visibility(this, 'selection_hidden', 'Hide plant selection', 'Show plant selection')">Hide plant selection</button>
        <h2>Choose your plants</h2>
    </header>
    <section class="hidden_area visible" id="selection_hidden">

        <div>
            <h3>Selected plants:</h3>
<!--            Here we will go over all the plants in your_plants and create a list item to show that it has been selected-->
            <ul>
                <?php
                foreach ($your_plants->plant_array as $plant) {
                    echo "<li>" . $plant . "</li>";
                }
                ?>
            </ul>
        </div>
        <div>
            <form name="plant_selection" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="get">
                <h3>Add plants:</h3>

<!--                This will go over each plant in the results of the plant selection query and reate a checkbox-->
<!--                Query happens in the plant_selection_cookie file in an include-->
                <?php
                if (!$selection_error){
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
                }
                ?>
                <input type="submit" name="submit_plants" value="Submit plant selection">
            </form>
        </div>
    </section>
</aside>