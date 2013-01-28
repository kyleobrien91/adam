<?php

class BookingPaymentItem extends AppModel {
	public $name = "BookingPaymentItem";
	public $useTable ="booking_payment_items";
	public $primaryKey = "id";
	public $recursive = 2;
	
	//Associations
	//many to one
	public $belongsTo = array('Booking','PaymentItem');
	
	//one to many
	public $hasMany = array('Payment');
	//one to one
	//public $hasOne = NULL;
	//many to many
	//public $hasAndBelongsToMany = NULL;
		
	//public $virtualFields = array();
	//public $validate = NULL;
	
}