<?php

class Owner extends AppModel {
	//public $hasMany = 'Property';
	
	public $virtualFields = array(
		'fullnameemail' => 'CONCAT(Owner.firstname, " ", Owner.lastname, " - ", Owner.email, " - ", Owner.ownernumber)'
	);
	
	public $validate = array(
		'firstname' => array('minLength' => array(
				'rule' => array(
					'minLength',
					2
				),
				'message' => 'Please make sure that you\'ve entered more than one character here'
			)),
		'lastname' => array('minLength' => array(
				'rule' => array(
					'minLength',
					2
				),
				'message' => 'Please make sure that you\'ve entered more than one character here'
			)),
		'email' => array('email' => array(
				'rule' => array(
					'email',
					true
				),
				'message' => 'This isn\'t currently a valid email address. Please try again'
			)),
		'contactnumberprimary' => array('notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'We need a primary contact number for this owner so this can\'t be empty'
			)),
		'contactnumbersecondary' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'required' => false,
				'allowEmpty' => true,
				'message' => 'Please enter a valid number in here'
			))
	);
	
	public function uniqueOwnerNumber() {
		$unique = FALSE;
		do {
			$random = substr(number_format(time() * rand(), 0, '', ''), 0, 10);

			$check = $this -> find('list', array('fields' => 'Owner.ownernumber'));
			if (count($check) < 1) {
				$unique = TRUE;
			} else {
				foreach ($check as $key => $value) {
					if ($value == $random)
						$unique = FALSE;
					else {
						$unique = TRUE;
					}
				}
			}
		} while($unique == FALSE);
		return $random;
	}

}
