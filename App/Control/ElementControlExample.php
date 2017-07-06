<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.1 HTML Elements


use Book\Control\Page;
use Book\Widgets\Base\Element;

class ElementControlExample extends Page {
    public function __construct() {
        parent::__construct();
        
        $div = new Element('div');
        $div->style = 'text-align: center;';
        $div->style .= 'font-weight: bold;';
        $div->style .= 'font-size: 14pt;';
        
        $p = new Element('p');
        $p->add('Clube Atlético Paranaense');
        $div->add($p);
        
        $img = new Element('img');
        $img->src = 'App/Images/logo_cap.png';
        $div->add($img);
        
        $p = new Element('p');
        $p->add('Furacão da baixada');
        $div->add($p);
        
        parent::add($div);
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=ElementControlExample