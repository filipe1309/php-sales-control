<?php
// 7 Creating an app
// 7.4 Program
// 7.4.8 Login control
// 7.4.8.1 Login form


use Book\Control\Page;
use Book\Control\Action;
use Book\Widgets\Form\Form;
use Book\Widgets\Form\Entry;
use Book\Widgets\Form\Password;
use Book\Widgets\Form\Button;
use Book\Widgets\Wrapper\DatagridWrapper;
use Book\Widgets\Wrapper\FormWrapper;
use Book\Widgets\Container\Panel;
use Book\Session\Session;

class LoginForm extends Page {
    private $form;
    
    public function __construct() {
        parent::__construct();
        
        $this->form = new FormWrapper(new Form('form_login'));
        
        $login = new Entry('login');
        $password = new Password('password');
        
        $login->placeholder = 'admin';
        $password->placeholder = 'admin';
        
        $this->form->addField('Login', $login, 200);
        $this->form->addField('Password', $password, 200);
        $this->form->addAction('Login', new Action([$this, 'onLogin']));
        
        $panel = new Panel('Panel');
        $panel->add($this->form);
        
        parent::add($panel);
    }
    
    public function onLogin($param) {
        $data = $this->form->getData();
        if ($data->login == 'admin' AND $data->password == 'admin') {
            Session::setValue('logged', TRUE);
            echo "<script language='Javascript'> window.location = 'index.php'; </script>";
        }
    }
    
    public function onLogout($param) {
        Session::setValue('logged', FALSE);
        echo "<script language='Javascript'> window.location = 'index.php'; </script>";
    }
}