<?php

class SpeciesTransaction extends AppModel {
	public $belongsTo = array('Species', 'Tank');
}