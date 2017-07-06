<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.2 Classes to form fields


namespace Book\Widgets\Form;

use Book\Widgets\Base\Element;

abstract class Field implements FormElementInterface {
    protected $name;
    protected $size;
    protected $value;
    protected $editable;
    protected $tag;
    protected $formLabel;
    
    public function __construct($name) {
        self::setEditable(true);
        self::setName($name);
        self::setSize(200);
        
        $this->tag = new Element('input');
        $this->tag->class = 'field';
    }
    
    public function setProperty($name, $value) {
        $this->tag->$name = $value;
    }
    
    public function getProperty($name) {
        return $this->tag->$name;
    }
    
    public function __set($name, $value) {
        if (is_scalar($value)) {
            $this->setProperty($name, $value);
        }
    }
    
    public function __get($name) {
        $this->getProperty($name);
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function setLabel($label) {
        $this->formLabel = $label;
    }
    
    public function getLabel() {
        return $this->formLabel;
    }
    
    public function setValue($value) {
        $this->value = $value;
    }
    
    public function getValue() {
        return $this->value;
    }
    
    public function setEditable($editable) {
        $this->editable = $editable;
    }
    
    public function getEditable() {
        return $this->editable;
    }
    
    public function setSize($width, $height = NULL) {
        $this->size = $width;
    }
}