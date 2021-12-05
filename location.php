<?php
include 'page_components/plant_selection_cookie.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Location Selection - Amper Garden Planner</title>
        <?php
        /*insert html head info that is standard for all pages*/
        require_once 'page_components/html_head_info.php';
        ?>
        <meta name="description" content="Your personal guide for chosing the right location for your plants.">
    </head>
    <body>
        <div class="container">
            <?php
            /*Insert header*/
            require_once 'page_components/header.php';
            ?>
            <main>
                <h1 class="page_name">
                    Your personal plant location guide
                </h1>
                <p class="subheader">
                    Plan your plot.
                </p>
                <?php
                /*Insert plant selection aside*/
                require_once 'page_components/plant_selection.php';
                ?>
                
<!--                This is where the main content of the page starts-->
                <div>
                    <?php
                    $location_text = new Content_Query();
                    $location_text->print_location();
                    ?>

                    <article class="plant_info location">
                        <h2>Crop Rotation</h2>
                        <h3>Why it is used</h3>
                        <p>
                            Crop rotation is when a different crop is planted in one location each season. This disrupts the accumulation of diseases and pests in the soil, because many of these are specialized to specific plant families. Another way crop rotation can benefit soil health is that the different root structures of the plants can improve the structure of the soil for other plants. It also allows nutrients to regenerate, as different plants require different levels of different nutrients and some can even replenish certain nutrients. While rotating crops generally is helpful, there is a specific order of rotation for the major plant families that is especially useful as it balances the different needs and weaknesses of plant families.
                        </p>
                        <h3>Rotation Order</h3>
                        <ul>
                            <li>Alliums</li>
                            <li>Legumes</li>
                            <li>Brassicas</li>
                            <li>Nightshades</li>
                            <li>Umbellifers</li>
                            <li>Cucurbits</li>
                        </ul>
                    </article>
                </div>
                
                
            </main>
            <?php
            /*Insert footer*/
            require_once 'page_components/footer.php';
            ?>
        </div><!--closing tag container-->
    <script src="script/js.js"></script>
    </body>
</html>