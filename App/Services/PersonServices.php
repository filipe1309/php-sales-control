<?php
// 5 MVC Pattern
// 5.4 Control Patterns
// 5.4.3 Remote Facade
// 5.4.3.2 Remote Facade


use Book\Database\Transaction;

class PersonServices {
    function getData($id_person) {
        try {
            $person_array = [];
            Transaction::open('livro');
            $person = Person::find($id_person);
            if ($person) {
                $person_array = $person->toArray();
            } else {
                return new SoapFault('Server', "Person {$id_person} not found");
            }
            Transaction::close();
            return $person_array;
        } catch (Exception $e) {
            Transaction::rollback();
            return new SoapFault('Server', $e->getMessage());
        }
    }
}