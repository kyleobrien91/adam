<?

class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		
	}
	
	public function isAuthorized($user) {
    if ($this->action === 'add' && $this->Auth->user('role') !== 'admin') {
    	$this -> Session -> setFlash(__("Sorry, only administrators are allowed to access the Users area"), 'badloginflash');
        return false;
    }
    return parent::isAuthorized($user);
}

	public function login() {
		$this->layout = 'login';
		if ($this -> request -> is('post')) {
			if ($this -> Auth -> login()) {
				$this -> redirect($this -> Auth -> redirect());
			} else {
				$this -> Session -> setFlash(__('Invalid username or password, try again'), 'badloginflash');
			}
		}
	}

	public function logout() {
		$this->Session->setFlash('You are logged out!', 'goodflash');
		$this -> redirect($this -> Auth -> logout());
	}
	
	public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'), 'goodflash');
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }
	
	public function edit($id = null) {
		$this -> User -> id = $id;
		if (!$this -> User -> exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this -> request -> is('post') || $this -> request -> is('put')) {
			if ($this -> User -> save($this -> request -> data)) {
				$this -> Session -> setFlash(__('The user has been saved'));
			} else {
				$this -> Session -> setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this -> request -> data = $this -> User -> read(null, $id);
			unset($this -> request -> data['User']['password']);
		}
	}
	
	public function delete($id = null) {
		if (!$this -> request -> is('post')) {
			throw new MethodNotAllowedException();
		}
		$this -> User -> id = $id;
		if (!$this -> User -> exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this -> User -> delete()) {
			$this -> Session -> setFlash(__('User deleted'));
			$this -> redirect(array('action' => 'index'));
		}
		$this -> Session -> setFlash(__('User was not deleted'));
		$this -> redirect(array('action' => 'index'));
	}
}