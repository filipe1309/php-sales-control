<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.7 Dialog question


namespace Book\Widgets\Dialog;

use Book\Control\Action;
use Book\Widgets\Base\Element;

class Question {
    public function __construct($message, Action $action_yes, Action $action_no = null) {
        $div = new Element('div');
        $div->class = 'alert alert-warning';
        
        $url_yes = $action_yes->serialize();
        $link_yes = new Element('a');
        $link_yes->href = $url_yes;
        $link_yes->class = 'btn btn-success';
        $link_yes->add('Yes');
        
        $message .= '&nbsp;' . $link_yes;
        
        if ($action_no) {
            $url_no = $action_no->serialize();
            $link_no = new Element('a');
            $link_no->href = $url_no;
            $link_no->class = 'btn btn-default';
            $link_no->add('No');
            
            $message .= $link_no;
        }
        
        $div->add($message);
        $div->show();
    }
}