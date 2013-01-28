<?php

class PropertyController extends AppController {
	
	public function index(){
		$this->set('title_for_layout', 'Property Page');
		
		$this->set('properties', $this->Property->findAllById());
	}
	
	public function add() {
		$this->set('title_for_layout', 'Add Property | Eve');
		$this->set('fullnameemail', $this->Property->Owner->find('list', array('fields' => 'Owner.fullnameemail')));
		if ($this -> request -> is('post'))
		{
			$this -> Property -> create();
			if ($this -> Property -> save($this -> request -> data)) {
				$this -> Session -> setFlash("The Property has been added to the system", "goodflash");
				$this -> redirect(array('controller' => 'dashboard', 'action' => 'index'));

			} else {
				$this -> Session -> setFlash('Unable to add the property. Please have a look at the form below to make sure all the information 
				is accurate and complete', "badflash");
			}
		} else {
			
		}
		
	}
}
