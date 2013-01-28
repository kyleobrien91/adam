<?php

class Bookingsource extends AppModel {
	public $hasMany = 'Booking';
	public $useTable ="booking_sources";
	
}
