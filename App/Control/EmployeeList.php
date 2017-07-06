<?php
// 6 Forms and Lists
// 6.2 Lists
// 6.2.4 Examples
// 6.2.4.3 Lists with database


use Book\Control\Page;
use Book\Control\Action;
use Book\Widgets\Datagrid\Datagrid;
use Book\Widgets\Datagrid\DatagridColumn;
use Book\Widgets\Datagrid\DatagridAction;
use Book\Widgets\Dialog\Message;
use Book\Widgets\Dialog\Question;
use Book\Database\Transaction;
use Book\Database\Repository;
use Book\Database\Criteria;


class EmployeeList extends Page {
    private $datagrid;
    private $loaded;
    
    public function __construct() {
        parent::__construct();
        
        $this->datagrid = new Datagrid;
        $this->datagrid->border = 1;
        $this->datagrid->style = 'max-width: 650px';
        
        $code = new DatagridColumn('id', 'Code', 'center', 50);
        $name = new DatagridColumn('name', 'Name', 'left', 200);
        $address = new DatagridColumn('address', 'Address', 'left', 200);
        $email = new DatagridColumn('email', 'Email', 'left', 200);
        
        $this->datagrid->addColumn($code);
        $this->datagrid->addColumn($name);
        $this->datagrid->addColumn($address);
        $this->datagrid->addColumn($email);
        
        $action1 = new DatagridAction([new EmployeeForm, 'onEdit']);
        $action1->setLabel('Edit');
        $action1->setImage('icon_edit.png');
        $action1->setField('id');
        
        $action2 = new DatagridAction([$this, 'onDelete']);
        $action2->setLabel('Delete');
        $action2->setImage('icon_delete.png');
        $action2->setField('id');
        
        $this->datagrid->addAction($action1);
        $this->datagrid->addAction($action2);
        
        $this->datagrid->createModel();
        
        parent::add($this->datagrid);
    }
    
    function onReload() {
        Transaction::open('book');
        $repository = new Repository('Employee');
        
        $criteria = new Criteria;
        $criteria->setProperty('order', 'id');
        
        $employees = $repository->load($criteria);
        $this->datagrid->clear();
        if ($employees) {
            foreach ($employees as $employee) {
                $this->datagrid->addItem($employee);
            }
        }
        
        Transaction::close();
        $this->loaded = true;
        
    }
    
    function onDelete($param) {
        $id = $param['id'];
        $action1 = new Action([$this, 'Delete']);
        $action1->setParameter('id', $id);
        new Question('Do you really want to delete this register?', $action1);
    }
    
    function Delete($param) {
        try {
            $id = $param['id'];
            Transaction::open('book');
            $employee = Employee::find($id);
            if ($employee) {
                $employee->delete();
            }
            Transaction::close();
            $this->onReload();
            new Message('info', 'Success on delete register');
        } catch (Exception $e) {
            new Message('error', $e->getMessage());
        }
    }
    
    public function show() {
        if (!$this->loaded) {
            $this->onReload();
        }
        parent::show();
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/6_chapter/index.php?class=ContactList