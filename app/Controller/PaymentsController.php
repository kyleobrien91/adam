<?php

class PaymentsController extends AppController {
	var $name = "Payments";
	var $recursive = 2;
	
	public function test(){
		$joinRecords = $this -> Payment -> find('all');
		debug($joinRecords);
		
	}
	
	public function addPaymentToBooking($bookingid){
		if ($this -> request -> is('post')) {
			if ($this -> Payment -> save($this -> request -> data)) {
				$this -> Session -> setFlash('Payment added successully!', "goodflash");
				$this -> redirect (array(
					'controller' => "bookings",
					'action' => 'edit',
					$bookingid
				));
			} else {
				$this -> Session -> setFlash('Oops Something went wrong!', "badflash");
			}
		}
	}
}