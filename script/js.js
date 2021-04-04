/*function to toggle visibility of hidable items*/
function toggle_visibility(button, id_name, button_text_vis, button_text_hid){
    var hidden_item = document.getElementById(id_name);
    if (hidden_item.className == "hidden"){
        hidden_item.className = "visible";
        button.setAttribute("aria-expanded", "true");
        button.innerHTML = button_text_vis;
    } else {
        hidden_item.className = "hidden";
        button.setAttribute("aria-expanded", "false");
        button.innerHTML = button_text_hid;
    }
}