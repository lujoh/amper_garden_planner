<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Location Selection - Amper Garden Planner</title>
        <?php
        /*insert html head info that is standard for all pages*/
        require_once 'html_head_info.php';
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
                    <article class="plant_info location">
                        <h2>Nasturtium</h2>
                        <h3>Soil Requirements:</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <h3>Shade Requirements:</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <h3>Spacing:</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <h3>Plant near:</h3>
                        <ul>
                            <li>Lorem ipsum dolor</li>
                            <li>Lorem ipsum dolor</li>
                            <li>Lorem ipsum dolor</li>
                        </ul>
                        <h3>Plant away from:</h3>
                        <ul>
                            <li>Lorem ipsum dolor</li>
                            <li>Lorem ipsum dolor</li>
                            <li>Lorem ipsum dolor</li>
                        </ul>
                    </article>
                    <article class="plant_info location">
                        <h2>Basil</h2>
                        <h3>Soil Requirements:</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <h3>Shade Requirements:</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <h3>Spacing:</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <h3>Plant near:</h3>
                        <ul>
                            <li>Lorem ipsum dolor</li>
                            <li>Lorem ipsum dolor</li>
                            <li>Lorem ipsum dolor</li>
                        </ul>
                        <h3>Plant away from:</h3>
                        <ul>
                            <li>Lorem ipsum dolor</li>
                            <li>Lorem ipsum dolor</li>
                            <li>Lorem ipsum dolor</li>
                        </ul>
                    </article>
                </div>
                
            </main>
            <?php
            /*Insert footer*/
            require_once 'page_components/footer.php';
            ?>
        </div><!--closing tag container-->
    </body>
</html>