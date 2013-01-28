<?php

class Property extends AppModel {
	//public $hasMany = "Bookings";
	public $belongsTo = "Owner";

	public $virtualFields = array('fulldescription' => 'CONCAT(Property.id, " - ", Property.addressline1, ", ", Property.addresslocality, ", ", Property.addresspostalcode)');

	public $validate = array(
		'id' => array(
			'unique' => array(
				'rule' => 'checkUnique',
				'message' => 'This ID is already being used by another property. Please enter another one',
				'on' => 'create'
			)
		),
		'bedrooms' => array(
			'numberic' => array(
				'rule' => 'numeric',
				'message' => 'Please enter a valid number...'
			),
			'comparison' => array(
				'rule' => array(
					'comparison',
					'>',
					0
				),
				'message' => 'Come on, every property has at least one room, right?'
			)
		),
		'description' => array('minLength' => array(
				'rule' => array(
					'minLength',
					10
				),
				'message' => 'Please make sure that the description contains at least 10 characters'
			)),
		'addressline1' => array('notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "This field can't be empty. We need to know where the property is"
			)),
		'addresslocality' => array('notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "This field can't be empty. We need to know where the property is"
			)),
		'addressprovince' => array('notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "This field can't be empty. We need to know what province the property is in"
			)),
		'addresspostalcode' => array('notEmpty' => array(
				'rule' => "notEmpty",
				'message' => "This field can't be empty. We need to know the property's postal code"
			)),
		'owner_id' => array()
	);
}
