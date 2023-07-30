<?php

use core\AddMenuPage\AddMenuPage;
use core\View;

add_action('init', function(){

    $menu_page = new AddMenuPage(
        'My Page Title',
        'My Menu Title',
        'manage_options',
        'my-menu-slug',
        function() {
            $name = "arash";
            View::renderBlade('test', compact('name'));
        }
    );
    $menu_page->add();
});
