<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.2.6 Class for long texts


namespace Book\Widgets\Form;

use Book\Widgets\Base\Element;

class Text extends Field implements FormElementInterface {
    private $width;
    private $height;
    
    public function __construct($name) {
        parent::__construct($name);
        $this->tag = new Element('textarea');
        $this->tag->class = 'field';
        
        $this->height = 100;
    }
    
    public function setSize($width, $height = NULL) {
        $this->size = $width;
        if (isset($height)) {
            $this->height = $height;
        }
    }
    
    public function show() {
        $this->tag->name = $this->name;
        $this->tag->style = "width:{$this->size};height:{$this->height}";
        
        if (!parent::getEditable()) {
            $this->tag->readonly = '1';
        }
        
        $this->tag->add(htmlspecialchars($this->value));
        
        $this->tag->show();
    }
}
