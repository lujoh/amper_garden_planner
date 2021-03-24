<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Page Template</title>
        <?php
        /*insert html head info that is standard for all pages*/
        require_once 'html_head_info.php';
        ?>
        <meta name="description" content="">
    </head>
    <body>
        <div class="container">
            <?php
            /*Insert header*/
            require_once 'header.php';
            ?>
            <main>
                <h2 class="page_name">
                    
                </h2>
                <?php
                /*Insert plant selection aside*/
                require_once 'plant_selection.php';
                ?>
                
<!--                This is where the main content of the page starts-->
                <section>
                </section>
                
            </main>
            <?php
            /*Insert footer*/
            require_once 'footer.php';
            ?>
        </div><!--closing tag container-->
    </body>
</html>