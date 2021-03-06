<?php
App::uses('AppModel', 'Model');

class BookInfo extends AppModel {
	public $useTable = 'book_info';
	public $validate = array(
		'title' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'タイトルは必須です'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 100),
				'message' => '100文字までです',
				'required' => true
			)
		),
		'author' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => '著者は必須です'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 100),
				'message' => '100文字までです',
				'required' => true
			)
		),
		'publisher' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => '出版社は必須です'
			),
			'maxLength' => array(
				'rule' => array('maxLength', 100),
				'message' => '100文字までです',
				'required' => true
			)
		),
		'thumbnail_name' => array(
			'image' => array(
				'rule' => array(
					'extension',
					array('gif', 'jpeg', 'png', 'jpg')
				),
				'message' => '有効な画像ファイルを指定してください',
			)
		),
		'count' => array(
			'range' => array(
				'rule' => array('range', 0, 999),
				'message' => '冊数は999までの数値で入力してください',
			)
		),
		'publication_date' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => '出版年は必須です'
			),
			'date' => array(
				'rule' => 'date',
				'message' => '有効な日付を YY-MM-DD フォーマットで入力してください'
			)
		),
		'isbn' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'ISBNは必須です'
			),
			'regex' => array(
				'rule' => '/(^\d{10}$)|(^\d{13}$)/',
				'message' => '10桁または13桁の数値で入力してください'
			),
			'isUnique' => array(
				'rule' => 'isUnique',
				'message' => 'そのISBNはすでに登録されています'
			)
		)
	);
	public $fieldList = array(
		'title',
		'author',
		'publisher',
		'publication_date',
		'isbn',
		'count'
	);
	public function getIdByIsbn($isbn) {
		$data = $this->find('first', array(
			'conditions' => array(
				'BookInfo.isbn' => $isbn
			),
			'fields' => array(
				'BookInfo.id'
			)
		));
		if (empty($data)) {
			return null;
		} else {
			return $data['BookInfo']['id'];
		}
	}
	public function edit($request, $id, $apply = false) {
		$request = $request['BookInfo'];
		$saveData = [];
		// filedListで指定されたアイテムだけを取り出す。
		foreach ($this->fieldList as $value) {
			if (isset($request[$value])) {
				$saveData[$value] = $request[$value];
			}
		}

		// 編集の場合、IDがあるか確認する
		if ($id !== null) {
			$count = $this->find('count', array(
				'conditions' => array(
					'BookInfo.id' => $id
				)
			));
			if ($count == 0) {
				return false;
			} else {
				$saveData['id'] = $id;
			}
		}
		// サムネイルの情報が送られてくれば、tmpnameを作成する
		if (!empty($request['image']['name'])) {
			preg_match('/^.+\.(.+)$/', $request['image']['name'], $extension);
			$saveData['thumbnail_name'] = md5(microtime() . $request['image']['name']) . '.' .$extension[1];
		}
		// 保存準備
		if ($apply === false) {
			$saveData['is_purchased'] = false;
			$dataSource = $this->getDataSource();
			$dataSource->begin();

		} else {
			$saveData['is_purchased'] = true;
		}
		// トランザクションの開始
		
		if ($this->save($saveData)) {
			if (!empty($request['image']['tmp_name'])) {
				if (move_uploaded_file($request['image']['tmp_name'], IMAGES . DS . 'book_thumbnail' . DS .$saveData['thumbnail_name']))
				{
					$saveSuccess = true;
				} else {
					$saveSuccess = false;
				}
			} else {
				$saveSuccess = true;
			}

		} else {
			$saveSuccess = false;
		}
		// セーブに成功したらコミット、失敗したらロールバック
		if ($apply === false) {
			if ($saveSuccess === true) {
				$dataSource->commit();
			} else {
				$dataSource->rollback();
			}
		}
		return $saveSuccess;


	}
	public function getBookList() {
		$result = $this->find('all');
		return $result;
	}
	public function findById($id) {
		$data = parent::findById($id);
		$data['BookInfo']['publication_date'] = date('Y/m/d', strtotime($data['BookInfo']['publication_date']));
		return $data;
	}
	public function getRentalBooks() {
		return $this->find('all', array(
			'conditions' => array(
				'NOT' => array('BookInfo.publication_date' => null)
			),
			'fields' => array(
				'BookInfo.id',
				'BookInfo.title',
				'BookInfo.publisher',
				'thumbnail_name'
			)
		));
	}
	// 本の総数を返す
	public function getBookTotal($id) {
		if (!$this->exists($id)) {
			return 0;
		}
		$data = $this->find('first', array(
			'conditions' => array(
				'BookInfo.id' => $id
			),
			'fields' => array(
				'BookInfo.count'
			)
		));
		return (int)$data['BookInfo']['count'];
	}
}