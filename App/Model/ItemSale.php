<?php
// 7 Creating an app
// 7.3 Model Classes
// 7.3.1 Classes source codes
// 7.3.1.11 ItemSale Class


use Book\Database\Record;

class ItemSale extends Record {
    const TABLENAME = 'item_sale';
    private $product;
    
    public function set_product(Product $product) {
        $this->product = $product;
        $this->id_product = $product->id;
    }
    
    public function get_product() {
        if (empty($this->product)) {
            $this->product = new Product($this->id_product);
        }
        
        return $this->product;
    }
}
