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
			Materialize.updateTextFields();
		});
	</script>
</head>
<body>
	<?php echo $this->element('first', array('comment' => 'elementにvalueを渡すこともできる')); ?>
	<h1></h1>
	<h2>SubTitle</h2>
		<div class="row">
			<form class="col s12">
			<div class="row">
				<div class="input-field col s6">
				<input placeholder="Placeholder" id="first_name" type="text" class="validate">
				<label for="first_name">First Name</label>
				</div>
				<div class="input-field col s6">
				<input id="last_name" type="text" class="validate">
				<label for="last_name">Last Name</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
				<input disabled value="I am not editable" id="disabled" type="text" class="validate">
				<label for="disabled">Disabled</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
				<input id="password" type="password" class="validate">
				<label for="password">Password</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
				<input id="email" type="email" class="validate">
				<label for="email">Email</label>
				</div>
			</div>
			</form>
		</div>
</body>
</html>