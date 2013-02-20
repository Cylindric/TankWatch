<?php

class SpeciesTank extends AppModel {
	public $belongsTo = array('Species', 'Tank');
}