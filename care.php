<?php
include 'page_components/plant_selection_cookie.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Plant Care - Amper Garden Planner</title>
        <?php
        /*insert html head info that is standard for all pages*/
        require_once 'page_components/html_head_info.php';
        ?>
        <meta name="description" content="Your personal plant care guide.">
    </head>
    <body>
        <div class="container">
            <?php
            /*Insert header*/
            require_once 'page_components/header.php';
            ?>
            <main>
                <h1 class="page_name">
                    Plant care guide
                </h1>
                <p class="subheader">
                    You won't be-leaf how well these plants are growing.
                </p>
                <?php
                /*Insert plant selection aside*/
                require_once 'page_components/plant_selection.php';
                ?>
                
<!--                This is where the main content of the page starts-->
                <div>
                    <article class="plant_info care">
                        <h2>Fertilization needs</h2>
                        <h3>Nasturtium</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <h3>Basil</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </article>
                    <article class="plant_info care">
                        <h2>Pruning guide</h2>
                        <h3>Nasturtium</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <h3>Basil</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </article>
                    <article class="plant_info care">
                        <h2>Common pests and diseases</h2>
                        <p class="subheader">
                            Tell the aphids to bug off.
                        </p>
                        <h3>Nasturtium</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <h3>Basil</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
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