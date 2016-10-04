<?php

App::uses('AppController', 'Controller');

class ReturnBookController extends AppController {
	public $uses = array('LendInfo');
	public function index() {
		$userId = $this->Auth->user('id');
		$data = $this->LendInfo->getNowRentalInfo($userId);
		$this->set('data', $data);
	}

	public function returnBook($bookId) {
	}
}