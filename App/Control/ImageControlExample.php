<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.2 Images


use Book\Control\Page;
use Book\Widgets\Base\Image;

class ImageControlExample extends Page {
    public function __construct() {
        parent::__construct();
        
        $img = new Image('App/Images/ubuntu.png');
        $img->style = 'margin: 20px';
        
        parent::add($img);
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=ImageControlExample