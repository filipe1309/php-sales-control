<?php
// 7 Creating an app
// 7.4 Program
// 7.4.2 Creating Traits for common actions
// 7.4.2.1 Trait to save data


namespace Book\Traits;

use Book\Database\Transaction;
use Book\Widgets\Dialog\Message;
use Exception;

trait SaveTrait {
    function onSave() {
        try {
            Transaction::open($this->connection);
            $class = $this->activeRecord;
            $data = $this->form->getData();
            
            $object = new $class;
            $object->fromArray((array) $data);
            $object->store();
            
            Transaction::close();
            new Message('info', 'Success on register data on Trait');
        } catch (Exception $e) {
            new Message('error', '<b>Error</b> ' . $e->getMessage());
            //Transaction::rollback();
        }
    }
}
