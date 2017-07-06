<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.5 Boxes


use Book\Control\Page;
use Book\Widgets\Container\Panel;
use Book\Widgets\Container\HBox;

class BoxControlExample extends Page {
    public function __construct() {
        parent::__construct();
        
        $panel1 = new Panel('Panel 1');
        $panel1->style = 'margin: 10px';
        $panel1->add(str_repeat('sdf sdf sdf sdf sdf sdf sdf sdf sdf <br>', 5));
        
        $panel2 = new Panel('Panel 2');
        $panel2->style = 'margin: 10px';
        $panel2->add(str_repeat('sdf sdf sdf sdf sdf sdf sdf sdf sdf <br>', 5));
        
        $box = new HBox;
        $box->add($panel1);
        $box->add($panel2);
        $box->show();
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=PanelControlExample