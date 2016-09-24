<?php

App::uses('AppController', 'Controller');

class BookController extends AppController {
	public $uses = array('BookInfo');
	public function index()
	{

	}

	public function add(){
		if ($this->request->is('post')) {
			// edit
			$this->BookInfo->edit($this->request->data, null);
			$this->set('validation', $this->BookInfo->validationErrors);
			// $this->redirect(array('action' => 'edit', null));
		}
	}
	public function edit($id = null) {
		// $this->BookInof->edit($this->request->data, $id);
	}
	public function view($id) {
		
	}
}