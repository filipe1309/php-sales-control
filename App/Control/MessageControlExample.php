<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.6 Dialog messages


use Book\Control\Page;
use Book\Widgets\Dialog\Message;

class MessageControlExample extends Page {
    public function __construct() {
        parent::__construct();
        
        new Message('info', 'Info message');
        new Message('error', 'Error message');
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=MessageControlExample