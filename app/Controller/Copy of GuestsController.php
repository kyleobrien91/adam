<?php

class GuestsController extends AppController {

	public function add() {
		$this->set('title_for_layout', 'Add Guest | Eve');
		if ($this -> request -> is('post'))
		{
			$this -> Guest -> create();
			if ($this -> Guest -> save($this -> request -> data)) {
				$this -> Session -> setFlash("The Guest has been added to the system", "goodflash");
				$this -> redirect(array('controller' => 'dashboard', 'action' => 'index'));
			} else {
				$this -> Session -> setFlash('Unable to add the guest. Please have a look at the form below to make sure all the information 
				is accurate and complete', "badflash");
				$this->set('uniqueguestnumber', $this->request->data['Guest']['guestnumber']);
			}
		} else {
			$this->set('uniqueguestnumber', $this->Guest->uniqueGuestNumber());
		}
	}

}
