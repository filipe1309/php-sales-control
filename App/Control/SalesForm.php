<?php
// 7 Creating an app
// 7.4 Program
// 7.4.6 Sales register
// 7.4.6.1 Item sales register


use Book\Control\Page;
use Book\Control\Action;
use Book\Widgets\Form\Form;
use Book\Widgets\Container\VBox;
use Book\Widgets\Datagrid\Datagrid;
use Book\Widgets\Datagrid\DatagridColumn;
use Book\Widgets\Datagrid\DatagridAction;
use Book\Widgets\Form\Label;
use Book\Widgets\Form\Entry;
use Book\Widgets\Form\Button;
use Book\Database\Transaction;
use Book\Database\Repository;
use Book\Database\Criteria;
use Book\Session\Session;
use Book\Widgets\Wrapper\DatagridWrapper;
use Book\Widgets\Wrapper\FormWrapper;
use Book\Widgets\Container\Panel;

class SalesForm extends Page {
    private $form;
    private $datagrid;
    private $loaded;
    
    public function __construct() {
        parent::__construct();
        new Session;
        
        $this->form = new FormWrapper(new Form('form_sales'));
        
        $code = new Entry('id_product');
        $quantity = new Entry('quantity');
        $this->form->addField('Code', $code, 100);
        $this->form->addField('Quantity', $quantity, 200);
        $this->form->addAction('Add', new Action([$this, 'onAdd']));
        $this->form->addAction('Finish', new Action([new FinishSaleForm, 'onLoad']));
        
        $this->datagrid = new DatagridWrapper(new Datagrid);
        
        $code = new DatagridColumn('id_product', 'Code', 'right', 50);
        $description = new DatagridColumn('description', 'Description', 'left', 200);
        $quantity = new DatagridColumn('quantity', 'Qtde', 'right', 40);
        $price = new DatagridColumn('price', 'Price', 'right', 70);
        
        $price->setTransformer([$this, 'format_money']);
        
        $this->datagrid->addColumn($code);
        $this->datagrid->addColumn($description);
        $this->datagrid->addColumn($quantity);
        $this->datagrid->addColumn($price);
        
        $action = new DatagridAction([$this, 'onDelete']);
        $action->setLabel('Delete');
        $action->setImage('ico_delete.png');
        $action->setField('id_product');
        
        $this->datagrid->addAction($action);
        
        $this->datagrid->createModel();
        
        $panel1 = new Panel('Sales');
        $panel1->add($this->form);
        
        $panel2 = new Panel();
        $panel2->add($this->datagrid);
        
        $box = new VBox;
        $box->style = 'display:block';
        $box->add($panel1);
        $box->add($panel2);
        
        parent::add($box);
    }
    
    public function onAdd() {
        try {
            $item = $this->form->getData();
            
            Transaction::open('book');
            $product = Product::find($item->id_product);
            if ($product) {
                $item->description = $product->description;
                $item->price = $product->sale_price;
                
                $list = Session::getValue('list');
                $list[$item->id_product] = $item;
                Session::setValue('list', $list);
            }
            Transaction::close('book');
        } catch (Exception $e) {
            new Message('error', $e->getMessage());
        }
        
        $this->onReload();
    }
    
    
    public function onDelete($param) {
        $list = Session::getValue('list');
        
        unset($list[$param['id_product']]);
        
        Session::setValue('list', $list);
        
        $this->onReload();
    }
    
    public function onReload() {
        $list = Session::getValue('list');
        
        $this->datagrid->clear();
        if ($list) {
            foreach ($list as $item) {
                $this->datagrid->addItem($item);
            }
        }
        $this->loaded = true;
    }
    
    public function format_money($value) {
        return number_format($value, 2, ',', '.');
    }
    
    public function show() {
        if (!$this->loaded) {
            $this->onReload();
        }
        parent::show();
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/7_chapter/php-sales-control/index.php?class=SalesForm