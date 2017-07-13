<?php
// 7 Creating an app
// 7.3 Model Classes
// 7.3.1 Classes source codes
// 7.3.1.9 Account Class


use Book\Database\Record;
use Book\Database\Criteria;
use Book\Database\Repository;
use Book\Database\Filter;

class Account extends Record {
    const TABLENAME = 'account';
    private $client;
    
    public function get_client() {
        if (empty($this->client)) {
            $this->client = new Person($this->id_client);
        }
        
        return $this->client;
    }
    
    public static function getByPerson($id_person) {
        $criteria = new Criteria;
        $criteria->add(new Filter('paid', '<>', 'Y'));
        $criteria->add(new Filter('id_client', '=', $id_person));
        
        $repo = new Repository('Account');
        return $repo->load($criteria);
    }
    
    public static function debtsByPerson($id_person) {
        $total = 0;
        $accounts = self::getByPerson($id_person);
        if ($accounts) {
            foreach ($accounts as $account) {
                $total += $account->value;
            }
        }
        return $total;
    }
    
    public function generateParcels($id_client, $delay, $value, $parcels) {
        $date = DateTime(date('Y-m-d'));
        $date->add(new DateInterval('P' . $delay . 'D'));
        
        for ($n = 1; $n <= $parcels; $n++) {
            $account = new self;
            $account->id_client = $id_client;
            $account->dt_emission = date('Y-m-d');
            $account->dt_expiration = $date->format('Y-m-d');
            $account->value = $value / $parcels;
            $account->paid = 'N';
            $account->store();
            
            $date->add(new DateInterval('P1M'));
        }
    }
}