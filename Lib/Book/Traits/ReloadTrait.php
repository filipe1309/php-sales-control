<?php
// 7 Creating an app
// 7.4 Program
// 7.4.2 Creating Traits for common actions
// 7.4.2.3 Trait to load data


namespace Book\Traits;

use Book\Database\Transaction;
use Book\Database\Repository;
use Book\Database\Criteria;
use Book\Widgets\Dialog\Message;
use Exception;

trait ReloadTrait {
    public function onReload() {
        try {
            Transaction::open($this->connection);
            $repository = new Repository($this->activeRecord);
            
            $criteria = new Criteria;
            $criteria->setProperty('order', 'id');
            
            if (isset($this->filter)) {
                $criteria->add($this->filter);
            }
            
            $objects = $repository->load($criteria);
            $this->datagrid->clear();
            if ($objects) {
                foreach ($objects as $object) {
                    $this->datagrid->addItem($object);
                }
            }
            
            Transaction::close();
            //new Message('info', 'Success on register data');
        } catch (Exception $e) {
            new Message('error', '<b>Error</b> ' . $e->getMessage());
            //Transaction::rollback();
        }
    }
}
