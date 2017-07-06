<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.7 Dialog question


use Book\Control\Page;
use Book\Control\Action;
use Book\Widgets\Dialog\Question;

class QuestionControlExample extends Page {
    public function __construct() {
        parent::__construct();
        
        $action1 = new Action([$this, 'onConfirm']);
        $action2 = new Action([$this, 'onDenial']);
        new Question('Confirm action?', $action1, $action2);
    }
    
    public function onConfirm() {
        print 'You confirmed the question';
    }
    
    public function onDenial() {
        print 'You denied the question';
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=QuestionControlExample