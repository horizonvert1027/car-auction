<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Dashboard</title>
</head>
<style>
	body {
		background: #f5f5f5;
	}

	.rounded-lg {
		border-radius: 1rem;
	}

	.nav-pills .nav-link {
		color: #555;
	}

	.nav-pills .nav-link.active {
		color: #fff;
	}
</style>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	<div class="container">
		<a class="navbar-brand" href="<?php echo base_url()."dashboard" ?>">Start Bootstrap</a>
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
					<a class="nav-link" href="<?php echo base_url()."product/sell" ?>">Sell Product</a>
				</li>
				<li class="nav-item">
					<div class="btn-group">
						<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							My Account
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?php echo base_url(); ?>user/profile">Profile</a>
							<a class="dropdown-item" href="<?php echo base_url()." "?>">Change Password</a>
							<a class="dropdown-item" href="<?php echo base_url()." "?>">Order</a>
							<div class="dropdown-divider"></div>

							<a class="dropdown-item" href="<?php echo base_url(); ?>user/logout">Logout</a>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="col-md-8 order-md-1">
		<h4 class="mb-3">Billing address</h4>
		<form class="needs-validation" novalidate="">
			<div class="row">
				<div class="col-md-6 mb-3">
					<label for="firstName">First name</label>
					<input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
					<div class="invalid-feedback"> Valid first name is required. </div>
				</div>
				<div class="col-md-6 mb-3">
					<label for="lastName">Last name</label>
					<input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
					<div class="invalid-feedback"> Valid last name is required. </div>
				</div>
			</div>
			<div class="mb-3">
				<label for="username">Username</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">@</span>
					</div>
					<input type="text" class="form-control" id="username" placeholder="Username" required="">
					<div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
				</div>
			</div>
			<div class="mb-3">
				<label for="email">Email <span class="text-muted">(Optional)</span></label>
				<input type="email" class="form-control" id="email" placeholder="you@example.com">
				<div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
			</div>
			<div class="mb-3">
				<label for="address">Address</label>
				<input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
				<div class="invalid-feedback"> Please enter your shipping address. </div>
			</div>
			<div class="mb-3">
				<label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
				<input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
			</div>
			<div class="row">
				<div class="col-md-5 mb-3">
					<label for="country">Country</label>
					<select class="custom-select d-block w-100" id="country" required="">
						<option value="">Choose...</option>
						<option>United States</option>
					</select>
					<div class="invalid-feedback"> Please select a valid country. </div>
				</div>
				<div class="col-md-4 mb-3">
					<label for="state">State</label>
					<select class="custom-select d-block w-100" id="state" required="">
						<option value="">Choose...</option>
						<option>California</option>
					</select>
					<div class="invalid-feedback"> Please provide a valid state. </div>
				</div>
				<div class="col-md-3 mb-3">
					<label for="zip">Zip</label>
					<input type="text" class="form-control" id="zip" placeholder="" required="">
					<div class="invalid-feedback"> Zip code required. </div>
				</div>
			</div>
			<hr class="mb-4">
			<div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input" id="same-address">
				<label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
			</div>
			<div class="custom-control custom-checkbox">
				<input type="checkbox" class="custom-control-input" id="save-info">
				<label class="custom-control-label" for="save-info">Save this information for next time</label>
			</div>

			<div class="container">
				<div class="col-md-8 order-md-1">
					<h4 class="mb-3">Billing address</h4>
					<form class="needs-validation" novalidate="">
						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="firstName">First name</label>
								<input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
								<div class="invalid-feedback"> Valid first name is required. </div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="lastName">Last name</label>
								<input type="text" class="form-control" id="lastName" placeholder="" value="" required="">
								<div class="invalid-feedback"> Valid last name is required. </div>
							</div>
						</div>
						<div class="mb-3">
							<label for="username">Username</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">@</span>
								</div>
								<input type="text" class="form-control" id="username" placeholder="Username" required="">
								<div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
							</div>
						</div>
						<div class="mb-3">
							<label for="email">Email <span class="text-muted">(Optional)</span></label>
							<input type="email" class="form-control" id="email" placeholder="you@example.com">
							<div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
						</div>
						<div class="mb-3">
							<label for="address">Address</label>
							<input type="text" class="form-control" id="address" placeholder="1234 Main St" required="">
							<div class="invalid-feedback"> Please enter your shipping address. </div>
						</div>
						<div class="mb-3">
							<label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
							<input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
						</div>
						<div class="row">
							<div class="col-md-5 mb-3">
								<label for="country">Country</label>
								<select class="custom-select d-block w-100" id="country" required="">
									<option value="">Choose...</option>
									<option>United States</option>
								</select>
								<div class="invalid-feedback"> Please select a valid country. </div>
							</div>
							<div class="col-md-4 mb-3">
								<label for="state">State</label>
								<select class="custom-select d-block w-100" id="state" required="">
									<option value="">Choose...</option>
									<option>California</option>
								</select>
								<div class="invalid-feedback"> Please provide a valid state. </div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="zip">Zip</label>
								<input type="text" class="form-control" id="zip" placeholder="" required="">
								<div class="invalid-feedback"> Zip code required. </div>
							</div>
						</div>
						<button>
							<a href="">Check Out</a>
						</button>
<!-- Footer -->
<footer class="py-5 bg-dark">
	<div class="container">
		<p class="m-0 text-center text-white">Website 2020 :)</p>
	</div>
	<!-- /.container -->
</footer>



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



</body>
</html>
