<?php
include 'page_components/plant_selection_cookie.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Page Template - Amper Garden Planner</title>
        <?php
        /*insert html head info that is standard for all pages*/
        require_once 'page_components/html_head_info.php';
        ?>
        <meta name="description" content="">
    </head>
    <body>
        <div class="container">
            <?php
            /*Insert header*/
            require_once 'page_components/header.php';
            ?>
            <main>
                <h1 class="page_name">
                    Template
                </h1>
                <p class="subheader">
                    
                </p>
                <?php
                /*Insert plant selection aside*/
                require_once 'page_components/plant_selection.php';
                ?>
                
<!--                This is where the main content of the page starts-->
                <section>
                </section>
                
            </main>
            <?php
            /*Insert footer*/
            require_once 'page_components/footer.php';
            ?>
        </div><!--closing tag container-->
    <script src="script/js.js"></script></body>
</html>