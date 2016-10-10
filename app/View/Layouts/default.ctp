
<!DOCTYPE html>
<html>
<head>
	<!-- Page Title -->
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/js/materialize.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="/css/default.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- JavaScript -->
	<?php echo $this->fetch('script') ?>
</head>
<body>
	<!-- Header -->
	<?php echo $this->element('Header'); ?>
	<!-- Content -->
	<?php echo $this->fetch('content');?>
</body>
</html>
