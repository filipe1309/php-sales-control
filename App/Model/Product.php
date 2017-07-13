<?php
// 7 Creating an app
// 7.3 Classes source codes
// 7.3.1.12 Product Class


use Book\Database\Record;

class Product extends Record {
    const TABLENAME = 'product';
    private $manufacturer;
    
    public function get_name_manufacturer() {
        $this->manufacturer = new Manufacturer($this->id_manufacturer);
        return $this->manufacturer->name;
    }
}
