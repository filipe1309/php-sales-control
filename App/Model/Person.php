<?php
// 7 Creating an app
// 7.3 Model Classes
// 7.3.1 Classes source codes
// 7.3.1.7 Person Class


use Book\Database\Record;
use Book\Database\Criteria;
use Book\Database\Repository;
use Book\Database\Filter;

class Person extends Record
{
    const TABLENAME = 'person';
    private $city;
    
    public function get_name_city()
    {
        if (empty($this->city)) {
            $this->city = new City($this->id_city);
        }
        return $this->city->name;
    }
    
    public function addGroup(Group $group)
    {
        $personGroup = new PersonGroup;
        $personGroup->id_group = $group->id;
        $personGroup->id_person = $this->id;
        $personGroup->store();
    }
    
    public function delGroups()
    {
        $criteria = new Criteria;
        $criteria->add(new Filter('id_person', '=', $this->id));
        $repo = new Repository('PersonGroup');
        return $repo->delete($criteria);
    }
    
    public function getGroups()
    {
        $groups = [];
        $criteria = new Criteria;
        $criteria->add(new Filter('id_person', '=', $this->id));
        
        $repo = new Repository('PersonGroup');
        $links = $repo->load($criteria);
        if ($links) {
            foreach ($links as $link) {
                $groups[] = new Group($link->id_group);
            }
        }
        return $groups;
    }
    
    
    public function getIdsGroups()
    {
        $groups_ids = [];
        $groups = $this->getGroups();
        if ($groups) {
            foreach ($groups as $group) {
                $groups_ids[] = $group->id;
            }
        }
        return $groups_ids;
    }
    
    public function getOpenAccounts()
    {
        return Account::getByPerson($this->id);
    }
    
    public function totalDebts()
    {
        return Account::debtsByPerson($this->id);
    }
}
