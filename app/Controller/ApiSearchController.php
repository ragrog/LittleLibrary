<?php

App::uses('AppController', 'Controller');

class ApiSearchController extends AppController {
	// 使うコンポーネント
	// public $components = array('hoge', 'foo');
	// 使うモデル
	 public $uses = array('LearningPlan', 'LearningFlow');
	 public $components = array('RequestHandler');
	// Get
    public function index() {
	$bibou = 			array('XAMP', 'DB', 'Editor', 'HMTL', 'CSS', 'Js', 'cloud', 'ajax', 'websocket');
	$do = array(
		'Amazon' =>    array(   '1',  '1',      '1',    '1',   '1',  '1',     '1',     '1',       '0'),
	    'Twitter' =>   array(   '1',  '1',      '1',    '1',   '1',  '1',     '1',     '0',       '1'),
		'blog'    =>   array(   '0',  '1',      '1',    '1',   '1',  '1',     '1',     '0',       '0'),
		'potofol' =>   array(   '0',  '1',      '1',    '1',   '1',  '1',     '1',     '0',       '0'),
		'2ch'     =>   array(   '1',  '1',      '1',    '1',   '1',  '1',     '1',     '0',       '0'),
		'chat'    =>   array(   '1',  '1',      '1',    '1',   '1',  '1',     '1',     '0',       '1'),
	);
	$do = array(
		1 => array('name' => 'Amazon', 'location' => 'amazon.png'),
		2 => array('name' => 'Amazon', 'location' => 'amazon.png'), 
		3 => array('name' => 'Amazon', 'location' => 'amazon.png'), 
		4 => array('name' => 'Amazon', 'location' => 'amazon.png'), 
		5 => array('name' => 'Amazon', 'location' => 'amazon.png'), 
		6 => array('name' => 'Amazon', 'location' => 'amazon.png'), 
	)
	echo 'OK';

	$answer = 
	array(
		0 => array('next' => array( 1, -1), 'toi' => array(1,2)),
		1 => array('next' => array( 2, -1), 'toi' => array(1,2)),
		2 => array('next' => array(-1,  3), 'toi' => array(1,2)),
		3 => array('next' => array(-1,  4), 'toi' => array(1,2)),
		4 => array('next' => array(-1, 99), 'toi' => array(1,2)),

		// へんデータ
		-1 => array('next' => array(51, 51), 'toi' => array(1,2,3)),
		51 => array('next' => array(1001, 1001), 'toi' => array(1,2,3)),
	);
	die();

	// セッションがないときは初期化
	if (SessionComponent::check('XAMP')) {
		foreach ($do as $key => $value) {
			$this->Session->write($key,'0');
		}
		}
	} else {
		$this->request->query[''];
	}
	if (SessionComponent::check('name')) {
    	$this->Session->read('name');
		echo $this->Session->read('name');
		echo 'あるよ';
		$data = $this->Session->read('name');
		$data += 1;
		$this->Session->write('name', $data);
	} else {
		echo '新規作成';
    	$this->Session->write('name', array('aho' => 10,10));
		echo $this->Session->read('name');
	}
	$this->Session->delete('name');
	die();

        $this->set(array(
            'recipes' => 12312,
            '_serialize' => array('recipes')
        ));
    }
	public function edit($id = null){
		// Controller アクションへのリダイレクト
		return $this->redirect(
			array('controller' => 'orders', 'action' => 'thanks')
		);
		
		

	}

	public function add(){
		// actionへのデータ
		$this->redirect(array('action' => 'edit', $id));
	}
}