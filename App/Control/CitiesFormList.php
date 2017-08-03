<?php
// 7 Creating an app
// 7.4 Program
// 7.4.4 Cities register


use Book\Control\Page;
use Book\Control\Action;
use Book\Widgets\Form\Form;
use Book\Widgets\Form\Entry;
use Book\Widgets\Form\Combo;
use Book\Widgets\Form\Label;
use Book\Widgets\Form\Button;
use Book\Widgets\Container\VBox;
use Book\Widgets\Datagrid\Datagrid;
use Book\Widgets\Datagrid\DatagridColumn;
use Book\Widgets\Datagrid\DatagridAction;
use Book\Widgets\Dialog\Message;
use Book\Widgets\Dialog\Question;
use Book\Database\Transaction;
use Book\Database\Repository;
use Book\Traits\DeleteTrait;
use Book\Traits\ReloadTrait;
use Book\Traits\SaveTrait;
use Book\Traits\EditTrait;
use Book\Widgets\Wrapper\DatagridWrapper;
use Book\Widgets\Wrapper\FormWrapper;
use Book\Widgets\Container\Panel;

class CitiesFormList extends Page {
    private $form, $datagrid, $loaded;
    
    use EditTrait;
    use DeleteTrait;
    use ReloadTrait {
       onReload as onReloadTrait; 
    }
    use SaveTrait {
        onSave as onSaveTrait;
    }
    
    public function __construct() {
        parent::__construct();
        
        $this->connection = 'book';
        $this->activeRecord = 'City';
        
        $this->form = new FormWrapper(new Form('form_cities'));
        
        $code = new Entry('id');
        $description = new Entry('description');
        $state = new Combo('id_state');
        
        $code->setEditable(FALSE);
        
        Transaction::open('book');
        
        $states = State::all();
        $items = [];
        foreach ($states as $obj_state) {
            $items[$obj_state->id] = $obj_state->name;
        }
        
        Transaction::close();
        
        $state->addItems($items);
        
        $this->form->addField('Code', $code, 40);
        $this->form->addField('Description', $description, 300);
        $this->form->addField('State', $state, 300);
        
        $this->form->addAction('Save', new Action([$this, 'onSave']));
        $this->form->addAction('Clear', new Action([$this, 'onEdit']));
        
        $this->datagrid = new DatagridWrapper(new Datagrid);
        
        $code = new DatagridColumn('id', 'Code', 'right', 50);
        $name = new DatagridColumn('name', 'Name', 'left', 150);
        $state = new DatagridColumn('name_state', 'State', 'left', 150);
        
        $this->datagrid->addColumn($code);
        $this->datagrid->addColumn($name);
        $this->datagrid->addColumn($state);
        
        $action1 = new DatagridAction([$this, 'onEdit']);
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
        
        $panel = new Panel('Cities');
        $panel->add($this->form);
        
        $panel2 = new Panel();
        $panel2->add($this->datagrid);
        
        $box = new VBox;
        $box->style = 'display:block';
        $box->add($panel);
        $box->add($panel2);
        
        parent::add($box);
    }
    
    public function onSave() {
        $this->onSaveTrait();
        $this->onReload();
    }
    
    public function onReload() {
        $this->onReloadTrait();
        $this->loaded = true;
    }
    
    public function show() {
        if (!$this->loaded) {
            $this->onReload();
        }
        parent::show();
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/7_chapter/php-sales-control/index.php?class=CitiesFormList

