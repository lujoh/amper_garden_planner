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
                        <?php
                        $fertilization_text = new Content_Query();
                        $fertilization_text->print_care('fertilization');
                        ?>

                    </article>
                    <article class="plant_info care">
                        <h2>Pruning guide</h2>
                        <?php
                        $pruning_text = new Content_Query();
                        $pruning_text->print_care('pruning');
                        ?>

                    </article>
                    <article class="plant_info care">
                        <h2>Common pests and diseases</h2>
                        <p class="subheader">
                            Tell the aphids to bug off.
                        <?php
                        $pest_text = new Content_Query();
                        $pest_text->print_pests();
                        ?>
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