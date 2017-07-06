<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.3 Tables


namespace Book\Widgets\Container;

use Book\Widgets\Base\Element;

class TableCell extends Element {
    public function __construct($value) {
        parent::__construct('td');
        parent::add($value);
    }
}