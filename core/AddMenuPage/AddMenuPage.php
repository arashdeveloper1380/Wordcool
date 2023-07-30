<?php

namespace core\AddMenuPage;

include "AddMenuPageInterface.php";

use core\AddMenuPage\AddMenuPageInterface;
use core\View;

class AddMenuPage implements AddMenuPageInterface{

    private $page_title;
    private $menu_title;
    private $capability;
    private $menu_slug;
    private $callback;

    public function __construct($page_title, $menu_title, $capability, $menu_slug, $callback) {
        $this->page_title = $page_title;
        $this->menu_title = $menu_title;
        $this->capability = $capability;
        $this->menu_slug = $menu_slug;
        $this->callback = $callback;
    }

    public function add(){
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
        add_menu_page(
            $this->page_title,
            $this->menu_title,
            $this->capability,
            $this->menu_slug,
            [$this, 'render']
        );
    }
    
    public function render() {
        call_user_func($this->callback);
    }
}