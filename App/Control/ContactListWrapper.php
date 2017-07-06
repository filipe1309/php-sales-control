<?php
// 6 Forms and Lists
// 6.2 Lists
// 6.2.5 Datagrid Wrappers
// 6.2.5.2 Datagrid decorated example


use Book\Control\Page;
use Book\Widgets\Datagrid\Datagrid;
use Book\Widgets\Datagrid\DatagridColumn;
use Book\Widgets\Wrapper\DatagridWrapper;

class ContactListWrapper extends Page {
    private $datagrid;
    
    public function __construct() {
        parent::__construct();
        
        $this->datagrid = new DatagridWrapper(new Datagrid);
        $this->datagrid->border = 1;
        
        $code = new DatagridColumn('id', 'Code', 'center', 80);
        $name = new DatagridColumn('name', 'Name', 'left', 200);
        $email = new DatagridColumn('email', 'Email', 'left', 150);
        $subject = new DatagridColumn('subject', 'Subject', 'left', 230);
        
        $this->datagrid->addColumn($code);
        $this->datagrid->addColumn($name);
        $this->datagrid->addColumn($email);
        $this->datagrid->addColumn($subject);
        
        $this->datagrid->createModel();
        
        parent::add($this->datagrid);
    }
    
    function onReload() {
        $this->datagrid->clear();
        
        $person1 = new stdClass;
        $person1->id = 1;
        $person1->name = 'John Doe';
        $person1->email = 'john@doe.com';
        $person1->subject = 'Doe questions';
        $this->datagrid->addItem($person1);
        
        $person2 = new stdClass;
        $person2->id = 2;
        $person2->name = 'Bob Dylan';
        $person2->email = 'bob@dylN.com';
        $person2->subject = 'Bob questions';
        $this->datagrid->addItem($person2);
        
        $person3 = new stdClass;
        $person3->id = 3;
        $person3->name = 'Filipe Neozork';
        $person3->email = 'filipe@neozork.com';
        $person3->subject = 'Filipe questions';
        $this->datagrid->addItem($person3);
        
        $person4 = new stdClass;
        $person4->id = 4;
        $person4->name = 'Someone name';
        $person4->email = 'someone@name.com';
        $person4->subject = 'Someone questions';
        $this->datagrid->addItem($person4);
    }
    
    public function show() {
        $this->onReload();
        parent::show();
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/6_chapter/index.php?class=ContactListWrapper