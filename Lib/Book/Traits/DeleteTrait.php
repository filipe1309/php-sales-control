<?php
// 7 Creating an app
// 7.4 Program
// 7.4.2 Creating Traits for common actions
// 7.4.2.4 Trait to delete data


namespace Book\Traits;

use Book\Control\Action;
use Book\Database\Transaction;
use Book\Widgets\Dialog\Message;
use Book\Widgets\Dialog\Question;
use Exception;

trait DeleteTrait {
    public function onDelete($param) {
        $id = $param['id'];
        $action1 = new Action([$this, 'Delete']);
        $action1->setParameter('id', $id);
        
        new Question('Would really like to delete this item?', $action1);
    }
    
    public function Delete($param) {
        try {
            $id = $param['id'];
            Transaction::open($this->connection);
            
            $class = $this->activeRecord;
            $object = $class::find($id);
            $object->delete();
            Transaction::close();
            $this->onReload();
            new Message('info', 'Success on delete item on Trait');
        } catch (Exception $e) {
            new Message('error', '<b>Error</b> ' . $e->getMessage());
            //Transaction::rollback();
        }
    }
}
