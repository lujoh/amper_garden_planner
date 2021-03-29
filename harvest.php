<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Harvest Guide - Amper Garden Planner</title>
        <?php
        /*insert html head info that is standard for all pages*/
        require_once 'html_head_info.php';
        ?>
        <meta name="description" content="Your personal plant harvesting guide.">
    </head>
    <body>
        <div class="container">
            <?php
            /*Insert header*/
            require_once 'header.php';
            ?>
            <main>
                <h2 class="page_name">
                    Your personal harvesting guide
                </h2>
                <p class="subheader">
                    Time to reap what you sowed.
                </p>
                <?php
                /*Insert plant selection aside*/
                require_once 'plant_selection.php';
                ?>
                
<!--                This is where the main content of the page starts-->
                <article class="plant_info harvest">
                    <h3>Nasturtium</h3>
                    <h4>Is it ready to harvest?</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <h4>How to harvest?</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </article>
                <article class="plant_info harvest">
                    <h3>Basil</h3>
                    <h4>Is it ready to harvest?</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <h4>How to harvest?</h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </article>
                
            </main>
            <?php
            /*Insert footer*/
            require_once 'footer.php';
            ?>
        </div><!--closing tag container-->
    </body>
</html>