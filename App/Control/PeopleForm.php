<?php
// 7 Creating an app
// 7.4 Program
// 7.4.1 Person regiter
// 7.4.1.1 Person form


use Book\Control\Page;
use Book\Control\Action;
use Book\Widgets\Form\Form;
use Book\Widgets\Dialog\Message;
use Book\Widgets\Form\Entry;
use Book\Widgets\Form\Combo;
use Book\Widgets\Form\CheckGroup;
use Book\Database\Transaction;
use Book\Widgets\Wrapper\FormWrapper;

class PeopleForm extends Page {
    private $form;
    
    public function __construct() {
        parent::__construct();
        
        $this->form = new FormWrapper(new Form('form_people'));
        
        $code = new Entry('id');
        $name = new Entry('name');
        $address = new Entry('address');
        $neighborhood = new Entry('neighborhood');
        $phone = new Entry('phone');
        $email = new Entry('email');
        $city = new Combo('id_city');
        $group = new CheckGroup('ids_groups');
        $group->setLayout('horizontal');
        
        Transaction::open('book');
        
        $cities = City::all();
        $items = [];
        foreach ($cities as $obj_city) {
            $items[$obj_city->id] = $obj_city->name;
        }
        $city->addItems($items);
        
        
        $groups = Group::all();
        $items = [];
        foreach ($groups as $obj_group) {
            $items[$obj_group->id] = $obj_group->name;
        }
        $group->addItems($items);
        
        Transaction::close();
        
        $this->form->addField('Code', $code, 40);
        $this->form->addField('Name', $name, 300);
        $this->form->addField('Address', $address, 300);
        $this->form->addField('Neighborhood', $neighborhood, 200);
        $this->form->addField('Phone', $phone, 200);
        $this->form->addField('Email', $email, 200);
        $this->form->addField('City', $city, 200);
        $this->form->addField('Group', $group, 200);
        
        $code->setEditable(FALSE);
        $code->setSize(100);
        $name->setSize(300);
        $address->setSize(300);
        
        $this->form->addAction('Save', new Action([$this, 'onSave']));
        
        parent::add($this->form);
    }
    //https://php-filipe1309.c9users.io/php_oo_3ed/7_chapter/php-sales-control/index.php?class=PeopleForm
    
    public function onSave() {
        try {
            Transaction::open('book');
            
            $data = $this->form->getData();
            $this->form->setData($data);
            
            $person = new Person;
            $person->fromArray((array) $data);
            $person->store();
            
            $person->delGroups();
            if ($data->ids_groups) {
                foreach ($data->ids_groups as $id_group) {
                    $person->addGroup(new Group($id_group));
                }
            }
            
            Transaction::close();
            new Message('info', 'Success on regiter data');
        } catch (Exception $e) {
            new Message('error', '<b>Error</b> ' . $e->getMessage());
            Transaction::rollback();
        }
    }
    //https://php-filipe1309.c9users.io/php_oo_3ed/7_chapter/php-sales-control/index.php?class=PeopleForm
    
    public function onEdit($param) {
        try {
            if (isset($param['key'])) {
                $id = $param['id'];
                Transaction::open('book');
                
                $person = Person::find($id);
                $person->ids_groups = $person->getIdsGroups();
                //var_dump($person);
                $this->form->setData($person);
                
                Transaction::close();
            }
        } catch (Exception $e) {
            new Message('error', '<b>Error</b> ' . $e->getMessage());
            Transaction::rollback();
        }
    }
    //https://php-filipe1309.c9users.io/php_oo_3ed/7_chapter/php-sales-control/index.php?class=PeopleForm&method=onEdit&key=19&id=19
}