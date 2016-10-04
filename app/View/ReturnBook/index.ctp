<!DOCTYPE html>
<html>
<head>

	<title>
	</title>
	<script type="text/javascript" src="/js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="/js/materialize.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type="text/javascript" >
		$(document).ready(function() {

		});
	</script>
</head>
<body>
<?php echo $this->element('Header'); ?>
	<div class="row">
		<?php
		foreach ($data as $key => $value) {
			echo $this->element('RentalBookCard', array('data' => $data[$key]));
		}?>
	<dib>
</body>
</html>