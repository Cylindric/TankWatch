<?php

class Species extends AppModel {
	public $hasMany = array('SpeciesTransactions');
}