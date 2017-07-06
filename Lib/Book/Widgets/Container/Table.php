<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.3 Tables


namespace Book\Widgets\Container;

use Book\Widgets\Base\Element;

class Table extends Element {
    public function __construct() {
        parent::__construct('table');
    }
    
    public function addRow() {
        $row = new TableRow;
        
        parent::add($row);
        return $row;
    }
}