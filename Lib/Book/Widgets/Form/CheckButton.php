<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.2.8 Class for check buttons


namespace Book\Widgets\Form;

class CheckButton extends Field implements FormElementInterface {
    public function show() {
        $this->tag->name = $this->name;
        $this->tag->value = $this->value;
        $this->tag->type = 'checkbox';
        
        if (!parent::getEditable()) {
            $this->tag->readonly = '1';
        }
        
        $this->tag->show();
    }
}
