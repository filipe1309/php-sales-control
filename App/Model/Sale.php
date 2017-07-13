<?php
// 7 Creating an app
// 7.3 Model Classes
// 7.3.1 Classes source codes
// 7.3.1.10 Sale Class


use Book\Database\Record;
use Book\Database\Criteria;
use Book\Database\Repository;
use Book\Database\Filter;

class Sale extends Record {
    const TABLENAME = 'sale';
    private $items;
    private $client;
    
    public function set_client(Person $client) {
        $this->client = $client;
        $this->id_client = $client->id;
    }
    
    public function get_client() {
        if (empty($this->client)) {
            $this->client = new Person($this->id_client);
        }
        
        return $this->client;
    }
    
    public function addItem(Product $product, $quantity) {
        $item = new ItemSale;
        $item->product = $product;
        $item->price = $product->sale_price;
        $item->quantity = $quantity;
        
        $this->items[] = $item;
        $this->value_sale += ($item->price * $quantity); 
    }
    
    public function store() {
        parent::store();
        foreach ($this->items as $item) {
            $item->id_sale = $this->id;
            $item->store();
        }
    }
    
    public function get_items() {
        $repository = new Repository('ItemSale');
        $criteria = new Criteria;
        $criteria->add(new Filter('id_sale', '=', $this->id));
        $this->items = $repository->load($criteria);
        return $this->items;
    }
}