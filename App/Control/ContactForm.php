<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.1.3 Examples
// 6.1.3.1 Send test
// 6.1.3.2 Pre-defined form values


use Book\Control\Page;
use Book\Control\Action;
use Book\Widgets\Form\Form;
use Book\Widgets\Dialog\Message;
use Book\Widgets\Form\Label;
use Book\Widgets\Form\Entry;
use Book\Widgets\Form\Combo;
use Book\Widgets\Form\Text;

class ContactForm extends Page {
    private $form;
    
    public function __construct() {
        parent::__construct();
        
        $this->form = new Form('form_contact');
        $this->form->setFormTitle('Contact Form');
        $this->form->style = 'display:block; margin:20px;';
        
        $name = new Entry('name');
        $email = new Entry('email');
        $subject = new Combo('subject');
        $message = new Text('message');
        
        $this->form->addField('Name', $name, 300);
        $this->form->addField('E-mail', $email, 300);
        $this->form->addField('Subject', $subject, 300);
        $this->form->addField('Message', $message, 300);
        
        $subject->addItems([
            '1' => 'Suggestion',
            '2' => 'Complaint',
            '3' => 'Technical support',
            '4' => 'Charge',
            '5' => 'Other',
        ]);
        
        $message->setSize(300, 80);
        
        $this->form->addAction('Send', new Action([$this, 'onSend']));
        
        parent::add($this->form);
    }
    
    public function onSend() {
        try {
            $data = $this->form->getData();
            $this->form->setData($data);
            
            if (empty($data->email)) {
                throw new Exception('Empty email');
            }
            
            if (empty($data->subject)) {
                throw new Exception('Empty subject');
            }
            
            $message = "Name: {$data->name} <br>";
            $message .= "Email: {$data->email} <br>";
            $message .= "Subject: {$data->subject} <br>";
            $message .= "Message: {$data->message} <br>";
            
            new Message('info', $message);
        } catch (Exception $e) {
            new Message('error', '<b>Error</b> ' . $e->getMessage());
        }
    }

    public function onLoad() {
        $obj = new stdClass;
        $obj->message = 'Write here the contact motivation. Be clear...';
        $this->form->setData($obj);
    }
}


//https://php-filipe1309.c9users.io/php_oo_3ed/6_chapter/index.php?class=ContactForm
//https://php-filipe1309.c9users.io/php_oo_3ed/6_chapter/index.php?class=ContactForm&method=onSend
//https://php-filipe1309.c9users.io/php_oo_3ed/6_chapter/index.php?class=ContactForm&method=onLoad
