<?php

class Guest extends AppModel {
	public $name = "Guest";
	//public $hasMany = "Booking";

	public $virtualFields = array(
		'name' => 'CONCAT(Guest.firstname, " ", Guest.lastname)',
		'dropdownname' => 'CONCAT(Guest.guestnumber, " - ", Guest.firstname, " ", Guest.lastname)'
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
				'message' => 'We need a primary contact number for this guest so this can\'t be empty'
			))
	);

    /**
     * Returns a value indicating the default guest to be used in a drop down.
     *
     * Checks that the guest exists. If it doesn't, it returns an empty string.
     * 
     * @param int $gid
     * @return string
     */
    public function getDefaultGuest($gid=NULL) {
        if(isset($gid)){
            if($this->exists($gid)){
                return $gid;
            } else {
                return "";
            }
        } else {
            return "";
        }
    }

	public function uniqueGuestNumber() {
		$unique = FALSE;
		do {
			$random = substr(number_format(time() * rand(), 0, '', ''), 0, 10);

			$check = $this -> find('list', array('fields' => 'Guest.guestnumber'));
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
