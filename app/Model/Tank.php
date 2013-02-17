<?php

class Tank extends AppModel {

    public $belongsTo = array('User');
    public $hasMany = array('SpeciesTransactions');

}