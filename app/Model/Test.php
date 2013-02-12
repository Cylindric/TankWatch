<?php

class Test extends AppModel {
	public $hasMany = array('Result');

	public $belongsTo = array('TestSet');
	
	public $virtualFields = array(
		'display_name' => 'CONCAT(Test.name, " (", Test.code, ")")'
	);
}