<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.2.7 Class for combos


namespace Book\Widgets\Form;

use Book\Widgets\Base\Element;

class Combo extends Field implements FormElementInterface {
    private $items;
    
    public function __construct($name) {
        parent::__construct($name);
        
        $this->tag = new Element('select');
        $this->tag->class = 'combo';
    }
    
    public function addItems($items) {
        $this->items = $items;
    }
    
    public function show() {
        $this->tag->name = $this->name;
        $this->tag->style = "width:{$this->size}px;";
        
        $option = new Element('option');
        $option->add('');
        $option->value = '0';
        
        $this->tag->add($option);
        if ($this->items) {
            foreach ($this->items as $key => $item) {
                $option = new Element('option');
                $option->value = $key;
                $option->add($item);
                
                if ($key == $this->value) {
                    $option->selected = 1;
                }
                
                $this->tag->add($option);
            }
        }
        
         if (!parent::getEditable()) {
            $this->tag->readonly = '1';
        }
        
        $this->tag->show();
    }
}
