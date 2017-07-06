<?php
// 5 MVC Pattern
// 5.6 Creating components
// 5.6.3 Tables


use Book\Control\Page;
use Book\Widgets\Container\Table;

class TableControlExample extends Page {
    public function __construct() {
        parent::__construct();
        
        $data[] = [1, 'John Doe', 'http://user1.com', 1200];
        $data[] = [2, 'Bob Dylan', 'http://user2.com', 800];
        $data[] = [3, 'Elvis Presley', 'http://user3.com', 1500];
        $data[] = [3, 'Bob Marley', 'http://user32.com', 700];
        $data[] = [3, 'Steeve Wonder', 'http://user33.com', 2500];
        
        $table = new Table;
        $table->width = 600;
        $table->style = 'margin: 20px';
        
        $header = $table->addRow();
        $header->style = 'background: #a0a0a0';
        
        $header->addCell('Code');
        $header->addCell('Name');
        $header->addCell('Site');
        $header->addCell('Salary');
        
        $i = 0;
        $total = 0;
        foreach ($data as $person) {
            $bgcolor = ($i % 2) == 0 ? '#d0d0d0' : '#ffffff';
            
            $line = $table->addRow();
            $line->style = "background: $bgcolor";
            
            $line->addCell($person[0]);
            $line->addCell($person[1]);
            $line->addCell($person[2]);
            
            $salary = $line->addCell($person[3]);
            $salary->align = 'right';
            $total += $person[3];
            $i++;
        }
        $lineTotal = $table->addRow();
        $cellTotal = $lineTotal->addCell('Total');
        $cellTotal->style = 'background: whiteSmoke';
        $cellTotal->colspan = 3;
        
        $cellTotalValue = $lineTotal->addCell($total);
        $cellTotalValue->style = 'background: #fff08c; text-align: right';
        
        $table->show();
    }
}

//https://php-filipe1309.c9users.io/php_oo_3ed/5_chapter/index.php?class=TableControlExample