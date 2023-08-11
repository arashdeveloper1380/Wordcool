<?php

use Core\AddMenuPage\AddMenuPage;
use Core\View;
use App\Controllers\MenuPageController;
use Core\Admin\Admin;
use Core\Request\Request;

class Init
{
    // Admin Menu Page
    public function menuPage()
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
        // $capabilities = array(
        //     'edit_posts',
        //     'delete_posts'
        // );
        // if (Admin::authorCan($capabilities)) {
        //     echo "true";
        // } else {
        //     echo "false";
        // }
        // $role = Admin::getRole('editor');
        // foreach ($role->capabilities as $capability => $value) {
        //     echo $capability . '<br>';
        // }
        
        $menuPageController = new MenuPageController();
        $menuPageController->index();
        
        $request = new Request();
        if ($request->get('action') == 'delete') {
            $menuPageController->destroy();
        }
    }

    // Add Cap in Role
    public function addCap(){
        Admin::addCap('editor','custom_edit');
    }
    // has Cap in Role
    public function hasCap(){
        var_dump(Admin::hasCap('editor', 'custom_edit'));
    }

    // add Role
    public function addRole(){
        Admin::addRole('employer', 'employer', [
            'read'          => true,
            'edit_posts'    => false,
            'delete_posts'  => false,
        ]);
    }

    public function authorCan(){
        Admin::authorCan('edit_posts');
    }
}

// Usage
add_action('init', function() {
    $init = new Init();

    $init->menuPage();
    $init->addCap();

    $init->addRole();

    $init->authorCan();
    
});