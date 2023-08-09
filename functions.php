<?php

use Core\AddMenuPage\AddMenuPage;
use Core\View;
use App\Controllers\MenuPageController;
use Core\Request;

class MenuInitializer
{
    public function init()
    {
        $menu_page = new AddMenuPage(
            'My Page Title',
            'My Menu Title',
            'manage_options',
            'my-menu-slug',
            [$this, 'menuPageCallback']
        );
        $menu_page->add();
    }

    public function menuPageCallback()
    {
        $menuPageController = new MenuPageController();
        $menuPageController->index();
        
        $request = new Request();
        if ($request->get('action') == 'delete') {
            $menuPageController->destroy();
        }
    }
}

// Usage
add_action('init', function() {
    $menuInitializer = new MenuInitializer();
    $menuInitializer->init();
});