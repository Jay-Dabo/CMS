<?php

/**
 * Part of the SmartChurch Church Management System
 *
 * @package    SmartChurch
 * @version    0.1
 * @author     Ryan Dawkins
 */
use Fuel\Core\Model;

/**
 * Model_Person
 *
 * Model to handle data for the person entity
 *
 * @package   SmartChurch
 * @author    Ryan Dawkins
 */
class Model_Home extends Model {

    /**
     * Inserts a household and assigns the person entity a homeid
     * 
     * @param   int $personid
     * @return  array $data array of rows in a household
     */
    public function create($personid) {
        $result = DB::insert('home')->set(array(
                    'addressid' => null
                ))->execute();
        if (isset($result[0])) {
            DB::update('person')->set(array(
                'homeid' => $result[0]
            ))->where('personid', $personid)->execute();
            return $this->getMembers($homeid);
        } else {
            return null;
        }
    }

    /**
     * Gets all members of a home by a given homeid
     * 
     * @param   int $homeid
     * @return  array $data rows that have the same homeid
     */
    public function getMembers($homeid) {
        $query = DB::select(DB::expr('person.homeid, home.addressid, person.personid, person.firstName, person.middleName, person.lastName, person.gender, person.maritalStatus, person.birth'))
                ->from(DB::expr('home, person'))
                ->where(DB::expr('home.homeid'), DB::expr('person.homeid'))
                ->and_where(DB::expr('person.homeid'), $homeid);
        $data = array();
        foreach ($query->execute() as $i) {
            $data[] = $i;
        }
        return $data;
    }

    /**
     * Changes personid's homeid column value to the given homeid
     * 
     * @param   int $homeid
     * @param   int $personid
     * @return  int $personid
     */
    public function addPerson($homeid, $personid) {
        $result = DB::update('person')->set(array(
            'homeid' => $homeid
        ))->where('personid', $personid)->execute();
        if(isset($result[0])) {
            return $result[0];
        } else {
            return null;
        }
    }
    
    /**
     * Changes address value by a given homeid
     * 
     * @param   type $homeid
     * @param   type $addressid
     * @return  int $result[0] returns homeid of row affected
     */
    public function addAddress($homeid, $addressid) {
        $result = DB::update('home')->set(array(
            'addressid' => $addressid
        ))->where('home', $homeid)->execute();
        if(isset($result[0])) {
            return $result[0];
        } else {
            return null;
        }
    }
    
    /**
     * Deletes a home row by a given id
     * 
     * @param   int $homeid primary key for home table
     * @return  int $homeid primary key of row deleted
     */
    public function delete($homeid) {
        DB::delete('home')->where('homeid', $homeid)->execute();
        return $homeid;
    }
    
}
