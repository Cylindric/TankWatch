<?php

class TestsController extends AppController {

	public function index() {
		$this->set('tests', $this->Test->find('all'));
	}

}