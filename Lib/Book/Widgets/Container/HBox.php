<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.5 Boxes


namespace Book\Widgets\Container;

use Book\Widgets\Base\Element;

class HBox extends Element {
   
    public function __construct($panel_title = null) {
        parent::__construct('div');
    }
    
    public function add($child) {
        $wrapper = new Element('div');
        $wrapper->{'style'} = 'display: inline-block;';
        $wrapper->add($child);
        parent::add($wrapper);
        return $wrapper;
    }
}