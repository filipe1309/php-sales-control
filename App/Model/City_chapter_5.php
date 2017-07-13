<?php
// 5 MVC Pattern
// 5.2 Namespace and directores organization


use Book\Database\Record;

class City extends Record {
    const TABLENAME = 'cidade';
	
	public function get_state()
	{
	    return (new State($this->id_estado))->nome;
	}
}