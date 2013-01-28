<?php

class PaymentItemCategory extends AppModel {
	public $name = "PaymentItemCategory";
	public $useTable = "payment_item_categories";
	public $primaryKey = "id";
	
	//Associations
	//many to one
	//public $belongsTo = NULL;
	
	//one to many
	public $hasMany = array('PaymentItem');
	//one to one
	//public $hasOne = NULL;
	//many to many
	//public $hasAndBelongsToMany = NULL;
		
	//public $virtualFields = NULL;
	//public $validate = NULL;
}