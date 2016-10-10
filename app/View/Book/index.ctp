<?php 
$this->assign('title', 'Little Library - BookList -');
?>


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