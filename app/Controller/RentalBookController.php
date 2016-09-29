<?php

App::uses('AppController', 'Controller');

class RentalBookController extends AppController {
	public $uses = array('LendInfo');

	public function index() {
		// $userId = $this->Auth->user('id');
		// $this->LendInfo->rentalBook($userId, $bookId);
		// $this->redirect(array('action' => 'view', $bookId));
	}
	public function rentalBook($bookId) {
		$userId = $this->Auth->user('id');
		$this->LendInfo->rentalBook($userId, $bookId);
		$this->redirect(array('action' => 'index'));
	}
	// public function returnBook($bookId) {
	// 	$userId = $this->Auth->user('id');
	// 	$this->LendInfo->returnBook($userId, $bookId);
	// 	$this->redirect(array('action' => 'view', $bookId));
	// }
}