<?php

class BookingsController extends AppController {
	public $helpers = array(
		'Time',
		'Js'
	);
	var $name = "Bookings";

	public function index() {
		$this -> set('title_for_layout', 'Dashboard | Eve');
		
		$this -> set('user', $this->Booking->User->findById($this->Auth->user('id')));
		$this -> set('bookingsToday', $this->Booking->todaysBookings());
		$this -> set('bookingsTomorrow', $this->Booking->tomorrowsBookings());
		$this -> set('depositsDue', $this->Booking->depositsDue());
		$this -> set('finalPaymentsDue', $this->Booking->finalPaymentsDue());
		$this -> set('bookingsPlacedToday', $this->Booking->bookingsPlacedToday());
		$this -> set('bookingsPlacedThisMonth', $this->Booking->bookingsPlacedThisMonth());
		$this -> set('bookingsPlacedLastMonth', $this->Booking->bookingsPlacedLastMonth());
		$this -> set('bookingsNotInConsole', $this->Booking->bookingsNotInConsole());
		$this -> set('bookingsNotInStayz', $this->Booking->bookingsNotInStayz());
		$this -> set('bookingsNotInResonline', $this->Booking->bookingsNotInResonline());
		$this -> set('arrivals', $this->Booking->arrivalsToday());
	}
 
	public function add() {
		$this -> loadModel('PaymentItemCategory');
		$this -> set('title_for_layout', 'Booking | Add New');
		$this -> set('bookingSources', am(array("" => ""),$this->Booking->BookingSource->find('list', array('fields' => array('BookingSource.id', 'BookingSource.description')))));
		$this -> set('properties', $this -> Booking -> Property -> find('list', array('fields' => array('Property.fulldescription'))));
		$this -> set('guests', $this -> Booking -> Guest -> find('list', array('fields' => array('Guest.dropdownname'))));
		$this -> set('accommodationCategoryId', $this -> PaymentItemCategory -> findByCategory('Accommodation'));
		$this -> set('depositCategoryId', $this -> PaymentItemCategory -> findByCategory('Deposit'));

		if ($this -> request -> is('post')) {
			$newPaymentItemIds = NULL;
			foreach ($this->data['PaymentItem'] as $key => $value) {
				foreach ($value as $k => $v) {
					$newPaymentItem['PaymentItem'][$k] = $v;
				}
				$this -> Booking -> PaymentItem -> create();
				$this -> Booking -> PaymentItem -> save($newPaymentItem);
				$newPaymentItemIds[] = $this -> Booking -> PaymentItem -> id;
			}
			if (isset($newPaymentItemIds)) {
				$try['PaymentItem'] = ( array('PaymentItem' => $newPaymentItemIds));
				unset($this -> request -> data['PaymentItem']);
				$this -> request -> data = am($this -> request -> data, $try);
			}

			$this -> Booking -> saveAll($this -> request -> data);
			$redirect = FALSE;
			foreach ($newPaymentItemIds as $key => $value) {
				$random = $this -> Booking -> BookingPaymentItem -> findByPaymentItemId($newPaymentItemIds[$key]);
				$random['BookingPaymentItem']['quantity'] = '1';
				$redirect = $this -> Booking -> BookingPaymentItem -> save($random);
			}
			if ($redirect) {
				$this -> redirect(array(
					'action' => 'edit',
					$this -> Booking -> id
				));
			}
		} else {

		}
	}

	public function view($id) {
		if (!$id) {
			$this -> Session -> setFlash("No booking ID entered", "badflash");
			$this -> redirect(array(
				'controller' => 'dashboard',
				'action' => 'index'
			));
		} else {
			$this -> Booking -> id = $id;
			$check = $this -> Booking -> find('first', array(
				'recursive' => 0,
				'conditions' => array('Booking.id' => $id)
			));
			if ($check) {
				$this -> set('booking', $check);
				$this -> set('depositPaid', $this->Booking->depositPaid($id));
				$this -> set('bookingid', $this -> Booking -> id);
				$this -> set('accommodation', $this -> Booking -> accommodationInformation());
				$this -> set('totalPayments', $this -> Booking -> bookingPayments());
				$this -> set('bookingArrears', $this -> Booking -> bookingArrears());
			} else {
				$this -> Session -> setFlash("Sorry, but there is no booking with an ID that equals " . $id, "badflash");
				$this -> redirect(array(
					'controller' => 'dashboard',
					'action' => 'index'
				));
			}
		}
	}

