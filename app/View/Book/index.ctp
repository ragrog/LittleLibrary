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
	
	<h1>本一覧</h1>
	<div class="row">
		<?php 
			$rowMax = (int)(count($data) / 3);
			for ($rowNum =  0; $rowNum < $rowMax; $rowNum ++)
			{
				for ($columnNum = 0; $columnNum < 3; $columnNum ++) {
					$index = $rowNum * 3 + $columnNum;
					  echo $this->element('BookCard', array('data' => $data[(int)($index)]));
				}
			}
		?>
	</div>
</body>
</html>