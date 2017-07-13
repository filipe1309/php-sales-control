<?php
// 7 Creating an app
// 7.3 Model Classes
// 7.3.2 Testing Model Classes
// 7.3.2.1 Lazy Initialization on association


use Book\Control\Page;
use Book\Database\Transaction;

class ModelTest1 extends Page {
    public function show()
    {
        try {
            Transaction::open('book');
            
            $city1 = City::find(12);
            
            print($city1->name) . '<br>';
            print($city1->state->name) . '<br>';
            print($city1->state_name) . '<br>';
            
            $person1 = Person::find(12);
            print($person1->name) . '<br>';
            print($person1->name_city) . '<br>';
            
            Transaction::close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}