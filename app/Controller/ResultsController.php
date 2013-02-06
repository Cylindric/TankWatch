<?php

class ResultsController extends AppController {

	public function index() {
		$this->set('results', $this->Result->find('all'));
	}

}