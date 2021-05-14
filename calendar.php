<?php
require_once 'page_components/plant_selection_cookie.php';
require_once 'page_components/frost_date_cookie.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Planting Guide and Calendar - Amper Garden Planner</title>
        <?php
        /*insert html head info that is standard for all pages*/
        require_once 'page_components/html_head_info.php';
        ?>
        <meta name="description" content="Your personal guide on when and how to plant your plants.">
    </head>
    <body>
        <div class="container">
            <?php
            /*Insert header*/
            require_once 'page_components/header.php';
            ?>
            <main>
                <h1 class="page_name">
                    Your personal planting guide &amp; calendar
                </h1>
                <p class="subheader">
                    Find the best thyme to plant your plants.
                </p>
                <?php
                /*Insert plant selection aside*/
                require_once 'page_components/plant_selection.php';
                ?>
                
<!--                This is where the main content of the page starts-->
                <section class="frost_dates">
                    <p>
                        Enter the average first and last frost dates for your region to get a personalized calendar for your selected plants.
                    </p><br>
                    <form name="frost_date_selection" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
                        <div>
                            <span>First frost date (generally in the fall):</span><br>
                            <label for="first_date">First frost date day</label>
                            <input type="number" name="first_day" id="first_day" min="1" max="31" step="1" required><br>
                            <label for="first_month">First frost date month</label>
                            <select name="first_month" id="first_month" required>
                                <option value='1'>January</option>
                                <option value='2'>February</option>
                                <option value='3'>March</option>
                                <option value='4'>April</option>
                                <option value='5'>May</option>
                                <option value='6'>June</option>
                                <option value='7'>July</option>
                                <option value='8'>August</option>
                                <option value='9'>September</option>
                                <option value='10'>October</option>
                                <option value='11'>November</option>
                                <option value='12'>December</option>
                            </select>
                        </div>
                        <div>
                            <span>Last frost date (generally in the spring):</span><br>
                            <label for="last_date">Last frost date day</label>
                            <input type="number" name="last_day" id="last_day" min="1" max="31" step="1" required><br>
                            <label for="last_month">First frost date month</label>
                            <select name="last_month" id="last_month" required>
                                <option value='1'>January</option>
                                <option value='2'>February</option>
                                <option value='3'>March</option>
                                <option value='4'>April</option>
                                <option value='5'>May</option>
                                <option value='6'>June</option>
                                <option value='7'>July</option>
                                <option value='8'>August</option>
                                <option value='9'>September</option>
                                <option value='10'>October</option>
                                <option value='11'>November</option>
                                <option value='12'>December</option>
                            </select>
                        </div>
                        <input type="submit" name="submit_frost" id="submit_frost" value="Submit frost dates">
                    </form>
                    <p><?= $error_message; ?></p>
                </section>
                <section class="plant_info calendar">
                    <h2>Planting calendar</h2>
                    <p class=subheader>
                        <?= $dates_message; ?>
                    </p>
                    
                    <?php
                    $calendar_text = new Content_Query();
                    $calendar_text->print_calendar($frost_dates);
                    ?>
                    
  
                </section>
                
            </main>
            <?php
            /*Insert footer*/
            require_once 'page_components/footer.php';
            ?>
        </div><!--closing tag container-->
    <script src="script/js.js"></script>
    </body>
</html>