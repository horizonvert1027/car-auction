<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Document</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		<a class="navbar-brand" href="#">Start Bootstrap</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Notification
						<span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Buy Product</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url()." "?>">Sell Product</a>
				</li>
				<li class="nav-item">
					<div class="btn-group">
						<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							My Account
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?php echo base_url()." "?>">Profile</a>
							<a class="dropdown-item" href="<?php echo base_url()." "?>">Change Password</a>
							<a class="dropdown-item" href="<?php echo base_url()." "?>">Order</a>
							<div class="dropdown-divider"></div>

							<a class="dropdown-item" href="<?php echo base_url()." "?>">Logout</a>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="container pt-5">
	<div class="col pt-5">
		<div class="row">
			<div class="col mb-3">
				<div class="card">
					<div class="card-body">
						<div class="e-profile">
							<div class="row justify-content-center align-items-center">
								<div class="col-12 col-sm-auto mb-3">
								</div>
								<div class="row">
									<div class="col">
										<div class="mb-2"><b>Change Password</b></div>
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label>Current Password</label>
													<input class="form-control" type="password" placeholder="••••••">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label>New Password</label>
													<input class="form-control" type="password" placeholder="••••••">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<div class="form-group">
													<label>Confirm <span class="d-none d-xl-inline">Password</span></label>
													<input class="form-control" type="password" placeholder="••••••"></div>
											</div>
										</div>
										<div class="row">
											<div class="col pl-5">
												<button class="btn btn-primary" type="submit">Save Changes</button>
											</div>
										</div>
									</div>
								</div>




							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
