<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.2.8 Class for check buttons


namespace Book\Widgets\Form;

use Book\Widgets\Base\Element;

class CheckGroup extends Field implements FormElementInterface {
    private $layout = 'vertical';
    private $items;
    
    public function setLayout($dir) {
        $this->layout = $dir;
    }
    
    public function addItems($items) {
        $this->items = $items;
    }
    
    public function show() {
        if ($this->items) {
            foreach ($this->items as $index => $label) {
                $button = new CheckButton("{$this->name}[]");
                $button->setValue($index);
                
                if (in_array($index, (array) $this->value)) {
                    $button->setProperty('checked', '1');
                }
                
                $obj = new Label($label);
                $obj->add($button);
                $obj->show();
                if ($this->layout == 'vertical') {
                    $br = new Element('br');
                    $br->show();
                    echo "\n";
                }
            }
        }
    }
}
