<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.4 Panels


namespace Book\Widgets\Container;

use Book\Widgets\Base\Element;

class Panel extends Element {
    private $body;
    
    public function __construct($panel_title = null) {
        parent::__construct('div');
        $this->class = 'panel panel-default';
        if ($panel_title) {
            $head = new Element('div');
            $head->class = 'panel-heading';
            $label = new Element('h4');
            $label->add($panel_title);
            $title = new Element('div');
            $title->class = 'panel-title';
            $title->add($label);
            $head->add($title);
            parent::add($head);
        }
        
        $this->body = new Element('div');
        $this->body->class = 'panel-body';
        parent::add($this->body);
    }
    
    public function add($content) {
        $this->body->add($content);
    }
}