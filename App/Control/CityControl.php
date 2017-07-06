<?php
// 5 MVC Pattern
// 5.4 Control Patterns
// 5.4.2 Front Controller


use Book\Control\Page;
use Book\Database\Transaction;
use Book\Database\Repository;
use Book\Database\Criteria;

class CityControl extends Page {
    public function lista() {
        try {
            Transaction::open('livro');
            $criteria = new Criteria;
            $criteria->setProperty('order', 'id');
            
            $repository = new Repository('City');
            $cities = $repository->load($criteria);
            if ($cities) {
                foreach ($cities as $city) {
                    print "{$city->id} - {$city->nome}<br>";
                }
            }
            Transaction::close();
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=CityControl&method=listar
