<?php
// 6 Forms and Lists
// 6.2 Lists
// 6.2.1 Datagrids classes


namespace Book\Widgets\Datagrid;

use Book\Widgets\Container\Table;
use Book\Widgets\Container\TableRow;
use Book\Widgets\Base\Element;

class Datagrid extends Table {
    private $columns;
    private $actions;
    private $rowcount;
    
    public function addColumn(DatagridColumn $object) {
        $this->columns[] = $object;
    }
    
    public function addAction(DatagridAction $object) {
        $this->actions[] = $object;
    }
    
    public function clear() {
        $copy = $this->children[0];
        
        $this->children = [];
        
        $this->children[] = $copy;
        
        $this->rowcount = 0;
    }
    
    public function createModel() {
        $thead = new Element('thead');
        parent::add($thead);
        $row = new Element('tr');
        $thead->add($row);
        
        if ($this->actions) {
            foreach ($this->actions as $action) {
                $cell = new Element('th');
                $cell->width = '40px';
                $row->add($cell);
            }
        }
        
        if ($this->columns) {
            foreach ($this->columns as $column) {
                $name = $column->getName();
                $label = $column->getLabel();
                $align = $column->getAlign();
                $width = $column->getWidth();
                
                $cell = new Element('th');
                $cell->add($label);
                $row->add($cell);
                $cell->width = $width;
                $cell->align = $align;
                
                if ($column->getAction()) {
                    $url = $column->getAction();
                    $cell->onclick = "document.location='$url'";
                }
            }
        }
    }
    
    public function addItem($object) {
        $row = parent::addRow();
        
        if ($this->actions) {
            foreach ($this->actions as $action) {
                $url = $action->serialize();
                $label = $action->getLabel();
                $image = $action->getImage();
                $field = $action->getField();
                
                $key = $object->$field;
                
                $link = new Element('a');
                $link->href = "{$url}&key={$key}&{$field}={$key}";
                
                if ($image) {
                    $img = new Element('img');
                    $img->src = "App/Images/$image";
                    $img->title = $label;
                    $link->add($img);
                } else {
                    $link->add($label);
                }
                
                $row->addCell($link);
            }
        }
        
        if ($this->columns) {
            foreach ($this->columns as $column) {
                $name = $column->getName();
                $align = $column->getAlign();
                $width = $column->getWidth();
                $function = $column->getTransformer();
                $data = $object->$name;
                
                if ($function) {
                    $data = call_user_func($function, $data);
                }
                
                $cell = $row->addCell($data);
                $cell->align = $align;
                $cell->width = $width;
            }
        }
        
        $this->rowcount ++;
    }
}