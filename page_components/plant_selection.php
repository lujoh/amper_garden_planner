<aside class="plant_selection">
    <header>
        <button class="hide_button" aria-expanded="true" onclick="toggle_visibility(this, 'selection_hidden', 'Hide plant selection', 'Show plant selection')">Hide plant selection</button>
        <h2>Choose your plants</h2>
    </header>
    <section class="hidden_area visible" id="selection_hidden">
        <div>
            <h3>Selected plants:</h3>
            <ul>
                <li>Nasturtium</li>
                <li>Basil</li>
            </ul>
        </div>
        <div>
            <form name="plant_selection">
                <h3>Add plants:</h3>
                <label for="plant_search">Search available plants</label>
                <select name="plant_search" id="plant_search">
                    <option value="Basil">Basil</option>
                    <option value="Tomato">Tomato</option>
                    <option value="Nasturtium">Nasturtium</option>
                    <option value="Carrot">Carrot</option>
                </select>
                <input type="submit" value="Submit plant selection">
            </form>
        </div>
    </section>
</aside>