	public function addPaymentToBooking($bookingid) {
		if ($this -> request -> is('post')) {
			if ($this -> Booking -> BookingDefault -> Payment -> saveAll($this -> request -> data)) {
				$this -> Session -> setFlash('Payment added successully!', "goodflash");
				$this -> redirect(array(
					'action' => 'edit',
					$bookingid
				));
			} else {
				$this -> Session -> setFlash('Oops Something went wrong!', "badflash");
			}
		}
	}

	public function test() {
		if ($this -> request -> is('post')) {
			$newPaymentItemIds = NULL;
			foreach ($this->data['PaymentItem'] as $key => $value) {
				foreach ($value as $k => $v) {
					$newPaymentItem['PaymentItem'][$k] = $v;
				}
				$this -> Booking -> PaymentItem -> create();
				$this -> Booking -> PaymentItem -> save($newPaymentItem);
				$newPaymentItemIds[] = $this -> Booking -> PaymentItem -> id;
			}
			if (isset($newPaymentItemIds)) {
				$try['PaymentItem'] = ( array('PaymentItem' => $newPaymentItemIds));
			}
			unset($this -> request -> data['PaymentItem']);
			$this -> request -> data = am($this -> request -> data, $try);
			$this -> Booking -> saveAll($this -> request -> data);
			foreach ($newPaymentItemIds as $key => $value) {
				$random = $this -> Booking -> BookingPaymentItem -> findByPaymentItemId($newPaymentItemIds[$key]);
				$random['BookingPaymentItem']['quantity'] = '1';
				$this -> Booking -> BookingPaymentItem -> save($random);
			}
		}
	}

	public function edit($id) {
		if ($this -> Booking -> exists($id)) {
			$this -> Booking -> id = $id;
			$this -> Booking -> read();
			$this -> loadModel('PaymentMethod');
			$this -> set('title_for_layout', 'Edit Booking | Eve');
			$this->set('testing', $this->Booking->testing());
			$this -> set('userFullName', $this -> Booking -> whoPlacedBooking());
			$this -> set('bookingSource', $this->Booking->bookingSource());
			$this -> set('bookingId', $this -> Booking -> id);
			$this -> set('addons', am(array('' => ''), $this -> Booking -> PaymentItem -> listAddons()));
			$this -> set('paymentMethods', $this -> PaymentMethod -> find('list', array('fields' => array('description'))));
			$this -> set('properties', $this -> Booking -> Property -> find('list', array('fields' => array('Property.fulldescription'))));
			$this -> set('accomm', $this -> Booking -> accommodationInformation());
			$this -> set('deposit', $this -> Booking -> depositInformation());
			$this -> set('paymentgriditems', $this -> Booking -> paymentItems());
			$this -> set('bookingcost', $this -> Booking -> bookingCosts());
			$this -> set('bookingarrears', $this -> Booking -> bookingArrears());
			$this -> set('payments', $this -> Booking -> paymentsMade());
			$this -> set('paymentItems', am(array("" => ""), $this -> Booking -> activePaymentItems()));

			if ($this -> request -> is('post')) {
				if ($this -> Booking -> validates() && $this -> Booking -> PaymentItem -> validates() && $this -> Booking -> Guest -> validates()) {
					foreach ($this->request->data['PaymentItem'] as $key => $value) {
						foreach ($value as $k => $v) {
							$newPaymentItem['PaymentItem'][$k] = $v;
						}
						$this -> Booking -> PaymentItem -> create();
						$this -> Booking -> PaymentItem -> save($newPaymentItem);
					}
					$this -> Booking -> save($this -> request -> data['Booking']);
					$this -> Booking -> Guest -> save($this -> request -> data['Guest']);
					$this -> Session -> setFlash("Booking $id has been updated", "goodflash");
					$this -> redirect(array(
						'action' => 'view',
						$id
					));
				} else {
					$this -> Session -> setFlash('Oops Something went wrong!', "badflash");
				}
			} else {
				$this -> request -> data = $this -> Booking -> read();
			}
		} else {
			$this -> Session -> setFlash("Sorry, this booking ID doesn't exist: " . $id, "badflash");
			$this -> redirect(array(
				'controller' => 'dashboard',
				'action' => 'index'
			));
		}
	}

	public function generateRandomUuid() {
		//$helpers = array('Text');
		App::import('Helper', 'Text');
		$this -> Common = new TextHelper();
		$foo = $this -> Common -> uuid();
		pr($foo);
	}

