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
	<?php echo $this->element('Header'); ?>
	<h1>本一覧</h1>
		<?php 
			$total = count($data);
			$rowMax = (int)($total / 3) + 1;
			for ($rowNum =  0; $rowNum < $rowMax; $rowNum ++) :
		?>
		<div class="row">
				<?php
				for ($columnNum = 0; $columnNum < 3 && $rowNum * 3 + $columnNum < $total; $columnNum ++) {
					$index = $rowNum * 3 + $columnNum;
					  echo $this->element('BookCard', array('data' => $data[(int)($index)]));
				}
				?>
		</div>
		<?php
			endfor;
		?>
</body>
</html>