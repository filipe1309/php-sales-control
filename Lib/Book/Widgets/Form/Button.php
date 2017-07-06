<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.2.10 Class for action button


namespace Book\Widgets\Form;

use Book\Control\Action;
use Book\Control\ActionInterface;

class Button extends Field implements FormElementInterface {
    private $action;
    private $label;
    private $formName;
    
    public function setAction(ActionInterface $action, $label) {
        $this->action = $action;
        $this->label = $label;
    }
    
    public function setFormName($name) {
        $this->formName = $name;
    }
    
    public function show() {
        $url = $this->action->serialize();
        
        $this->tag->name = $this->name;
        $this->tag->type = 'button';
        $this->tag->value = $this->label;
        
        $this->tag->onclick = "document.{$this->formName}.action='{$url}'; " .
            "document.{$this->formName}.submit()";
        
        $this->tag->show();
    }
}
