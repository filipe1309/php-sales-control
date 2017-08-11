<?php
// 7 Creating an app
// 7.4 Program
// 7.4.7 Accounts report


use Book\Control\Page;
use Book\Control\Action;
use Book\Widgets\Form\Form;
use Book\Widgets\Form\Entry;
use Book\Widgets\Dialog\Message;
use Book\Database\Transaction;
use Book\Database\Repository;
use Book\Database\Criteria;
use Book\Database\Filter;
use Book\Widgets\Wrapper\FormWrapper;
use Book\Widgets\Container\Panel;

class AccountsReport extends Page {
    private $form;
    
    public function __construct() {
        parent::__construct();
        
        $this->form = new FormWrapper(new Form('form_accounts_report'));
        
        $date_ini = new Entry('date_ini');
        $date_end = new Entry('date_end');
        
        $this->form->addField('Initial Maturity', $date_ini, 200);
        $this->form->addField('End Maturity', $date_end, 200);
        $this->form->addAction('Generate', new Action([$this, 'onGenerate']));
        
        $panel = new Panel('Accounts Report');
        $panel->add($this->form);
        
        parent::add($panel);
    }
    
    public function onGenerate() {
        require_once 'Lib/Twig/Autoloader.php';
        Twig_Autoloader::register();
        
        $loader = new Twig_Loader_Filesystem('App/Resources');
        $twig = new Twig_Environment($loader);
        $template = $twig->loadTemplate('accounts_report.html');
        
        $data = $this->form->getData();
        $this->form->setData($data);
        
        $conv_date_to_us = function($date) {
            $day = substr($date, 0, 2);
            $month = substr($date, 3, 2);
            $year = substr($date, 6, 4);
            return "{$year}-{$month}-{$day}";
        };
        
        $date_ini = $conv_date_to_us($data->date_ini);
        $date_end = $conv_date_to_us($data->date_end);
        
        $replaces = [];
        $replaces['date_ini'] = $data->date_ini;
        $replaces['date_end'] = $data->date_end;
        
         try {
            Transaction::open('book');
            $repository = new Repository('Account');
            
            $criteria = new Criteria;
            $criteria->setProperty('order', 'dt_expiration');
            
            if ($data->date_ini) {
                $criteria->add(new Filter('dt_expiration', '>=', $date_ini));
            }
            
            if ($data->date_end) {
                $criteria->add(new Filter('dt_expiration', '<=', $date_end));
            }
            
            $accounts = $repository->load($criteria);
            if ($accounts) {
                foreach ($accounts as $account) {
                    $account_array = $account->toArray();
                    $account_array['name_client'] = $account->client->name;
                    $replaces['accounts'][] = $account_array;
                }
            }
            
            Transaction::close();
         } catch (Exception $e) {
            new Message('error', $e->getMessage());
            Transaction::rollback();
         }
         $content = $template->render($replaces);
         $parent::add($content);
    }
}