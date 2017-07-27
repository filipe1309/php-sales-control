<?php
// 7 Creating an app
// 7.4 Program
// 7.4.1 Person regiter
// 7.4.1.2 Person list


use Book\Control\Page;
use Book\Control\Action;
use Book\Widgets\Form\Form;
use Book\Widgets\Form\Entry;
use Book\Widgets\Container\VBox;
use Book\Widgets\Datagrid\Datagrid;
use Book\Widgets\Datagrid\DatagridColumn;
use Book\Widgets\Datagrid\DatagridAction;
use Book\Widgets\Dialog\Message;
use Book\Widgets\Dialog\Question;
use Book\Widgets\Wrapper\FormWrapper;
use Book\Widgets\Wrapper\DatagridWrapper;
use Book\Database\Transaction;
use Book\Database\Repository;
use Book\Database\Criteria;
use Book\Database\Filter;

class PeopleList extends Page {
    private $form;
    private $datagrid;
    private $loaded;
    
    public function __construct() {
        parent::__construct();
        
        $this->form = new FormWrapper(new Form('form_search_people'));
        $name = new Entry('name');
        $this->form->addField('Name', $name, 300);
        $this->form->addAction('Search', new Action([$this, 'onReload']));
        $this->form->addAction('New', new Action([new PeopleForm, 'onEdit']));
        
        $this->datagrid = new DatagridWrapper(new Datagrid);
        
        $code = new DatagridColumn('id', 'Code', 'right', 50);
        $name = new DatagridColumn('name', 'Name', 'left', 200);
        $address = new DatagridColumn('address', 'Address', 'left', 200);
        $city = new DatagridColumn('name_city', 'City', 'left', 140);
        
        $this->datagrid->addColumn($code);
        $this->datagrid->addColumn($name);
        $this->datagrid->addColumn($address);
        $this->datagrid->addColumn($city);
        
        $action1 = new DatagridAction([new PeopleForm, 'onEdit']);
        $action1->setLabel('Edit');
        $action1->setImage('ico_edit.png');
        $action1->setField('id');
        
        $action2 = new DatagridAction([$this, 'onDelete']);
        $action2->setLabel('Delete');
        $action2->setImage('ico_delete.png');
        $action2->setField('id');
        
        $this->datagrid->addAction($action1);
        $this->datagrid->addAction($action2);
        
        $this->datagrid->createModel();
        
        $box = new VBox;
        $box->style = 'display:block';
        $box->add($this->form);
        $box->add($this->datagrid);
        
        parent::add($box);
    }
    
    public function onReload() {
        try {
            Transaction::open('book');
            $repository = new Repository('Person');
            
            $criteria = new Criteria;
            $criteria->setProperty('order', 'id');
            
            $data = $this->form->getData();
            if ($data->name) {
                $criteria->add(new Filter('name', 'like', "%{$data->name}%"));
            }
            
            $people = $repository->load($criteria);
            $this->datagrid->clear();
            if ($people) {
                foreach ($people as $person) {
                    $this->datagrid->addItem($person);
                }
            }
            
            Transaction::close();
            $this->loaded = true;
            //new Message('info', 'Success on register data');
        } catch (Exception $e) {
            new Message('error', '<b>Error</b> ' . $e->getMessage());
            Transaction::rollback();
        }
    }
    
    public function onDelete($param) {
        $id = $param['id'];
        $action1 = new Action([$this, 'Delete']);
        $action1->setParameter('id', $id);
        
        new Question('Would really like to delete this item?', $action1);
    }
    
    public function Delete($param) {
        try {
            $id = $param['id'];
            Transaction::open('book');
            
            $person = Person::find($id);
            $person->delete();
            Transaction::close();
            $this->onReload();
            new Message('info', 'Success on delete item');
        } catch (Exception $e) {
            new Message('error', '<b>Error</b> ' . $e->getMessage());
            //Transaction::rollback();
        }
    }
    
    public function show() {
        if (!$this->loaded) {
            $this->onReload();
        }
        parent::show();
    }
}

// https://php-filipe1309.c9users.io/php_oo_3ed/7_chapter/php-sales-control/index.php?class=PeopleList