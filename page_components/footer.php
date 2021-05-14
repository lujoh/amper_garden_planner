<footer>
    <p>
        Website by Lucia Johnson
    </p>
    <h4>Sources:</h4>
    <ul>
        <?php
        $calendar_text = new Content_Query();
        $calendar_text->print_sources();
        ?>
<!--        <li><a href="https://www.almanac.com/">The Old Farmer's Almanac</a></li>-->
    </ul>
</footer>