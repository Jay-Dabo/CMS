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
 * Controller_Address
 *
 * Controller to handle data for the address entity
 *
 * @package   SmartChurch
 * @author    Ryan Dawkins
 */
class Controller_Address extends Controller_Rest{
    
    private $data;
    private $model;
    
    /**
     * Before function to iniate the model and data array
     * 
     * @return  void
     */
    public function before() {
        parent::before();
        $this->data = array();
        $this->model = new Model_Address();
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
     * This function creates an address and returns an address id, if given a 
     * homeid it will attach it to the given home.
     * 
     * @method  POST
     * @param   int $homeid If homeid is sent as well, it will automatically add the address to the home
     * @param   string $address1 Typically a street address
     * @param   string $address2 Secondary information, apt num etc.
     * @param   string $city
     * @param   string $state Or province
     * @param   string $zipcode typically 7-9 digits, up to 32 digits in some countries
     * @return  array $this->data
     */
    public function post_create() {
        $homeid = Input::post('homeid');
        $address1 = Input::post('address1');
        $address2 = Input::post('address2');
        $city = Input::post('city');
        $state = Input::post('state');
        $zipcode = Input::post('zipcode');
        $addressid = $this->model->create($address1, $address2, $city, $state, $zipcode);
        if($homeid != null) {
            $modelHome = new Model_Home();
            $modelHome->addAddress($homeid, $addressid);
        }
        $this->data['response']['body'] = $addressid;
    }
    
    /**
     * Allows updating of different address entities
     * 
     * @method  POST
     * @param   string $address1 Typically a street address
     * @param   string $address2 Secondary information, apt num etc.
     * @param   string $city
     * @param   string $state Or province
     * @param   string $zipcode typically 7-9 digits, up to 32 digits in some countries
     * @return  array $this->data
     */
    public function post_update() {
        $addressid = Input::post('addressid');
        $address1 = Input::post('address1');
        $address2 = Input::post('address2');
        $city = Input::post('city');
        $state = Input::post('state');
        $zipcode = Input::post('zipcode');
        $this->data['response']['body'] = $this->model->update($addressid, $address1, $address2, $city, $state, $zipcode);
    }
    
    /**
     * Removes addressid from affected homeid row and deletes the address row
     * 
     * @method  GET
     * @param   int $addressid
     * @return  array $this->data
     */
    public function get_delete() {
        $addressid = Input::get('addressid');
        $this->data['response']['body'] = $this->model->delete($addressid);
    }
    
    /**
     * Returns address row by the primary key addressid
     * 
     * @method  GET
     * @param   int $addressid
     * @return  array $this->data holds entire row of address
     */
    public function get_get() {
        $addressid = Input::get('addressid');
        $this->data['response']['body'] = $this->model->get($addressid);
    }
    
}

?>
