<?php
// 5 MVC Pattern
// 5.5 Presentation patterns
// 5.5.1 Components


use Book\Control\Page;
use Book\Widgets\Form\SimpleForm;

class SimpleFormControl extends Page {
    public function __construct() {
        //parent::__contruct();
        
        $form = new SimpleForm('my_form');
        $form->setTitle('Title');
        $form->addField('Name', 'name', 'text', 'John', 'form-control');
        $form->addField('Address', 'address', 'text', 'John Street', 'form-control');
        $form->addField('Phone', 'phone', 'text', '123456789', 'form-control');
        $form->setAction('index.php?class=SimpleFormControl&method=onRecord');
        $form->show();
    }
    
    public function onRecord($params) {
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=SimpleFormControl&method=onRecord