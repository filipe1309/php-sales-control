<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.3 Examples
// 6.1.3.3 Recording on database
// 6.1.3.4 Updating records


use Book\Control\Page;
use Book\Control\Action;
use Book\Database\Transaction;
use Book\Widgets\Form\Form;
use Book\Widgets\Dialog\Message;
use Book\Widgets\Form\Entry;
use Book\Widgets\Form\Combo;
use Book\Widgets\Form\CheckGroup;
use Book\Widgets\Form\RadioGroup;

class EmployeeForm extends Page {
    private $form;
    
    public function __construct() {
        parent::__construct();
        
        $this->form = new Form('form_employee');
        $this->form->setFormTitle('Create employee');
        $this->form->style = 'display:block; margin:20px;';
        
        $id = new Entry('id');
        $name = new Entry('name');
        $address = new Entry('address');
        $email = new Entry('email');
        $department = new Combo('department');
        $languages = new CheckGroup('languages');
        $hiring = new RadioGroup('hiring');
        
        $this->form->addField('Code', $id, 300);
        $this->form->addField('Name', $name, 300);
        $this->form->addField('Address', $address, 300);
        $this->form->addField('E-mail', $email, 300);
        $this->form->addField('Department', $department, 300);
        $this->form->addField('Languages', $languages, 300);
        $this->form->addField('Hiring', $hiring, 300);
        
        $id->setEditable(FALSE);
        $languages->setLayout('horizontal');
        $hiring->setLayout('horizontal');
        
        $department->addItems([
            '1' => 'HR',
            '2' => 'Attendance',
            '3' => 'Engineering',
            '4' => 'Production'
        ]);
        
        $languages->addItems([
            '1' => 'English',
            '2' => 'Spanish',
            '3' => 'German',
            '4' => 'Italian'
        ]);
        
        $hiring->addItems([
            '1' => 'Intern',
            '2' => 'Company',
            '3' => 'CLT',
            '4' => 'Partner'
        ]);
        
        $this->form->addAction('Save', new Action([$this, 'onSave']));
        $this->form->addAction('Clear', new Action([$this, 'onClear']));
        
        parent::add($this->form);
    }
    
    public function onSave() {
        try {
            Transaction::open('book');
            
            $data = $this->form->getData();
            
            if (empty($data->name)) {
                throw new Exception('Empty name');
            }
            
            $employee = new Employee;
            $employee->fromArray((array) $data);
            $employee->languages = implode(',', (array) $data->languages);
            $employee->store();
            
            $data->id = $employee->id;
            Transaction::close();
            
            $this->form->setData($data);
            
            $message = "ID: {$data->id} <br>";
            $message .= "Name: {$data->name} <br>";
            $message .= "Email: {$data->email} <br>";
            $message .= "Address: {$data->address} <br>";
            $message .= "Department: {$data->department} <br>";
            $message .= "Languages: {" . implode(',', (array) $data->languages) . "} <br>";
            $message .= "Hiring: {" . implode(',', (array) $data->hiring) . "} <br>";
            
            new Message('info', 'Success on record data ' . $message);
        } catch (Exception $e) {
            new Message('error', '<b>Error</b> ' . $e->getMessage());
        }
    }

    public function onClear() {
    }
    
    public function onEdit($param) {
        try {
            Transaction::open('book');
            
            $id = $param['id'];
            
            $employee = Employee::find($id);
            if ($employee) {
                if (isset($employee->languages)) {
                    $employee->languages = explode(',', $employee->languages);
                }
                $this->form->setData($employee);
            }
            
       
            $message = "ID: {$employee->id} <br>";
            $message .= "Name: {$employee->name} <br>";
            $message .= "Email: {$employee->email} <br>";
            $message .= "Address: {$employee->address} <br>";
            $message .= "Department: {$employee->department} <br>";
            $message .= "Languages: {" . implode(',', (array) $employee->languages) . "} <br>";
            $message .= "Hiring: {$employee->hiring} <br>";
            
            new Message('info', 'Editing ' . PHP_EOL . $message);
            
            Transaction::close();
        } catch (Exception $e) {
            new Message('error', '<b>Error</b> ' . $e->getMessage());
        }
    }
}


//https://php-filipe1309.c9users.io/php_oo_3ed/6_chapter/index.php?class=EmployeeForm
//https://php-filipe1309.c9users.io/php_oo_3ed/6_chapter/index.php?class=EmployeeForm&method=onSave
//https://php-filipe1309.c9users.io/php_oo_3ed/6_chapter/index.php?class=EmployeeForm&method=onEdit&id=2