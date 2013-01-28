<?php

class Payment extends AppModel {
	public $name = "Payment";
	public $useTable ="payments";
	public $primaryKey = "id";
	public $recursive = 2;
	
	/*Associations*/
	//many to one
	public $belongsTo = array(
		"PaymentMethod" => array(
			'className' => 'PaymentMethod',
			'foreignKey' => 'payment_method_id'
		),
		'BookingPaymentItem'
	);
	//one to many
	//public $hasMany = NULL;
	//one to one
	//public $hasOne = NULL;
	//many to many
	//public $hasAndBelongsToMany = NULL;
		
	//public $virtualFields = NULL;
	//public $validate = NULL;

}
