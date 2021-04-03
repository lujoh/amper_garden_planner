<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Planting Guide and Calendar - Amper Garden Planner</title>
        <?php
        /*insert html head info that is standard for all pages*/
        require_once 'html_head_info.php';
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
                <h2 class="page_name">
                    Your personal planting guide &amp; calendar
                </h2>
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
                    </p>
                    <div>
                        <label for="first_frost">First frost date</label>
                        <input type="date" name="first_frost" id="first_frost">
                    </div>
                    <div>
                        <label for="last_frost">Last frost date</label>
                        <input type="date" name="last_frost" id="last_frost">
                    </div>
                </section>
                <section class="plant_info calendar">
                    <h3>Planting calendar</h3>
                    <article class="plant_row">
                        <div class="plant_date">
                            May 14th - May 21st
                        </div>
                        <div class="plant_name_calendar">
                            <h4>Nasturtium</h4>
                            <button class="hide_button">Show planting instructions</button>
                            <div class="hidden_area hidden" id="nasturtium_hidden">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                        </div>
                    </article>
                    <article class="plant_row">
                        <div class="plant_date">
                            May 24th - June 5th
                        </div>
                        <div class="plant_name_calendar">
                            <h4>Basil</h4>
                            <button class="hide_button">Show planting instructions</button>
                            <div class="hidden_area hidden" id="basil_hidden">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                        </div>
                    </article>
                </section>
                
            </main>
            <?php
            /*Insert footer*/
            require_once 'page_components/footer.php';
            ?>
        </div><!--closing tag container-->
    </body>
</html>