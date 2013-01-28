<?php

class PaymentItem extends AppModel {
	public $name = "PaymentItem";
	public $useTable = "payment_items";
	public $primaryKey = "id";
	public $recursive = 1;

	//Associations
	//many to one
	public $belongsTo = array('PaymentItemCategory');
	//one to many
	//public $hasMany = NULL;
	//one to one
	//public $hasOne = NULL;
	//many to many
	public $hasAndBelongsToMany = array('Booking' => array('with' => 'BookingPaymentItem'));

	public $virtualFields = array('dropdowndescription' => "CONCAT(PaymentItem.name, ' ($', PaymentItem.price, ')')");
	//public $validate = NULL;

	public function listAddons($id = null, $fields = array('dropdowndescription')) {
		if (!$id) {
			return $this -> find('list', array('fields' => $fields, 'conditions'=>array('PaymentItemCategory.category'=>'Addon'), 'recursive' => 0));
		} else {
			/*return $this -> find('list', array(
				'fields' => $fields,
				'conditions' => array('PaymentItemCategory.category' => 'Addon')
			)); */
		}
	}
	
}
