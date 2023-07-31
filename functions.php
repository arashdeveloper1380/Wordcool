<?php

include "App/Controllers/MenuPageController.php";

use core\AddMenuPage\AddMenuPage;
use core\View;

add_action('init', function(){

    $menu_page = new AddMenuPage(
        'My Page Title',
        'My Menu Title',
        'manage_options',
        'my-menu-slug',
        function() {
            $menuPage = new \App\Controllers\MenuPageController();
            $menuPage->index();
            $request = new \core\Request();
            if($request->get('action') == 'delete'){
                $menuPage->destroy();
            }
        }
    );
    $menu_page->add();
});
