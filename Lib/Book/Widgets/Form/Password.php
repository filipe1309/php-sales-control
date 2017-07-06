<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.2.3 Class for password field


namespace Book\Widgets\Form;

class Password extends Field implements FormElementInterface {
    public function show() {
        $this->tag->name = $this->name;
        $this->tag->value = $this->value;
        $this->tag->type = 'password';
        $this->tag->style = "width:{$this->size}px";
        
        if (!parent::getEditable()) {
            $this->tag->readonly = '1';
        }
        
        $this->tag->show();
    }
}
