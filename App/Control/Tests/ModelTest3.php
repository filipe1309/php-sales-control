<?php
// 7 Creating an app
// 7.3 Model Classes
// 7.3.2 Testing Model Classes
// 7.3.2.3 Composition between Sale and Items


use Book\Control\Page;
use Book\Database\Transaction;

class ModelTest3 extends Page {
    public function show()
    {
        try {
            Transaction::open('book');
            
            $sale = new Sale;
            $sale->client = new Person(3);
            $sale->date_sale = date('Y-m-d');
            $sale->value_sale = 0;
            $sale->discount = 0;
            $sale->additions = 0;
            $sale->obs = 'obs';
            
            $sale->addItem(new Product(3), 2);
            $sale->addItem(new Product(4), 1);
            
            $sale->final_value = $sale->value_sale + $sale->additions - $sale->discount;
            
            $sale->store();
            
            Transaction::close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}