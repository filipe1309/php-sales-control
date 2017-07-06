<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.2.5 Class for hidden field


namespace Book\Widgets\Form;

class Hidden extends Field implements FormElementInterface {
    public function show() {
        $this->tag->name = $this->name;
        $this->tag->value = $this->value;
        $this->tag->type = 'hidden';
        $this->tag->style = "width:{$this->size}px";
        
        $this->tag->show();
    }
}
