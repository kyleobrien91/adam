<?php

class OwnersController extends AppController {

	public function add() {
		$this -> set('title_for_layout', 'Add Owner | Eve');
		if ($this -> request -> is('post')) {
			$this -> Owner -> create();
			if ($this -> Owner -> save($this -> request -> data)) {
				$this -> Session -> setFlash("The Owner has been added to the system", "goodflash");
				$this -> redirect(array(
					'controller' => 'dashboard',
					'action' => 'index'
				));

			} else {
				$this -> Session -> setFlash('Unable to add the owner. Please have a look at the form below to make sure all the information 
				is accurate and complete', "badflash");
				$this -> set('uniqueownernumber', $this -> request -> data['Owner']['ownernumber']);
			}
		} else {
			$this -> set('uniqueownernumber', $this -> Owner -> uniqueOwnerNumber());
		}

	}

}
