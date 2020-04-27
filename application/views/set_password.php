<!DOCTYPE html>
<html>
<head>
	<title>Complete User Registration and Login System in Codeigniter</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
</head>

<body>
<div class="container">
	<br />
	<h3 align="center">Set your password</h3>
	<br />
	<div class="panel panel-default">
		<div class="panel-heading">Set your password</div>
		<div class="panel-body">
			<?php
			if ($this->session->flashdata('message'))
			{
				echo '
				<div class="alert alert-success">
					'.$this->session->flashdata("message").';
				</div>
				';
			}
			?>
			<form method="post" action="<?php echo base_url(); ?>login/update_password">
				<div class="form-group">
					<label>Your Email Address</label>
					<input type="text" name="user_email" class="form-control" value="<?php echo $email; ?>" readonly="readonly" />
					<span class="text-danger"><?php echo form_error('user_email'); ?></span>
				</div>
				<div class="form-group">
					<label>Enter Password</label>
					<input type="password" name="user_password" class="form-control" value="<?php echo set_value('user_password'); ?>" />
					<span class="text-danger"><?php echo form_error('user_password'); ?></span>
				</div>
				<div class="form-group">
					<input type="submit" name="update_password" value="Update my password" class="btn btn-info" />
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
