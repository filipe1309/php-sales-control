<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.6 Dialog messages


namespace Book\Widgets\Dialog;

use Book\Widgets\Base\Element;

class Message {
    public function __construct($type, $message) {
        $div = new Element('div');
        if ($type == 'info') {
            $div->class = 'alert alert-info';
        } else if ($type == 'error') {
            $div->class = 'alert alert-danger';
        }
        $div->add($message);
        $div->show();
    }
}