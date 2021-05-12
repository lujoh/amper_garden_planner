<?php
include 'page_components/plant_selection_cookie.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Watering Guide - Amper Garden Planner</title>
        <?php
        /*insert html head info that is standard for all pages*/
        require_once 'page_components/html_head_info.php';
        ?>
        <meta name="description" content="Your personal guide to watering your plants.">
    </head>
    <body>
        <div class="container">
            <?php
            /*Insert header*/
            require_once 'page_components/header.php';
            ?>
            <main>
                <h1 class="page_name">
                    Your personal watering guide
                </h1>
                <p class="subheader">
                    Wet your plants properly.
                </p>
                <?php
                /*Insert plant selection aside*/
                require_once 'page_components/plant_selection.php';
                ?>
                
<!--                This is where the main content of the page starts-->
                <div>
                    <article class="plant_info watering">
                        <h2>Watering new seedlings</h2>
                        <?php
                        $watering_text = new Content_Query();
                        $watering_text->print_watering('seedling');
                        ?>
                        
                    </article>
                    <article class="plant_info watering">
                        <h2>Watering older plants</h2>
                        <?php
                        $watering_text = new Content_Query();
                        $watering_text->print_watering('adult');
                        ?>

                    </article>
                    <article class="plant_info watering">
                        <h2>General watering tips</h2>
                        <ul>
                            <li>
                                When you are watering plants you usually want to water them right at the base of the plant and avoid getting too much water on the leaves. Watering the leaves can lead to diseases like powdery mildew. As a result, watering by drip irrigation or by hand is usually preferrable to watering by sprinkler.
                            </li>
                            <li>
                                Watering in the morning is usually best. This gives the water time to get into the soil before the sun gets too strong during midday. If you water during midday, a lot of the water can evaporate before it gets deep into the soil and you end up having to water more. If you water in the evenings, any water that gets on the leaves might not have time to evaporate before night and it can lead to diseases like powdery mildew.
                            </li>
                            <li>
                                For many (not all!) plants it is better to water a large amount less frequently than to water smaller amounts often. This is because watering less frequently encourages plants to develop deeper roots, which makes them stronger. Some plants naturally have shallow roots, so this is not recommended in these situations. This kind of watering is mostly good during growth phases of the plant. Small seedlings won't have deep enough roots to withstand this yet, and plants that are fruiting might need increased amounts of water, depending on the plant.
                            </li>
                            <li>
                                Plants in pots and containers tend to need to be watered more often than plants that are planted directly in the ground. This is because there is less soil to hold the water and plants can't develop deeper roots to get to water reserves.
                            </li>
                            <li>
                                It is usually best to water with water that is "room" temperature, aka the temperature that it is outdoors where the plant is, because water that is too cold can shock the plant and hot water could burn it.
                            </li>
                            <li>
                                Mulching can help your soil retain water so that you don't have to water as often. This is because it protects the soild from evaporation due to sun and wind.
                            </li>
                            <li>
                                When you're watering water the same spot for a longer amount of time than you might think. Even if the surface of the soil looks and feels wet, you want the water to get all the way down to where the roots are at and accumulate there so that the plants can actually get to it for a while.
                            </li>
                        </ul>
                    </article>
                </div>
                
            </main>
            <?php
            /*Insert footer*/
            require_once 'page_components/footer.php';
            ?>
        </div><!--closing tag container-->
    <script src="script/js.js"></script></body>
</html>