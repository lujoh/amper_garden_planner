<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Plant Care - Amper Garden Planner</title>
        <?php
        /*insert html head info that is standard for all pages*/
        require_once 'html_head_info.php';
        ?>
        <meta name="description" content="Your personal plant care guide.">
    </head>
    <body>
        <div class="container">
            <?php
            /*Insert header*/
            require_once 'header.php';
            ?>
            <main>
                <h2 class="page_name">
                    Plant care guide
                </h2>
                <p class="subheader">
                    You won't be-leaf how well these plants are growing.
                </p>
                <?php
                /*Insert plant selection aside*/
                require_once 'plant_selection.php';
                ?>
                
<!--                This is where the main content of the page starts-->
                <div>
                    <article class="plant_info care">
                        <h3>Fertilization deeds</h3>
                        <h4>Nasturtium</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <h4>Basil</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </article>
                    <article class="plant_info care">
                        <h3>Pruning guide</h3>
                        <h4>Nasturtium</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <h4>Basil</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </article>
                    <article class="plant_info care">
                        <h3>Common pests and diseases</h3>
                        <p class="subheader">
                            Tell the aphids to bug off.
                        </p>
                        <h4>Nasturtium</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                        <h4>Basil</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </article>
                </div>
                
            </main>
            <?php
            /*Insert footer*/
            require_once 'footer.php';
            ?>
        </div><!--closing tag container-->
    </body>
</html>