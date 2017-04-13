<?php
	include_once "error.php";
	$msg = isset($_GET['msg']) ? $_GET['msg'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Contact</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/main.css">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<div class="container">
	<div class="col-md-offset-3 col-md-6">
		<form action="contact.php" method="POST">
			<?php if (!is_null($msg)) { ?>
			<div class="alert alert-success">
				<p><i class="fa fa-fw fa-exclamation-triangle"></i> Contact added successfully!</p>
			</div>
			<?php } ?>
			<h3 class="page-header">Contact</h3>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="firstname">Firstname</label>
						<input type="text" name="firstname" id="firstname" class="form-control" required="required" autofocus="autofocus">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="lastname">Lastname</label>
						<input type="text" name="lastname" id="lastname" class="form-control" required="required">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" name="email" id="email" class="form-control" required="required">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="phone">Phone</label>
						<input type="text" name="phone" id="phone" class="form-control">
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label for="state">State</label>
						<input type="text" name="state" id="state" class="form-control">
					</div>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<label for="message">Message</label>
						<textarea class="form-control" name="message" id="message"></textarea>
					</div>
				</div>

				<div class="col-sm-12">
					<button type="submit" class="btn btn-sm btn-success">Save contact</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>