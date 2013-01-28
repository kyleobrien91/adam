<?php
App::uses('AuthComponent', 'Controller/Component');


class User extends AppModel {
	var $hasMany = array('Booking');
	
	public function beforeSave($options = array()) {
		if (isset($this -> data[$this -> alias]['password'])) {
			$this -> data[$this -> alias]['password'] = AuthComponent::password($this -> data[$this -> alias]['password']);
		}
		return true;
	}
	
	var $virtualFields = array(
		'fullname' => 'CONCAT(User.firstname, " ", User.lastname)'
	);
	
	public $validate = array(
		'firstname' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => "It's mandatory to enter this user's first name"
			)
		),
		'lastname' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => "It's mandatory to enter this user's last name"
			)
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => "Please ensure this is a valid email address",
				'allowEmpty' => false
			)
		),
		'username' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A username is required'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			)
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList',array('admin','team_member')),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false
			)
		)
	);
}
