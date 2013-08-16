<?php

/**
 * Part of the SmartChurch Church Management System
 *
 * @package    SmartChurch
 * @version    0.1
 * @author     Ryan Dawkins
 */

/**
 * Model_Crud
 *
 * A base model that forces implementation of CRUD methods.
 *
 * @package   SmartChurch
 * @author    Ryan Dawkins
 */

use Fuel\Core\Model;

abstract class Model_Crud extends Model {
    
    protected $data;
    
    /**
     * Sets up the data array
     * 
     * @return  void
     */
    function __construct() {
        $this->data = array();
    }
    
    /**
     * Abstract create method to insert data into a table
     * 
     * @return  array $this->data id of new entity
     */
    public abstract function create();
    
    /**
     * Abstract get method to get all entities by a given id
     * 
     * @return  array $this->data array holding an entity's data
     */
    public abstract function get();
    
    /**
     * Abstract method to update an entity
     * 
     * @param   array $this->data
     */
    public abstract function update();
    
    /**
     * Abstract method to delete an entity
     * 
     * @return  array $this->data
     */
    public abstract function delete();
}