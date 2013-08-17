<?php

/**
 * Part of the SmartChurch Church Management System
 *
 * @package    SmartChurch
 * @version    0.1
 * @author     Ryan Dawkins
 */

use Fuel\Core\Controller_Rest;

/**
 * Controller_Person
 *
 * Controller to handle data for the home entity
 *
 * @package   SmartChurch
 * @author    Ryan Dawkins
 */
class Controller_Home extends Controller_Rest{
    
    const MESSAGE_BAD_ADDRESS = 'You did not provide a proper address id and/or a homeid';
    const MESSAGE_BAD_HOMEID = 'You didn\'t provide a proper homeid.';
    const MESSAGE_BAD_ADD_PERSON = 'You didn\'t provide a proper homeid and/or personid';
    const MESSAGE_BAD_PEOPLEID = 'You didn\'t provide a proper personid';
    
    private $data;
    private $model;
    
    /**
     * Before function to iniate the model
     * 
     * @return void
     */
    public function before() {
        parent::before();
        $this->model = new Model_Home();
        $this->data = array();
    }
    
    /**
     * This method sets the return encoding and encodes the data instance to JSON.
     * 
     * @param Response $response
     * @return Response
     */
    public function after($response) {
        parent::after($response);
        $this->response->set_header('Content-Type', 'application/json');
        return $this->response(json_encode($this->data));
    }
    
    /**
     * This function allows the user to get a home by it's id.
     * 
     * @method  GET
     * @param   int $homeid primary key for the home table
     * @return  array $this->data array of persons in a home with the address id
     */
    public function get_get() {
        $homeid = Input::get('homeid');
        if($homeid != null) {
            $this->data['response']['body'] = $this->model->getMembers($homeid);
        } else {
            $this->data['respose']['body'] = self::MESSAGE_BAD_HOMEID;
        }
    }
    
    /**
     * Function to create a new home by a given personid
     * 
     * @method  POST
     * @param   int $personid primary key for person table
     * @return  array $this->data of primary key
     */
    public function post_create() {
        $personid = Input::post('personid');
        if($personid != null) {
            $this->data['response']['body'] = $this->model->create($personid);
        } else {
            $this->data['response']['body'] = self::MESSAGE_BAD_PEOPLEID;
        }
    }
    
    /**
     * Function to add a person to a home by a given personid
     * 
     * @method  POST
     * @param   int $homeid primary key for home table
     * @param   int $personid primary key for person table
     * @return  array $this->data of new updated row
     */
    public function post_person() {
        $homeid = Input::post('homeid');
        $personid = Input::post('personid');
        if($homeid != null && $personid != null) {
            $this->data['response']['body'] = $this->model->addPerson($homeid, $personid);
        } else {
            $this->data['response']['body'] = self::MESSAGE_BAD_ADD_PERSON;
        }
    }
    
    /**
     * Function to modify the address column of a home row.
     * 
     * @method  POST
     * @param   int $homeid primary key of home table
     * @param   int $addressid primary key of address table
     * @return  array $this->data array of address data
     */
    public function post_address() {
        $homeid = Input::post('homeid');
        $addressid = Input::post('addressid');
        if($homeid != null && $addressid != null) {
            $this->data['response']['body'] = $this->model->addAddress($homeid, $addressid);
        } else {
            $this->data['response']['body'] = self::MESSAGE_BAD_ADDRESS;
        }
    }
    
    /**
     * Function to delete a home and all household members.
     * 
     * @method  GET
     * @param   int $homeid primary key for a home
     * @return  string $this->data will say successfully deleted
     */
    public function get_delete() {
        $homeid = Input::get('homeid');
        if($homeid != null) {
            $this->data['response']['body'] = $this->model->delete($homeid);
        } else {
            $this->data['response']['body'] = self::MESSAGE_BAD_HOMEID;
        }
    }
}