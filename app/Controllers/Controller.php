<?php

class Controller {

    public static function headerSection($header = 'resources/front/layouts/header.php'){
        include ARASH_DIR . $header;
    }

    public static function footerSection($footer = 'resources/front/layouts/footer.php'){
        include ARASH_DIR . $footer;
    }
    
}