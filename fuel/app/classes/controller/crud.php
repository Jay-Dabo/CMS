<?php

/**
 * Part of the SmartChurch Church Management System
 *
 * @package    SmartChurch
 * @version    0.1
 * @author     Ryan Dawkins
 */

namespace SmartChurch;

use Fuel\Core\Controller_Rest;

/**
 * Model_Crud
 *
 * A base controller that forces implementation of CRUD methods.
 *
 * @package   SmartChurch
 * @author    Ryan Dawkins
 */

abstract class Controller_Crud extends Controller_Rest{
    
    protected $model;
    protected $data;
    
    /**
     * Sets up the data array
     * 
     * @return  void
     */
    public function before() {
        parent::before();
        $this->data = array();
    }
    
    /**
     * Sets the header as JSON and returns the response object.
     * 
     * @param   Response $response The data response object
     * @return  Response $this->response() returns a response object
     */
    public function after($response) {
        parent::after($response);
        $this->response->set_header('Content-Type', 'application/json');
        return $this->response(json_encode($this->data));
    }
    
    /**
     * Post method to enforce a create method.
     * 
     * @return  void
     */
    abstract protected function post_create();
    
    /**
     * Get method to get a single entity by a given id
     * 
     * @return void
     */
    abstract protected function get_get();
    
    /**
     * Abstract method update to update an entity
     * 
     * @return void
     */
    abstract protected function post_update();
    
    /**
     * Get method to delete an entity
     * 
     * @return void
     */
    abstract protected function get_delete();
    
}