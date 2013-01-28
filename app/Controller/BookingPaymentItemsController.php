<?php

class BookingPaymentItemsController extends AppController {
	var $name = "BookingPaymentItems";

	public function addPaymentItemToBooking() {
		if ($this -> request -> is('post')) {
			if ($this -> BookingPaymentItem -> save($this -> request -> data)) {
				$this -> Session -> setFlash('Addon added successully!', "goodflash");
				$this -> redirect(array(
					'controller' => "bookings",
					'action' => 'edit',
					$this -> request -> data['BookingPaymentItem']['booking_id']
				));
			} else {
				$this -> Session -> setFlash('Oops Something went wrong!', "badflash");
			}
		}
		//debug($this->request->data);
	}

	public function delete() {
		if ($this -> request -> is('post')) {
			if (!empty($this -> request -> data['BookingPaymentItem']['id'])) {
				$this -> set('data', $this -> BookingPaymentItem -> findById($this -> request -> data['BookingPaymentItem']['id']));
			}
		}
	}

	public function confirm_delete($id) {
		if($this->request->is('post')){
			if(!empty($this -> request -> data['BookingPaymentItem']['source_action'])){
				switch($this->request -> data['BookingPaymentItem']['source_action']){
					case "BookingPaymentItems_delete":
						$bpi = $this -> BookingPaymentItem -> findById($id, array('fields' => 'booking_id'));
						$this -> BookingPaymentItem -> read(null, $id);
						$this -> BookingPaymentItem -> saveField('booking_id', $bpi['BookingPaymentItem']['booking_id']."_d");
						$this -> Session -> setFlash('Addon removed', "goodflash");
						$this -> redirect(array(
							'controller' => 'bookings',
							'action' => 'edit',
							$bpi['Booking']['id']							
						));
						break;
				}
			} else {
				$this -> Session -> setFlash('Sorry, you can\'t access that section directly. You\'ll need to first confirm that you want to delete that addon', "badflash");
			}
		}
	}

	public function edit($id){
		if($this -> request -> is('post')){
			if($this -> BookingPaymentItem -> save($this -> request -> data)){
				$this -> Session -> setFlash('Addon changed!', "goodflash");
				$this -> redirect(array(
					'controller' => 'bookings',
					'action' => 'edit',
					$this -> request -> data['BookingPaymentItem']['booking_id']							
				));
			} else {
				$this -> Session -> setFlash('Oops, couldn\'t save the addon. Please check your form and try again', "badflash");
			}
		} else {
			$this -> data = $this -> BookingPaymentItem -> findById($id);
			$this->set('data', $this -> data);
			
		}
	}
}
