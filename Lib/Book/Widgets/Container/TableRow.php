<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.3 Tables


namespace Book\Widgets\Container;

use Book\Widgets\Base\Element;

class TableRow extends Element {
    public function __construct() {
        parent::__construct('tr');
    }
    
    public function addCell($value) {
        $cell = new TableCell($value);
        parent::add($cell);
        
        return $cell;
    }
}