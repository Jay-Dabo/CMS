<?php

/**
 * Part of the SmartChurch Church Management System
 *
 * @package    SmartChurch
 * @version    0.1
 * @author     Ryan Dawkins
 */

/**
 * Controller_Person
 *
 * Controller to handle data for the person entity
 *
 * @package   SmartChurch
 * @author    Ryan Dawkins
 */
class Controller_Person extends Controller_Crud{
    
    /**
     * Before function to iniate the model
     * 
     * @return void
     */
    public function before() {
        parent::before();
        $this->model = new Model_Person();
    }
    
    /**
     * Create method to talk to the model that inserts the person
     * 
     * @param   string $firstName
     * @param   string $middleName
     * @param   string $lastName
     * @param   string $homeid
     * @method  POST
     * @return  void
     */
    public function post_create(){
        $firstName = Input::post('firstName');
        $middleName = Input::post('middleName');
        $lastName = Input::post('lastName');
        $homeid = Input::post('homeid');
        $this->data['response']['body'] = $this->model->create($firstName, $middleName, $lastName, $homeid);
    }
    
    /**
     * Method to get a person by a given id
     * 
     * @param   int $personid Primary key for a person
     * @method  GET
     * @return  void
     */
    public function get_get() {
        $personid = Input::get('personid');
        $this->data['response']['body'] = $this->model->get($personid);
    }
    
    /**
     * Method to handle updating a person
     * 
     * @param   int $personid
     * @param   string $firstName
     * @param   string $middleName
     * @param   string $lastName
     * @param   string $homeid
     * @method  POST
     * @return  void
     */
    public function post_update() {
        $personid = Input::post('personid');
        $firstName = Input::post('firstName');
        $middleName = Input::post('middleName');
        $lastName = Input::post('lastName');
        $homeid = Input::post('homeid');
        $this->data['response']['body'] = $this->model->update($personid, $firstName, $middleName, $lastName, $homeid);
    }
    
    /**
     * Method to handle deleting a person
     * 
     * @param   int $personid
     * @return  void
     */
    public function get_delete() {
        $personid = Input::get('personid');
        $this->data['response']['body'] = $this->model->delete($personid);
    }
    
}