<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.8  Actions


use Book\Control\Page;
use Book\Control\Action;

class ActionControlExample extends Page {
    public function __construct() {
        parent::__construct();
        
        $action1 = new Action([$this, 'executeAction1']);
        $action1->setParameter('code', 4);
        $action1->setParameter('name', 'doe');
        
        print $action1->serialize();
    }
    
    public function executeAction1() {
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=ActionControlExample