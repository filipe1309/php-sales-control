<?php
// 7 Creating an app
// 7.4 Program
// 7.4.3 Products register
// 7.4.3.2 Products list


use Book\Control\Page;
use Book\Control\Action;
use Book\Widgets\Form\Form;
use Book\Widgets\Form\Entry;
use Book\Widgets\Form\Label;
use Book\Widgets\Form\Button;
use Book\Widgets\Container\Table;
use Book\Widgets\Container\VBox;
use Book\Widgets\Datagrid\Datagrid;
use Book\Widgets\Datagrid\DatagridColumn;
use Book\Widgets\Datagrid\DatagridAction;
use Book\Widgets\Dialog\Message;
use Book\Widgets\Dialog\Question;
use Book\Database\Transaction;
use Book\Database\Repository;
use Book\Database\Criteria;
use Book\Database\Filter;

use Book\Traits\DeleteTrait;
use Book\Traits\ReloadTrait;

use Book\Widgets\Wrapper\DatagridWrapper;
use Book\Widgets\Wrapper\FormWrapper;
use Book\Widgets\Container\Panel;


class ProductsList extends Page {
    private $form;
    private $datagrid;
    private $loaded;
    private $activeRecord;
    private $filter;
    
    use DeleteTrait;
    use ReloadTrait {
        onReload as onReloadTrait;
    }
    
    public function __construct() {
        parent::__construct();
        
        $this->connection = 'book';
        $this->activeRecord = 'Product';
        
        $this->form = new FormWrapper(new Form('form_search_product'));
        
        $description = new Entry('description');
        
        $this->form->addField('Description', $description, 300);
        $this->form->addAction('Search', new Action([$this, 'onReload']));
        $this->form->addAction('New', new Action([new PeopleForm, 'onEdit']));
        
        $this->datagrid = new DatagridWrapper(new Datagrid);
        
        $code = new DatagridColumn('id', 'Code', 'right', 50);
        $description = new DatagridColumn('description', 'Description', 'left', 270);
        $manufacturer = new DatagridColumn('manufacturer', 'Manufacturer', 'left', 80);
        $stock = new DatagridColumn('stock', 'Stock', 'right', 40);
        $price = new DatagridColumn('sale_price', 'Sale', 'right', 40);
        
        $this->datagrid->addColumn($code);
        $this->datagrid->addColumn($description);
        $this->datagrid->addColumn($manufacturer);
        $this->datagrid->addColumn($stock);
        $this->datagrid->addColumn($price);
        
        $obj = new ProductsForm;
        $action1 = new DatagridAction([$obj, 'onEdit']);
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
        
        $panel = new Panel('Products');
        $panel->add($this->form);
        
        $panel2 = new Panel();
        $panel2->add($this->datagrid);
        
        $box = new VBox;
        $box->style = 'display:block';
        $box->add($panel);
        $box->add($panel2);
        
        parent::add($box);
    }
    
    public function onReload() {
        $data = $this->form->getData();
        
        if ($data->description) {
            $this->filter = new Filter('description', 'like', "%{$data->description}%");
        }
        
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

// https://php-filipe1309.c9users.io/php_oo_3ed/7_chapter/php-sales-control/index.php?class=ProductsList