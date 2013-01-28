<?php

class PaymentMethod extends AppModel {
	public $name = "PaymentMethod";
	public $useTable ="payment_methods";
	public $primaryKey = "id";
	
	/*Associations*/
	//many to one
	//public $belongsTo = NULL;
	//one to many
	public $hasMany = array('Payment');
	//one to one
	//public $hasOne = NULL;
	//many to many
	//public $hasAndBelongsToMany = NULL;
		
	//public $virtualFields = NULL;
	//public $validate = NULL;

}
