<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.2.1 Class for labels


namespace Book\Widgets\Form;

use Book\Widgets\Base\Element;

class Label extends Field implements FormElementInterface {
    public function __construct($value) {
        $this->setValue($value);
        $this->tag = new Element('label');
    }
    
    public function add($child) {
        $this->tag->add($child);
    }
    
    public function show() {
        $this->tag->add($this->value);
        $this->tag->show();
    }
}
