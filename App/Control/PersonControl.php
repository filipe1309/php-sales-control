<?php
// 5 MVC Pattern
// 5.4 Control Patterns
// 5.4.1 Page Controller


use Book\Database\Transaction;
use Book\Database\Repository;
use Book\Database\Criteria;

class PersonControl {
    public function lista() {
        try {
            Transaction::open('livro');
            $criteria = new Criteria;
            $criteria->setProperty('order', 'id');
            
            $repository = new Repository('Person');
            $persons = $repository->load($criteria);
            if ($persons) {
                foreach ($persons as $person) {
                    print "{$person->id} - {$person->nome}<br>";
                }
            }
            Transaction::close();
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
    
    public function show($param) {
        if ($param['method'] == 'list') {
            $this->lista();
        }
    }
}