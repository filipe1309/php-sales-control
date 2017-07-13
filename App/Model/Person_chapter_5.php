<?php
use Book\Database\Record;

class Person extends Record
{
    const TABLENAME = 'pessoa';
    private $city;
    
    /**
     * Retorna o nome da city.
     * Executado sempre se for acessada a propriedade "->nome_city"
     */
    function get_name_city()
    {
        if (empty($this->city))
            $this->city = new City($this->id_city);
        
        return $this->city->name;
    }
    
    /**
     * Retorna o total em débitos
     */
    function totalDebitos()
    {
        return Conta::debitosPorPessoa($this->id);
    }
}