	public function sendReminder($id = null, $reminder = 'nothing') {
		if ($this -> request -> is('post')) {
			$this -> autoRender = false;
			$this -> Booking -> id = $id;
			$date = Date('Y-m-d');
			if ($this -> Booking -> exists()) {
				switch($reminder) {
					case "email" :
						if ($this -> Booking -> saveField('depositemail', $date)) {
							$dates = $this -> Booking -> find('first', array('recursive' => 0, 'conditions' => array('Booking.id'=>$id), 'fields' => 'depositemail'));
							$this -> Session -> setFlash("Email sent date successfully updated to " . $dates['Booking']['depositemail'], 'goodflash');
							$this -> redirect(array(
								'action' => 'edit',
								$id
							));
						} else {
							$returned = $this -> Booking -> find('first', array('recursive' => 0, 'conditions' => array('Booking.id'=>$id), 'fields' => 'depositemail'));
							if (!empty($returned) && $returned['depositemail'] != '0000-00-00') {
								$dates = $this -> Booking -> find('first', array('recursive' => 0, 'conditions' => array('Booking.id'=>$id), 'fields' => 'depositemail'));
								$this -> Session -> setFlash("Unable to update the email sent date. Current date is " . $dates['Booking']['depositemail'], 'badflash');
								$this -> redirect(array(
									'action' => 'edit',
									$id
								));
							} else {
								$this -> Session -> setFlash("Unable to update to email sent date. No email has ever been sent to remind the guest about the deposit due", 'badflash');
								$this -> redirect(array(
								'action' => 'edit',
								$id
							));
							}
						}
						break;
					case "call" :
						if ($this -> Booking -> saveField('depositcall', $date)) {
							$dates = $this -> Booking -> find('first', array('recursive' => 0, 'conditions' => array('Booking.id'=>$id), 'fields' => 'depositcall'));
							$this -> Session -> setFlash("Call made date successfully updated to " . $dates['Booking']['depositcall'], 'goodflash');
							$this -> redirect(array(
								'action' => 'edit',
								$id
							));
						} else {
							$returned = $this -> Booking -> find('first', array('recursive' => 0, 'conditions' => array('Booking.id'=>$id), 'fields' => 'depositcall'));
							if (!empty($returned) && $returned['depositcall'] != '0000-00-00') {
								$dates = $this -> Booking -> find('first', array('recursive' => 0, 'conditions' => array('Booking.id'=>$id), 'fields' => 'depositcall'));
								$this -> Session -> setFlash("Unable to update the call made date. Current date is " . $dates['Booking']['depositcall'], 'badflash');
								$this -> redirect(array(
									'action' => 'edit',
									$id
								));
							} else {
								$this -> Session -> setFlash("Unable to update to call made date. No call has ever been made to remind the guest about the deposit due", 'badflash');
								$this -> redirect(array(
								'action' => 'edit',
								$id
							));
							}
						}
						break;
				}
			} else {
				return "Booking doesn't exist";
			}
		} else {
			return "Apparently not AJAX";
		}
	}

	public function addBookingToThirdParty($id, $tp, $action){
		$this -> autoRender = false;
		if(!isset($tp) || !isset($id) || !isset($action)){
			$this -> Session -> setFlash("Booking $id couldn't be updated", 'badflash');
			$this -> redirect(array('action' => 'index'));
		} else {
			switch ($tp){
				case "stayz" :
					$this -> Booking -> id = $id;
					$this -> Booking -> saveField('instayz', 1);
					$this -> Session -> setFlash("Booking $id in Stayz", 'goodflash');
					$this -> redirect(array('action' => $action, $id));
					break;
				case "resonline":
					$this -> Booking -> id = $id;
					$this -> Booking -> saveField('inresonline', 1);
					$this -> Session -> setFlash("Booking $id in Res-Online", 'goodflash');
					$this -> redirect(array('action' => $action, $id));
					break;
				case "console":
					$this -> Booking -> id = $id;
					$this -> Booking -> saveField('inconsole', 1);
					$this -> Session -> setFlash("Booking $id in Console", 'goodflash');
					$this -> redirect(array('action' => $action, $id));
					break;
				default:
					$this -> Session -> setFlash("Booking $id couldn't be updated", 'badflash');
					$this -> redirect(array('action' => $action, $id));
					break;
					
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
}
