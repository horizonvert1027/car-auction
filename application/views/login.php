<!DOCTYPE html>
<html>
<head>
	<title>Car auction</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
<div class="container">
	<br />
	<h3 align="center">Complete User Registration and Login System in Codeigniter</h3>
	<br />
	<div class="panel panel-default">
		<div class="panel-body">
			<?php
			if($this->session->flashdata('message'))
			{
				echo '
                    <div class="alert alert-success">
                        '.$this->session->flashdata("message").'
                    </div>
                    ';
			}
			?>
			<form method="post" action="<?php echo base_url(); ?>login/validation">
				<div class="form-group">
					<label>Enter Email Address</label>
					<input type="text" name="user_email" class="form-control" value="<?php echo set_value('email'); ?>" />
					<span class="text-danger"><?php echo form_error('email'); ?></span>
				</div>
				<div class="form-group">
					<label>Enter Password</label>
					<input type="password" name="user_password" class="form-control" value="<?php echo set_value('password'); ?>" />
					<span class="text-danger"><?php echo form_error('password'); ?></span>
				</div>
				<div class="form-group">
					<input type="submit" name="login" value="Login" class="btn btn-info" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url(); ?>register">Register</a>
				</div>
				<div class="form-group">
					<a href="<?php echo base_url(); ?>login/reset_password">Forgot your password?</a>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
