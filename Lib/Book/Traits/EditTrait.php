<?php
// 7 Creating an app
// 7.4 Program
// 7.4.2 Creating Traits for common actions
// 7.4.2.2 Trait to edit data


namespace Book\Traits;

use Book\Database\Transaction;
use Book\Widgets\Dialog\Message;
use Exception;

trait EditTrait {
    public function onEdit($param) {
        try {
            if (isset($param['id'])) {
                $id = $param['id'];
                Transaction::open($this->connection);
                
                $class = $this->activeRecord;
                $object = $class::find($id);
                $this->form->setData($object);
                
                Transaction::close();
            }
        } catch (Exception $e) {
            new Message('error', '<b>Error</b> ' . $e->getMessage());
            Transaction::rollback();
        }
    }
}
