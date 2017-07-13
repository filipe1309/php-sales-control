<?php
// 7 Creating an app
// 7.3 Model Classes
// 7.3.2 Testing Model Classes
// 7.3.2.4 Coesion and Responsability


use Book\Control\Page;
use Book\Database\Transaction;

class ModelTest4 extends Page {
    public function show()
    {
        try {
            Transaction::open('book');
            
            $person1 = Person::find(1);
            print 'Total value: ' . $person1->totalDebts() . '<br>';
            echo '<hr>';
            
            $accounts = $person1->getOpenAccounts();
            if ($accounts) {
                foreach ($accounts as $account) {
                    print $account->dt_emission . ' - ';
                    print $account->dt_expiration . ' - ';
                    print $account->value . '<br>';
                }
            }
            
            Transaction::close();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}