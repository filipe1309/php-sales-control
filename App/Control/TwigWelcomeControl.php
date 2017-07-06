<?php
// 5 MVC Pattern
// 5.7 Templates
// 5.7.1 Simple replaces


use Book\Control\Page;

class TwigWelcomeControl extends Page {
    public function __construct() {
        parent::__construct();
        
        require_once 'Lib/Twig/Autoloader.php';
        Twig_Autoloader::register();
        
        $loader = new Twig_Loader_Filesystem('App/Resources');
        $twig = new Twig_Environment($loader);
        $template = $twig->loadTemplate('welcome.html');
        
        $replaces = [];
        $replaces['name'] = 'John Doe';
        $replaces['street'] = 'Doe street';
        $replaces['cep'] = '77789456123';
        $replaces['phone'] = '789456123';
        
        $content = $template->render($replaces);
        echo $content;
    }
    
    public function onKnowMore($params) {
        echo 'More info';
    }
    
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=TwigWelcomeControl