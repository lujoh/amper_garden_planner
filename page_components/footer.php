<footer>
    <p>
        Website by <a target="_blank" href="https://www.linkedin.com/in/lucia-e-johnson">Lucia Johnson</a>.
    </p>
    <p>
        View the source code of this website on <a target="_blank" href="https://github.com/lujoh/amper_garden_planner">GitHub</a>.
    </p>
    <h4>Sources:</h4>
    <p>
        <i>I do not take responsibility for the content of the source websites.</i>
    </p>
    <ul>
        <?php
        $calendar_text = new Content_Query();
        $calendar_text->print_sources();
        ?>
<!--        <li><a href="https://www.almanac.com/">The Old Farmer's Almanac</a></li>-->
    </ul>
</footer>