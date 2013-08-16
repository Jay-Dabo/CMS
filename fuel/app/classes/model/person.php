<?php

/**
 * Part of the SmartChurch Church Management System
 *
 * @package    SmartChurch
 * @version    0.1
 * @author     Ryan Dawkins
 */

/**
 * Model_Person
 *
 * Model to handle data for the person entity
 *
 * @package   SmartChurch
 * @author    Ryan Dawkins
 */
class Model_Person extends Model_Crud {
    
    const TABLE = 'person';
    const COLUMN_PRIMARY_KEY = 'personid';
    const COLUMN_FIRST_NAME = 'firstName';
    const COLUMN_MIDDLE_INITIAL = 'middleInitial';
    const COLUMN_LAST_NAME = 'lastName';
    const COLUMN_HOME_ID = 'homeid';
    
    /**
     * Method to insert a person
     * 
     * @param   string $firstName
     * @param   string $middleInitial
     * @param   string $lastName
     * @param   int $homeid
     * @return  array
     */
    public function create($firstName, $middleInitial, $lastName, $homeid){
        return DB::insert(self::TABLE)->set(array(
            self::COLUMN_FIRST_NAME => $firstName,
            self::COLUMN_MIDDLE_INITIAL => $middleInitial,
            self::COLUMN_LAST_NAME => $lastName,
            self::COLUMN_HOME_ID => $homeid
        ))->execute();
    }
    
    /**
     * Method to get a person by a given id
     * 
     * @param   type $personid
     * @return  array $this->data[0]
     */
    public function get($personid) {
        $result = DB::select('*')->from(self::TABLE)->where(self::PRIMARY_KEY, $personid)->execute();
        $count = 0;
        foreach($result as $i) {
            $this->data[$count] = $i;
        }
        if(isset($this->data[0])) {
            return $this->data[0];
        } else {
            return null;
        }
    }
    
    /**
     * Method to update a person by a given id
     * 
     * @param   int $personid
     * @param   string $firstName
     * @param   string $middleInitial
     * @param   string $lastName
     * @param   int $homeid
     * @return  array
     */
    public function update($personid, $firstName, $middleInitial, $lastName, $homeid) {
        return DB::update(self::TABLE)->set(array(
            self::COLUMN_FIRST_NAME => $firstName,
            self::COLUMN_MIDDLE_INITIAL => $middleInitial,
            self::COLUMN_LAST_NAME => $lastName,
            self::COLUMN_HOME_ID => $homeid
        ))->where(self::COLUMN_PRIMARY_KEY, $personid)->execute();
    }
    
    /**
     * Method to delete a person by a given id
     * 
     * @param   int $personid
     * @return  array
     */
    public function delete($personid) {
        return DB::delete(self::TABLE)->where(self::COLUMN_PRIMARY_KEY, $personid)->execute();
    }
    
}