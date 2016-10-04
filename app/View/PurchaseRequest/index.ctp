<!DOCTYPE html>
<html>
<head>

	<title>
	</title>
	<script type="text/javascript" src="/js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="/js/materialize.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
	
	<h1>図書購入申請一覧</h1>
		<?php 
            $numMax = (int)count($data);
			$rowMax = (int)($numMax / 3) + 1;
			for ($rowNum =  0; $rowNum < $rowMax; $rowNum ++) :
		?>
		<div class="row">
				<?php
				for ($columnNum = 0; 
					$columnNum < 3 && $columnNum + $rowNum * 3 < $numMax;
					$columnNum ++) {
					$index = $rowNum * 3 + $columnNum;
				 	 echo $this->element('BookCard', array('data' => $data[(int)($index)]));
				}
				?>
		</div>
		<?php
			endfor;
		?>
		<a class="waves-effect waves-light btn" id="send_button" href="/PurchaseRequest/add"><i class="material-icons left">send</i>購入申請</a>
</body>
</html>