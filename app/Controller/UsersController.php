<?php
// app/Controller/UsersController.php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index','testlogin');
		$this->Auth->authorize = 'Controller';
	}
	// 管理者権限
	public function isAuthorized($user) {
		if ($this->Auth->user('role') == 'admin') {
			//admin権限を持つユーザは全てのページにアクセスできる
			return true;
		} elseif ($this->Auth->user('role') == 'member') {
			if (in_array($this->action, array('userlist', 'view', 'testlogin'))) {
				//user権限を持つユーザ指定したアクションにアクセスできる
				return true;
			}
		}
		return false;
	}
	// ログイン画面
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Flash->error('Invalid username or password, try again');
			}
		}
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}

	public function userlist() {
		// postかつ権限が管理者のとき、指定したIDでviewを呼び出し
		if ($this->request->is('post') && $this->User->getRole($this->Auth->user('id')) === 'admin') {
			// 指定したIDでViewへリダイレクト
			if (isset($this->request->data['User']['id'])) {
				$this->redirect(array('action' => 'view', $this->request->data['User']['id']));
			}
		} else {
			// Userデータを取得
			$data = $this->User->find('all', array(
					'fields' => array(
						'User.id',
						'User.username',
						'User.role'
					) 
			));
			$this->set('users', $data);
			$this->set('userId', $this->Auth->user('id'));
		}
	}

	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->findById($id));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
			//	$this->Flash->success(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->set('validation', $this->User->validationErrors);
			}
			// $this->Flash->error(
			// 	__('The user could not be saved. Please, try again.')
			// );
		}
	}

	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Flash->success(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Flash->error(
				__('The user could not be saved. Please, try again.')
			);
		} else {
			$this->request->data = $this->User->findById($id);
			unset($this->request->data['User']['password']);
		}
	}

	public function delete($id = null) {
		// Prior to 2.5 use
		// $this->request->onlyAllow('post');

		$this->request->allowMethod('post');

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Flash->success(__('User deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Flash->error(__('User was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}
	public function testlogin() {
		$this->Auth->login(array('username' => 'admin002', 'password' => 'password'));
		return $this->redirect(array('action' => 'index'));
	}

}