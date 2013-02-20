<?php

class SpeciesController extends AppController {
    
    public function beforeFilter() {
        $this->Auth->allow(array('index'));
    }
    
    public function index() {
        $species = $this->Species->find('all');
        $this->set(compact('species'));
    }
}