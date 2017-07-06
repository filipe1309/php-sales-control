<?php
// 6 Forms and Lists
// 6.1 Forms
// 6.2.5 Datagrid Wrappers
// 6.2.5.1 Datagrid Wrappers with Decorator Pattern


namespace Book\Widgets\Wrapper;

use Book\Widgets\Datagrid\Datagrid;

class DatagridWrapper {
    private $decorated;
    
    public function __construct(Datagrid $datagrid) {
        $this->decorated = $datagrid;
        $this->decorated->class = 'table table-striped table-hover';
    }
    
    public function __call($method, $parameters) {
        return call_user_func_array([$this->decorated, $method], $parameters);
    }
    
    public function __set($attribute, $value) {
        $this->decorated->$attribute = $value;
    }
}