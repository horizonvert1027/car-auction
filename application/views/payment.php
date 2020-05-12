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

<div class="container py-5">




	<div class="row">
		<div class="col-lg-7 mx-auto">
			<div class="bg-white rounded-lg shadow-sm p-5">
				<!-- Credit card form tabs -->
				<ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
					<li class="nav-item">
						<a data-toggle="pill" href="#nav-tab-card" class="nav-link active rounded-pill">
							<i class="fa fa-credit-card"></i>
							Credit Card
						</a>
					</li>
					<li class="nav-item">
						<a data-toggle="pill" href="#nav-tab-paypal" class="nav-link rounded-pill">
							<i class="fa fa-paypal"></i>
							Paypal
						</a>
					</li>
					<li class="nav-item">
						<a data-toggle="pill" href="#nav-tab-bank" class="nav-link rounded-pill">
							<i class="fa fa-university"></i>
							Bank Transfer
						</a>
					</li>
				</ul>
				<!-- End -->


				<!-- Credit card form content -->
				<div class="tab-content">

					<!-- credit card info-->
					<div id="nav-tab-card" class="tab-pane fade show active">
						<p class="alert alert-success">Some text success or error</p>
						<form role="form">
							<div class="form-group">
								<label for="username">Full name (on the card)</label>
								<input type="text" name="username" placeholder="Jason Doe" required class="form-control">
							</div>
							<div class="form-group">
								<label for="cardNumber">Card number</label>
								<div class="input-group">
									<input type="text" name="cardNumber" placeholder="Your card number" class="form-control" required>
									<div class="input-group-append">
                    <span class="input-group-text text-muted">
                                                <i class="fa fa-cc-visa mx-1"></i>
                                                <i class="fa fa-cc-amex mx-1"></i>
                                                <i class="fa fa-cc-mastercard mx-1"></i>
                                            </span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-8">
									<div class="form-group">
										<label><span class="hidden-xs">Expiration</span></label>
										<div class="input-group">
											<input type="number" placeholder="MM" name="" class="form-control" required>
											<input type="number" placeholder="YY" name="" class="form-control" required>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-group mb-4">
										<label data-toggle="tooltip" title="Three-digits code on the back of your card">CVV
											<i class="fa fa-question-circle"></i>
										</label>
										<input type="text" required class="form-control">
									</div>
								</div>



							</div>
							<button type="button" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Confirm  </button>
						</form>
					</div>
					<!-- End -->

					<!-- Paypal info -->
					<div id="nav-tab-paypal" class="tab-pane fade">
						<p>Paypal is easiest way to pay online</p>
						<p>
							<button type="button" class="btn btn-primary rounded-pill"><i class="fa fa-paypal mr-2"></i> Log into my Paypal</button>
						</p>
						<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						</p>
					</div>
					<!-- End -->

					<!-- bank transfer info -->
					<div id="nav-tab-bank" class="tab-pane fade">
						<h6>Bank account details</h6>
						<dl>
							<dt>Bank</dt>
							<dd> THE WORLD BANK</dd>
						</dl>
						<dl>
							<dt>Account number</dt>
							<dd>7775877975</dd>
						</dl>
						<dl>
							<dt>IBAN</dt>
							<dd>CZ7775877975656</dd>
						</dl>
						<p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						</p>
					</div>
					<!-- End -->
				</div>
				<!-- End -->

			</div>
		</div>
	</div>
</div>

<!-- Footer -->
<footer class="py-5 bg-dark">
	<div class="container">
		<p class="m-0 text-center text-white">Website 2020 :)</p>
	</div>
	<!-- /.container -->
</footer>


<script>
	$(function() {
		$('[data-toggle="tooltip"]').tooltip()
	})
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



</body>
</html>
