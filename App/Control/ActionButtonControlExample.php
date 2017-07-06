<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.8  Actions


use Book\Control\Page;
use Book\Control\Action;
use Book\Widgets\Base\Element;

class ActionButtonControlExample extends Page {
    public function __construct() {
        parent::__construct();
        
        $button1 = new Element('a');
        $button1->add('Action 1');
        $button1->class = 'btn btn-success';
        
        $button2 = new Element('a');
        $button2->add('Action 2');
        $button2->class = 'btn btn-primary';
        
        $action1 = new Action([$this, 'executeAction1']);
        $action1->setParameter('code', 4);
        
        $action2 = new Action([$this, 'executeAction2']);
        $action2->setParameter('code', 5);
        
        $button1->href = $action1->serialize();
        $button2->href = $action2->serialize();
        
        $button1->show();
        $button2->show();
    }
    
    public function executeAction1($params) {
        echo '<br>' . json_encode($params);
    }
    
    public function executeAction2($params) {
        echo '<br>' . json_encode($params);
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=ActionButtonControlExample