<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.2 Images


namespace Book\Widgets\Base;

class Image extends Element {
    protected $source;
    
    public function __construct($source) {
        parent::__construct('img');
        $this->src = $source;
    }
}