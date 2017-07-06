<?php
// 5 MVC Pattern
// 5.5 Presentation patterns
// 5.5.2 Template View


use Book\Control\Page;


class TwigSampleControl extends Page {
    public function __construct() {
        require_once 'Lib/Twig/Autoloader.php';
        Twig_Autoloader::register();
        
        $loader = new Twig_Loader_Filesystem('App/Resources');
        $twig = new Twig_Environment($loader);
        $template = $twig->loadTemplate('form.html');
        
        $replaces = [];
        $replaces['title'] = 'Title';
        $replaces['action'] = 'index.php?class=TwigSampleControl&method=onRecord';
        $replaces['name'] = 'John Doe';
        $replaces['address'] = 'Doe Street';
        $replaces['phone'] = '789456123';
        
        $content = $template->render($replaces);
        echo $content;
    }
    
    public function onRecord($params) {
        echo '<pre>';
        var_dump($_POST);
        echo '</pre>';
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=TwigSampleControl