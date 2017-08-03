<?php
// 7 Creating an app
// 7.4 Program
// 7.4.3 Products register
// 7.4.3.1 Products form


use Book\Control\Page;
use Book\Control\Action;
use Book\Widgets\Form\Form;
use Book\Widgets\Container\Table;
use Book\Widgets\Dialog\Message;
use Book\Widgets\Form\Label;
use Book\Widgets\Form\Entry;
use Book\Widgets\Form\Combo;
use Book\Widgets\Form\Button;
use Book\Widgets\Form\RadioGroup;
use Book\Database\Transaction;
use Book\Database\Repository;
use Book\Database\Criteria;

use Book\Widgets\Wrapper\DatagridWrapper;
use Book\Widgets\Wrapper\FormWrapper;
use Book\Widgets\Container\Panel;

use Book\Traits\SaveTrait;
use Book\Traits\EditTrait;

class ProductsForm extends Page {
    private $form;
    
    use SaveTrait;
    use EditTrait;
    
    public function __construct() {
        parent::__construct();
        
        $this->connection = 'book';
        $this->activeRecord = 'Product';
        
        $this->form = new FormWrapper(new Form('form_products'));
        
        $code = new Entry('id');
        $description = new Entry('description');
        $stock = new Entry('stock');
        $cost_price = new Entry('cost_price');
        $sale_price = new Entry('sale_price');
        $email = new Entry('email');
        $manufacturer = new Combo('id_manufacturer');
        $type_product = new RadioGroup('id_type_product');
        $unity = new Combo('id_unity');

        Transaction::open('book');
        
        $manufacturers = Manufacturer::all();
        $items = [];
        foreach ($manufacturers as $obj_manufacturer) {
            $items[$obj_manufacturer->id] = $obj_manufacturer->name;
        }
        $manufacturer->addItems($items);
        
        
        $types = TypeProduct::all();
        $items = [];
        foreach ($types as $obj_type) {
            $items[$obj_type->id] = $obj_type->name;
        }
        $type_product->addItems($items);
        
        $units = Unity::all();
        $items = [];
        foreach ($units as $obj_unity) {
            $items[$obj_unity->id] = $obj_unity->name;
        }
        $unity->addItems($items);
        
        Transaction::close();
        
        $code->setEditable(FALSE);
        
        $this->form->addField('Code', $code, 40);
        $this->form->addField('Description', $description, 300);
        $this->form->addField('Stock', $stock, 300);
        $this->form->addField('Cost_price', $cost_price, 200);
        $this->form->addField('Sale_price', $sale_price, 200);
        $this->form->addField('Manufacturer', $manufacturer, 200);
        $this->form->addField('Type', $type_product, 200);
        $this->form->addField('Unity', $unity, 200);
        $this->form->addAction('Save', new Action([$this, 'onSave']));
        
        $panel = new Panel('Products');
        $panel->add($this->form);
        
        parent::add($panel);
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/7_chapter/php-sales-control/index.php?class=ProductsForm

