<?php

use Fuel\Core\Controller_Template;

class Controller_Site extends Controller_Template {
    
    public $template = 'site/template';
    private $data;
    
    public function before() {
        parent::before();
        $this->data = array();
        $this->template->basecss = array('bootstrap.min.css', 'font-awesome.min.css', 'font-awesome-ie7.min.css');
        $this->template->css = array();
        $this->template->basejs = array('jquery.min.js', 'bootstrap.min.js', 'respond.js');
        $this->template->js = array();
    }
    
    public function action_index() {
        $this->template->content = '';
    }
    
}