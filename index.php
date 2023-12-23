<?php
include 'page_components/plant_selection_cookie.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Amper Garden Planner Home</title>
        <?php
        /*insert html head info that is standard for all pages*/
        require_once 'page_components/html_head_info.php';
        ?>
        <meta name="description" content="Your personal gardening guide">
    </head>
    <body>
        <div class="container">
            <?php
            /*Insert header*/
            require_once 'page_components/header.php';
            ?>
            <main>
                <h1 class="page_name">
                    Amper Garden Planner - Home
                </h1>
                <p class="subheader">
                    Plan(t) your garden.
                </p>
                
                
<!--                This is where the main content of the page starts-->
                <article class="plant_info">
                    <h2>About this website</h2>
                    <p>This gardening guide was created to help new and experienced gardeners get the information about the plants they are interested in that is relevant to their situation without having to visit several pages and scroll past irrelevant information and ads. To achieve this, the guide is organized based on the stage of gardening that you are in and it allows you to customize which plants you want to see.</p>
                    <p>This website was initially built as part of a school project and has grown since then. There is still a limited number of plants available. I am building up the list as I am expanding what I'm growing in my own garden. If you want to suggest a plant please feel free to <a href="https://github.com/lujoh/amper_garden_planner/issues/new" target="_blank">submit your plant suggestion on GitHub</a>.</p>
                </article>
                <article class="plant_info">
                    <h2>Navigating the website</h2>

                    <p>
                        First you will want to select the plants that you want to see information about. You can do this below or at the top of each page. Your selection will be saved as a cookie for a few months for your convenience and can be changed at any time.
                        Then select the page that matches the stage of your gardening you are in and browse the relevant information
                    </p>
                    <h3>The pages:</h3>
                    <ul>
                        <li>
                            The <a href="location.php">location selection page</a> is for when you are first planning out your garden. It gives you information about what kind of soil and sun conditions the plants like, how much space they need and which other plants they play well with.
                        </li>
                        <li>
                            The <a href="calendar.php">planting guide &amp; calendar</a> is for when you are getting ready to plant. It will give you a suggested planting calendar based on your frost dates as well as planting instructions for the plants that you have chosen. If you live in an area where your planting season isn't dictated by frost, you can enter false frost dates and still take advantage of the planting instructions, but you may have to look elsewhere for information about timing.
                        </li>
                        <li>
                            After your plants have been planted you can find information about how often and how to water your plants on the <a href="watering">watering guide page</a>. This will include information about watering both seedlings and mature plants as well as general watering tips.
                        </li>
                        <li>
                            You can get information about ongoing plant care throughout the gardening lifecycle on the <a href="care.php">plant care page</a>. This will give you information about pruning, fertilizing, as well as common pests and diseases.
                        </li>
                        <li>
                            The final page you will be looking at during your planting season will be the <a href="harvest.php">harvest instructions page</a>. Here you will see information about how to tell if your plant is ready to harvest and how to go about it.
                        </li>
                    </ul>
                </article>

                <?php
                /*Insert plant selection aside*/
                require_once 'page_components/plant_selection.php';
                ?>
                
            </main>
            <?php
            /*Insert footer*/
            require_once 'page_components/footer.php';
            ?>
        </div><!--closing tag container-->
    <script src="script/js.js"></script></body>
</html>