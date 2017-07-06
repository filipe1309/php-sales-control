<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.4 Panels


use Book\Control\Page;
use Book\Widgets\Container\Panel;

class PanelControlExample extends Page {
    public function __construct() {
        parent::__construct();
        
        $panel = new Panel('Title of the panel');
        $panel->style = 'margin: 20px';
        $panel->add(str_repeat('sdf sdf sdf sdf sdf sdf sdf sdf sdf <br>', 5));
        $panel->show();
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=PanelControlExample