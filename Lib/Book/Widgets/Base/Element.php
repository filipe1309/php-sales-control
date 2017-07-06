<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.1 HTML Elements


namespace Book\Widgets\Base;

class Element {
    protected $tagName;
    protected $properties;
    protected $children;
    
    public function __construct($name) {
        $this->tagName = $name;
    }
    
    public function __set($name, $value) {
        $this->properties[$name] = $value;
    }
    
    public function __get($name) {
        return isset($this->properties[$name]) ? $this->properties[$name] : NULL;
    }
    
    public function add($child) {
        $this->children[] = $child;
    }
    
    public function show() {
        $this->open();
        echo "\n";
        if ($this->children) {
            foreach ($this->children as $child) {
                if (is_object($child)) {
                    $child->show();
                } else if (is_string($child) or is_numeric($child)) {
                    echo $child;
                }
            }
        }
        $this->close();
    }
    
    private function open() {
        echo "<{$this->tagName}";
        if ($this->properties) {
            foreach ($this->properties as $name => $value) {
                if (is_scalar($value)) {
                    echo " {$name}=\"{$value}\"";
                }
            }
        }
        echo '>';
    }
    
    private function close() {
        echo "</{$this->tagName}>\n";
    }
    
    public function __toString() {
        ob_start();
        $this->show();
        $content = ob_get_clean();
        return $content;
    }
}