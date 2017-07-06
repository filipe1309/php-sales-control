<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.2.9 Class for radio buttons


namespace Book\Widgets\Form;

class RadioButton extends Field implements FormElementInterface {
    public function show() {
        $this->tag->name = $this->name;
        $this->tag->value = $this->value;
        $this->tag->type = 'radio';
        
        if (!parent::getEditable()) {
            $this->tag->readonly = '1';
        }
        
        $this->tag->show();
    }
}
