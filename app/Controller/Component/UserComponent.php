<?
App::uses('Component', 'Controller');
//Get the menu from the database
class UserComponent extends Component {
    function loggedIn(){
		App::import('Model', 'User');
		App::import('Helper', 'Auth');
		$this->User = new User();
		$random = $this->User->findById($this->Auth->user('id'));
    }
}
?>
