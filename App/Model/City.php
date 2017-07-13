<?php
// 7 Creating an app
// 7.3 Classes source codes
// 7.3.1.2 City Class


use Book\Database\Record;

class City extends Record {
    const TABLENAME = 'city';
	
	public function get_state()
	{
	    return new State($this->id_state);
	}
	
	public function get_state_name()
	{
	    return (new State($this->id_state))->name;
	}
}