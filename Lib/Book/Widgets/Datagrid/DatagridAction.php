<?php
// 6 Forms and Lists
// 6.2 Lists
// 6.2.3 Datagrids actions


namespace Book\Widgets\Datagrid;

use Book\Control\Action;

class DatagridAction extends Action {
    private $image;
    private $label;
    private $field;
    
    public function setImage($image) {
        $this->image = $image;
    }
    
    public function getImage() {
        return $this->image;
    }
    
    public function setLabel($label) {
        $this->label = $label;
    }
    
    public function getLabel() {
        return $this->label;
    }
    
    public function setField($field) {
        $this->field = $field;
    }
    
    public function getField() {
        return $this->field;
    }
}
