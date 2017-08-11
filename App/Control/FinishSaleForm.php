<?php
// 7 Creating an app
// 7.4 Program
// 7.4.6 Sales register
// 7.4.6.2 Finish sale


use Book\Control\Page;
use Book\Control\Action;
use Book\Widgets\Form\Form;
use Book\Widgets\Container\Table;
use Book\Widgets\Container\VBox;
use Book\Widgets\Dialog\Message;
use Book\Widgets\Form\Label;
use Book\Widgets\Form\Entry;
use Book\Widgets\Form\Combo;
use Book\Widgets\Form\Text;
use Book\Widgets\Form\Button;
use Book\Database\Transaction;
use Book\Database\Repository;
use Book\Database\Criteria;
use Book\Session\Session;
use Book\Widgets\Wrapper\FormWrapper;
use Book\Widgets\Container\Panel;

class FinishSaleForm extends Page {
    private $form;
    
    public function __construct() {
        parent::__construct();
        new Session;
        
        $this->form = new FormWrapper(new Form('form_finish_sale'));
        
        $client = new Entry('id_client');
        $value_sale = new Entry('value_sale');
        $discount = new Entry('discount');
        $additions = new Entry('additions');
        $final_value = new Entry('final_value');
        $parts = new Combo('parts');
        $obs = new Text('obs');
        
        $parts->addItems([1 => 'One', 2 => 'Two', 3 => 'Three']);
        $parts->setValue(1);
        
        $discount->onBlur = "$('[name=final_value]').val(Number($('name=value_sale').val()) + Number($('name=additions').val()) - Number($('name=discount').val()) );";
        $additions->onBlur = $discount->onBlur;
        
        $value_sale->setEditable(FALSE);
        $final_value->setEditable(FALSE);
        
        $this->form->addField('Client', $client, 200);
        $this->form->addField('Value', $value_sale, 200);
        $this->form->addField('Discount', $discount, 200);
        $this->form->addField('Additions', $additions, 200);
        $this->form->addField('Final', $final_value, 200);
        $this->form->addField('Parts', $parts, 200);
        $this->form->addField('Obs', $obs, 200);
        $this->form->addAction('Save', new Action([$this, 'onRecordSale']));
        
        $panel = new Panel('Finish sale');
        $panel->add($this->form);
        
        parent::add($panel);
    }
    
    
    public function onLoad($param) {
        $total = 0;
        $items = Session::getValue('list');
        
        if ($items) {
            foreach ($items as $item) {
                $total += $item->price * $item->quantity;
            }
        }
        
        $data = new stdClass;
        $data->value_sale = $total;
        $data->final_value = $total;
        $this->form->setData($data);
    }
    
    public function onRecordSale() {
       try {
            Transaction::open('book');
            
            $data = $this->form->getData();
            
            $client = Person::find($data->id_client);
            if (!$client) {
                throw new Exception('Client not found');
            }
            
            if ($client->totalDebts() > 0) {
                throw new Exception('Debts found');
            }
            
            $sale = new Sale;
            $sale->client = $client;
            $sale->date_sale = date('Y-m-d');
            $sale->value_sale = $data->value_sale;
            $sale->discount = $data->discount;
            $sale->additions = $data->additions;
            $sale->final_value = $data->final_value;
            $sale->obs = $data->obs;
            
            $items = Session::getValue('list');
            if ($items) {
                 foreach ($items as $item) {
                    $sale->addItem(new Product($item->id_product), $item->quantity);
                }
            }
            
            $sale->store();
            
            Account::generateParcels($data->id_client, 2, $data->final_value, $data->parts);
            
            Transaction::close();
            Session::setValue('list', []);
            
            new Message('info', 'Success on register sale');
        } catch (Exception $e) {
            new Message('error', $e->getMessage());
        }
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/7_chapter/php-sales-control/index.php?class=SalesForm