<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.8  Actions


namespace Book\Control;

class Action implements ActionInterface {
    private $action;
    private $param;
    
    public function __construct(Callable $action) {
        $this->action = $action;
    }
    
    public function setParameter($param, $value) {
        $this->param[$param] = $value;
    }
    
    public function serialize() {
        if (is_array($this->action)) {
            $url['class'] = is_object($this->action[0]) 
            ? get_class($this->action[0]) : $this->action[0];
            
            $url['method'] = $this->action[1];
            
            if ($this->param) {
                $url = array_merge($url, $this->param);
            }
            
            return '?' . http_build_query($url);
        }
    }
}