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
	public function edit($request, $id) {
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
		$dataSource = $this->getDataSource();
		// トランザクションの開始
		$dataSource->begin();
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
		if ($saveSuccess === true) {
			$dataSource->commit();
		} else {
			$dataSource->rollback();
		}


	}
	public function getBookList() {
		$result = $this->find('all');
		return $result;
	}

}