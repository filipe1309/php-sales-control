<?php
// 5 MVC Pattern
// 5.7 Templates
// 5.7.2 Replaces with loops


use Book\Control\Page;

class TwigListControl extends Page {
    public function __construct() {
        parent::__construct();
        
        require_once 'Lib/Twig/Autoloader.php';
        Twig_Autoloader::register();
        
        $loader = new Twig_Loader_Filesystem('App/Resources');
        $twig = new Twig_Environment($loader);
        $template = $twig->loadTemplate('list.html');
        
        $replaces = [];
        $replaces['title'] = 'People list';
        $replaces['people'] = [
            [
                'code' => '1',
                'name' => 'Einstein',
                'address' => '42 Street',
            ],
            [
                'code' => '2',
                'name' => 'John Doe',
                'address' => 'Doe Street',
            ],
            [
                'code' => '3',
                'name' => 'Bob Dylan',
                'address' => 'Song Street',
            ],
        ];
        
        $content = $template->render($replaces);
        echo $content;
    }
    
    public function onKnowMore($params) {
        echo 'More info';
    }
    
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=TwigListControl