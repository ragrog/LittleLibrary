<!DOCTYPE html>
<html>
<head>

	<title>
		<?php echo $data['BookInfo']['title']; ?>
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
	<pre>
	<?php var_dump($data); ?>
	</pre>

</body>
</html>