<?php
// 7 Creating an app
// 7.3 Model Classes
// 7.3.2 Testing Model Classes
// 7.3.2.2 Aggregation between Person and Group


use Book\Control\Page;
use Book\Database\Transaction;

class ModelTest2 extends Page {
    public function show()
    {
        try {
            Transaction::open('book');
            
            $person1 = Person::find(1);
            $person1->delGroups();
            $person1->addGroup(new Group(1));
            $person1->addGroup(new Group(3));
            
            $groups = $person1->getGroups();
            
            if ($groups) {
                foreach ($groups as $group) {
                    print $group->id . ' - ';
                    print $group->name . '<br>';
                }
            }
            
            Transaction::close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/7_chapter/php-sales-control/index.php?class=ModelTest2