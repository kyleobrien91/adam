<?php

class Booking extends AppModel {
	public $name = "Booking";
	public $recursive = 3;
	//public $actsAs = array('Habtamable' => array('habtmModel' => 'PaymentItem'));
	var $accommodationInformation;
	/*Associations Section*/
	public $belongsTo = array(
		'Property',
		'Guest',
		'User',
		'BookingSource'
	);
	public $hasMany = array(
		'BookingPaymentItem'
	);
	public $hasAndBelongsToMany = array('PaymentItem' => array('with' => 'BookingPaymentItem'));

	/*Virtual Fields*/
	//public $virtualFields = array();

	/*Validation Rules*/
	public $validate = array(
		'checkin' => array(
			'date' => array(
				'rule' => 'date',
				'message' => "Please select a valid date using the date selector"
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please select a date. This field cannot be blank'
			)
		),
		'checkout' => array(
			'date' => array(
				'rule' => 'date',
				'message' => "Please select a valid date using the date selector"
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please select a date. This field cannot be blank'
			)
		),
		'deposit_due_date' => array(
			'date' => array(
				'rule' => 'date',
				'message' => "Please select a valid date using the date selector"
			),
			'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => 'Please select a date. This field cannot be blank'
			)
		),
		'guest_id' => array('notEqual' => array(
				'rule' => array(
					'notEqual',
					'Select'
				),
				'message' => "Please select a guest from this drop down menu"
			))
	);

	public function accommodationInformation($id = null) {
		if (is_null($id)) {
			if (isset($this -> id)) { $id = $this -> id;
			} else
				return false;
		}
		$joins = array(
			array(
				'table' => 'booking_payment_items',
				'alias' => 'BookingPaymentItem',
				'type' => 'inner',
				'conditions' => array('PaymentItem.id = BookingPaymentItem.payment_item_id', )
			),
			array(
				'table' => 'bookings',
				'alias' => 'Booking',
				'type' => 'inner',
				'conditions' => array(
					'Booking.id = BookingPaymentItem.booking_id',
					'Booking.id' => $id
				)
			)
		);
		$ret = $this -> PaymentItem -> find('first', array(
			'joins' => $joins,
			'recursive' => -1,
			'conditions' => array('PaymentItem.description' => 'Accommodation')
		));

		return isset($ret['PaymentItem']) ? $ret['PaymentItem'] : array();
	}

	public function testing($id = null) {
		
	}

	public function depositInformation($id = null) {
		if (is_null($id)) {
			if (isset($this -> id)) { $id = $this -> id;
			} else
				return false;
		}
		$joins = array(
			array(
				'table' => 'booking_payment_items',
				'alias' => 'BookingPaymentItem',
				'type' => 'inner',
				'conditions' => array('PaymentItem.id = BookingPaymentItem.payment_item_id', )
			),
			array(
				'table' => 'bookings',
				'alias' => 'Booking',
				'type' => 'inner',
				'conditions' => array(
					'Booking.id = BookingPaymentItem.booking_id',
					'Booking.id' => $id
				)
			)
		);
		$ret = $this -> PaymentItem -> find('first', array(
			'joins' => $joins,
			'recursive' => -1,
			'conditions' => array('PaymentItem.description' => 'Deposit')
		));

		return isset($ret['PaymentItem']) ? $ret['PaymentItem'] : array();
	}

	public function paymentItems() {
		$bpi = $this -> read();
		$bpi = $bpi['BookingPaymentItem'];
		foreach ($bpi as $key => $value) {
			if (!empty($value['PaymentItem'])) {
				$arr[$key]['total_payments'] = 0;
				foreach ($value['Payment'] as $k => $v) {
					$arr[$key]['total_payments'] += $v['amount'];
				}

				$arr[$key]['id'] = $value['id'];
				$arr[$key]['quantity'] = $value['quantity'];
				$arr[$key]['payment_item_id'] = $value['payment_item_id'];
				if ($value['PaymentItem']) {
					$arr[$key]['name'] = $value['PaymentItem']['name'];
					$arr[$key]['description'] = $value['PaymentItem']['description'];
					$arr[$key]['price'] = $value['PaymentItem']['price'];
					$arr[$key]['payment_item_category_id'] = $value['PaymentItem']['payment_item_category_id'];
					$arr[$key]['category'] = $value['PaymentItem']['PaymentItemCategory']['category'];
					$arr[$key]['category_description'] = $value['PaymentItem']['PaymentItemCategory']['description'];
					$arr[$key]['total_cost'] = doubleval($value['quantity'] * $value['PaymentItem']['price']);
					if ($value['PaymentItem']['name'] == "Accommodation") {
						$arr[$key]['total_payments'] += $this -> depositPayments();
					}
					$arr[$key]['arrears'] = $arr[$key]['total_cost'] - $arr[$key]['total_payments'];
				}
			}
		}
		return isset($arr) ? $arr : FALSE;
	}

	public function depositPayments($id = null) {
		if (is_null($id)) {
			if (isset($this -> id)) { $id = $this -> id;
			} else
				return false;
		}
		$joins = array(
			array(
				'table' => 'booking_payment_items',
				'alias' => 'BookingPaymentItem',
				'type' => 'inner',
				'conditions' => array('BookingPaymentItem.id = Payment.booking_payment_item_id')
			),
			array(
				'table' => 'bookings',
				'alias' => 'Booking',
				'type' => 'inner',
				'conditions' => array(
					'Booking.id = BookingPaymentItem.booking_id',
					'Booking.id' => $id
				)
			),
			array(
				'table' => 'payment_items',
				'alias' => 'PaymentItem',
				'type' => 'inner',
				'conditions' => array(
					'PaymentItem.id = BookingPaymentItem.payment_item_id',
					'PaymentItem.name' => 'Deposit'
				)
			),
		);
		$ret = $this -> BookingPaymentItem -> Payment -> find('all', array(
			'joins' => $joins,
			'recursive' => -1,
			'fields' => array('SUM(amount) AS "Total"')
		));
		return $ret[0][0]['Total'];

	}

	public function bookingPayments($id = null) {
		if (is_null($id)) {
			if (isset($this -> id)) { $id = $this -> id;
			} else
				return false;
		}
		$joins = array(
			array(
				'table' => 'booking_payment_items',
				'alias' => 'BookingPaymentItem',
				'type' => 'inner',
				'conditions' => array('BookingPaymentItem.id = Payment.booking_payment_item_id')
			),
			array(
				'table' => 'bookings',
				'alias' => 'Booking',
				'type' => 'inner',
				'conditions' => array(
					'Booking.id = BookingPaymentItem.booking_id',
					'Booking.id' => $id
				)
			),
			array(
				'table' => 'payment_items',
				'alias' => 'PaymentItem',
				'type' => 'inner',
				'conditions' => array('PaymentItem.id = BookingPaymentItem.payment_item_id')
			),
		);
		$ret = $this -> BookingPaymentItem -> Payment -> find('all', array(
			'joins' => $joins,
			'recursive' => -1,
			'fields' => array('SUM(amount) AS "Total"')
		));
		return $ret[0][0]['Total'];

	}

	public function bookingCosts($id = null) {
		if (is_null($id)) {
			if (isset($this -> id)) { $id = $this -> id;
			} else
				return false;
		}
		$joins = array(
			array(
				'table' => 'booking_payment_items',
				'alias' => 'BookingPaymentItem',
				'type' => 'inner',
				'conditions' => array('BookingPaymentItem.id = Payment.booking_payment_item_id')
			),
			array(
				'table' => 'bookings',
				'alias' => 'Booking',
				'type' => 'inner',
				'conditions' => array(
					'Booking.id = BookingPaymentItem.booking_id',
					'Booking.id' => $id
				)
			),
			array(
				'table' => 'payment_items',
				'alias' => 'PaymentItem',
				'type' => 'inner',
				'conditions' => array('PaymentItem.id = BookingPaymentItem.payment_item_id')
			),
		);
		$ret = $this -> BookingPaymentItem -> Payment -> find('all', array(
			'joins' => $joins,
			'recursive' => -1,
			'fields' => array('SUM(amount) AS "Total"')
		));
		$dep = $this -> depositInformation($id);
		return $ret[0][0]['Total'] - ($dep['price']);
	}

	public function bookingArrears($id = null) {
		if (is_null($id))
			return ($this -> bookingCosts() - $this -> bookingPayments());
		else {
			return ($this -> bookingCosts($id) - $this -> bookingPayments($id));
		}
	}

	public function paymentsMade($id = null) {
		if (is_null($id)) {
			if (isset($this -> id)) {
				$id = $this -> id;
			} else
				return false;
		}
		$this -> BookingPaymentItem -> unbindModel(array('belongsTo' => array('Booking')));
		$this -> PaymentItem -> unbindModel(array('hasAndBelongsToMany' => array('Booking')));
		$b = $this -> BookingPaymentItem -> find('all', array(
			'conditions' => array('booking_id' => $id),
			'recursive' => 2
		));
		$counter = 0;
		foreach ($b as $key => $value) {
			foreach ($value['Payment'] as $k => $v) {
				$payments[$counter]['id'] = $v['id'];
				$payments[$counter]['booking_payment_item_id'] = $v['booking_payment_item_id'];
				$payments[$counter]['payment_method_id'] = $v['payment_method_id'];
				$payments[$counter]['amount'] = $v['amount'];
				$payments[$counter]['note'] = $v['note'];
				$payments[$counter]['date'] = $v['created'];
				$payments[$counter]['method'] = $v['PaymentMethod']['description'];
				$payments[$counter]['description'] = $value['PaymentItem']['name'];
				$counter++;
			}
		}
		return isset($payments) ? $payments : array();
	}

	public function activePaymentItems($id = null) {
		if (is_null($id)) {
			if (isset($this -> id)) {
				$id = $this -> id;
			} else
				return false;
		}
		$this -> BookingPaymentItem -> unbindModel(array('belongsTo' => array('Booking')));
		$this -> PaymentItem -> unbindModel(array('hasAndBelongsToMany' => array('Booking')));
		$this -> BookingPaymentItem -> unbindModel(array('hasMany' => array('Payment')));
		$b = $this -> BookingPaymentItem -> find('all', array(
			'conditions' => array('booking_id' => $id),
			'recursive' => 2
		));
		foreach ($b as $key => $value) {
			if (!empty($value['PaymentItem'])) {
				$list[$value['BookingPaymentItem']['id']] = $value['PaymentItem']['name'];
			}
		}
		return isset($list) ? $list : array();
	}

	public function todaysBookings() {
		$this->unbindModel(array('belongsTo' => array('Property', 'BookingSource', 'User')));
		
		$td = Date('Y-m-d');
		$today = $this -> findAllByCheckin($td, null, null, null, null, 0);
		foreach ($today as $key => $value) {
			$today[$key]['Booking']['arrears'] = $this -> bookingArrears($value['Booking']['id']);
		}
		return $today;
	}

	public function tomorrowsBookings() {
		$this->unbindModel(array('belongsTo' => array('Property', 'BookingSource', 'User')));
		
		$td = Date('Y-m-d', mktime(0, 0, 0, Date('n'), Date('j') + 1, Date('Y')));
		$tomorrow = $this -> findAllByCheckin($td, null, null, null, null, 0);
		foreach ($tomorrow as $key => $value) {
			$tomorrow[$key]['Booking']['arrears'] = $this -> bookingArrears($value['Booking']['id']);
		}
		return $tomorrow;

	}

	public function depositsDue() {
		$this->unbindModel(array('belongsTo' => array('Property', 'BookingSource', 'User', 'Guest')));
		$td = Date('Y-m-d');
		$dep = $this -> find('all', array(
			'recursive' => 0,
			'conditions' => array('checkin >=' => $td)
		));
		return $dep;
		foreach ($dep as $key => $value) {
			$deposit = $this->depositInformation($value['Booking']['id']);
			$this->log("Deposit amount: " .$deposit['Price']);
			$this->log("Deposit payments: " .$this->depositPayments($value['Booking']['id']));
			if($deposit['price']-$this->depositPayments($value['Booking']['id']) == 0){
				unset($dep[$key]);
			} else {
				$dep[$key]['Booking']['arrears'] = $this -> bookingArrears($value['Booking']['id']);
			}
		}
		return $dep;
	}

	public function finalPaymentsDue() {
		$d = Date('Y-m-d', mktime(0, 0, 0, Date('n'), Date('j') + 14, Date('Y')));
		$today = Date('Y-m-d');
		$dep = $this -> find('all', array(
			'recursive' => 0,
			'conditions' => array(
				'checkin <=' => $d,
				'checkin >=' => $today
			)
		));
		foreach ($dep as $key => $value) {
			if ($this -> bookingArrears($value['Booking']['id']) > 0) {
				$final[] = $value;
			}
		}
		if (isset($final)) {
			foreach ($final as $key => $value) {
				$final[$key]['Booking']['paid'] = $this -> bookingPayments($value['Booking']['id']);
				$final[$key]['Booking']['arrears'] = $this -> bookingArrears($value['Booking']['id']);
			}
		}
		return isset($final) ? $final : array();
	}

	public function bookingsPlacedToday() {
		$startTime = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
		$startDate = Date('Y-m-d', $startTime);
		$endTime = mktime(23, 59, 59, date('m'), date('d'), date('Y'));
		$endDate = Date('Y-m-d', $endTime);

		App::import('model', 'User');
		$user = new User();
		$users = $user -> findAllByActive(1, array(
			'id',
			'fullname',
			'role'
		), null, null, null, -1);

		foreach ($users as $key => $value) {
			$users[$key]['value'] = 0;
			$bookings = $this -> find('all', array(
				'conditions' => array(
					'user_id' => $value['User']['id'],
					'Booking.created BETWEEN ? AND ?' => array(
						$startDate,
						$endDate
					)
				),
				'recursive' => 1
			));
			$users[$key]['bookings'] = count($bookings);
			foreach ($bookings as $k => $v) {
				$users[$key]['value'] += $this -> bookingCosts($v['Booking']['id']);
			}
		}
		$this -> aasort($users, "value");
		$users = array_reverse($users);
		return $users;

	}

	function aasort(&$array, $key) {
		$sorter = array();
		$ret = array();
		reset($array);
		foreach ($array as $ii => $va) {
			$sorter[$ii] = $va[$key];
		}
		asort($sorter);
		foreach ($sorter as $ii => $va) {
			$ret[$ii] = $array[$ii];
		}
		$array = $ret;
	}

	public function bookingsPlacedThisMonth() {
		$startTime = mktime(0, 0, 0, date('m'), 1, date('Y'));
		$startDate = Date('Y-m-d', $startTime);
		$endTime = time();
        $this->log(time());
		$endDate = Date('Y-m-d', $endTime);

		App::import('model', 'User');
		$user = new User();
		$users = $user -> findAllByActive(1, array(
			'id',
			'fullname',
			'role'
		), null, null, null, -1);

		foreach ($users as $key => $value) {
			$users[$key]['value'] = 0;
			$bookings = $this -> find('all', array(
				'conditions' => array(
					'user_id' => $value['User']['id'],
					'Booking.created BETWEEN ? AND ?' => array(
						$startDate,
						$endDate
					)
				),
				'recursive' => 1
			));
			$users[$key]['bookings'] = count($bookings);
			foreach ($bookings as $k => $v) {
				$users[$key]['value'] += $this -> bookingCosts($v['Booking']['id']);
			}
		}
		$this -> aasort($users, "value");
		$users = array_reverse($users);
		return $users;
	}

	public function bookingsPlacedLastMonth() {
		$startTime = mktime(0, 0, 0, date('m') - 1, 1, date('Y'));
		$startDate = Date('Y-m-d', $startTime);
		$this -> log("Start date: " . $startDate);
		//$endTime = mktime(23, 59, 59, date('m')-1, date('d'), date('Y'));
		$endDate = Date('Y-m-t', strtotime("-1 month"));
		$this -> log("End date: " . $endDate);

		App::import('model', 'User');
		$user = new User();
		$users = $user -> findAllByActive(1, array(
			'id',
			'fullname',
			'role'
		), null, null, null, -1);

		foreach ($users as $key => $value) {
			$users[$key]['value'] = 0;
			$bookings = $this -> find('all', array(
				'conditions' => array(
					'user_id' => $value['User']['id'],
					'Booking.created BETWEEN ? AND ?' => array(
						$startDate,
						$endDate
					)
				),
				'recursive' => 1
			));
			$users[$key]['bookings'] = count($bookings);
			foreach ($bookings as $k => $v) {
				$users[$key]['value'] += $this -> bookingCosts($v['Booking']['id']);
			}
		}
		$this -> aasort($users, "value");
		$users = array_reverse($users);
		return $users;
	}

	public function bookingsNotInConsole() {
		$date = Date('Y-m-d');
		$dep = $this -> find('all', array(
			'recursive' => 0,
			'conditions' => array(
				'checkin >=' => $date,
				'inconsole' => NULL
			)
		));
		return $dep;
	}

	public function bookingsNotInStayz() {
		$date = Date('Y-m-d');
		$dep = $this -> find('all', array(
			'recursive' => 0,
			'conditions' => array(
				'checkin >=' => $date,
				'instayz' => NULL
			)
		));
		return $dep;
	}

	public function bookingsNotInResonline() {
		$date = Date('Y-m-d');
		$dep = $this -> find('all', array(
			'recursive' => 0,
			'conditions' => array(
				'checkin >=' => $date,
				'inresonline' => NULL
			)
		));
		return $dep;
	}

	public function depositPaid($id = null) {
		if (is_null($id)) {
			$dep = $this -> depositInformation();
			$dep = $dep['price'];
			if (($dep - $this -> depositPayments()) == 0) {
				return true;
			} else {
				return false;
			}
		} else {
			$dep = $this -> depositInformation($id);
			$dep = $dep['price'];
			if (($dep - $this -> depositPayments($id)) == 0) {
				return true;
			} else {
				return false;
			}

		}
	}

	public function whoPlacedBooking($id = null) {
		if (is_null($id)) {
			App::import('model', 'User');
			$user = new User();
			$booking = $this -> findById($this -> id);
			$users = $user -> find('first', array('conditions' => array('User.id' => $booking['Booking']['user_id'])));
			return $users['User']['fullname'];
		} else {
			App::import('model', 'User');
			$user = new User();
			$booking = $this -> findById($id);
			$users = $user -> find('first', array('conditions' => array('User.id' => $booking['Booking']['user_id'])));
			return $users['User']['fullname'];
		}
	}

	public function bookingSource($id = null) {
		if (is_null($id)) {
			$id = $this -> id;
		}
		$joins = array( array(
				'table' => 'bookings',
				'alias' => 'Booking',
				'type' => 'inner',
				'conditions' => array(
					'BookingSource.id = Booking.booking_source_id',
					'Booking.id' => $id
				)
			));

		$source = $this -> BookingSource -> find('first', array(
			'joins' => $joins,
			'recursive' => -1
		));
		return $source;
	}

	public function arrivalsToday() {
		$today = Date("Y-m-d");
		$ret = $this -> find('count', array('conditions' => array('checkin' => $today)));
		return $ret;
	}

	public function cleansToday() {
		$today = Date("Y-m-d");
		$ret = $this -> find('count', array('conditions' => array('checkout' => $today)));
		return $ret;
	}

}
