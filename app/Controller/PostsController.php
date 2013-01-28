<?php
class PostsController extends AppController {
	var $name = 'Posts';

	function form($id = null) {
		if (!empty($this -> data)) {
			$this -> Post -> create();
			if ($this -> Post -> save($this -> data)) {
				$this -> Session -> setFlash(__('The Post has been saved.', true));
				$this -> redirect(array(
					'action' => 'form',
					$this -> Post -> id
				));
			} else {
				$this -> Session -> setFlash(__('The Post could not be saved. Please, try again.'), true);
			}
		}
		if (empty($this -> data)) {
			$this -> data = $this -> Post -> read(null, $id);
		}
		$tags = $this -> Post -> Tag -> find('list', array('fields' => array(
				'id',
				'name'
			)));
		$this -> set(compact('tags'));
	}

}
