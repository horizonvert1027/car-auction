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
	<div class="row">
		<div class="col-xs-12">
			<div class="text-xs-center">
				<i class="fa fa-search-plus float-xs-left icon"></i>
				<h2>Invoice for purchase #33221</h2>
			</div>
			<hr>
			<div class="row">
				<div class="col-xs-12 col-md-3 col-lg-3 float-xs-left">
					<div class="card  height">
						<div class="card-header">Billing Details</div>
						<div class="card-block">
							<strong>David Peere:</strong><br>
							1111 Army Navy Drive<br>
							Arlington<br>
							VA<br>
							<strong>22 203</strong><br>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-3 col-lg-3">
					<div class="card  height">
						<div class="card-header">Payment Information</div>
						<div class="card-block">
							<strong>Card Name:</strong> Visa<br>
							<strong>Card Number:</strong> ***** 332<br>
							<strong>Exp Date:</strong> 09/2020<br>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-3 col-lg-3">
					<div class="card  height">
						<div class="card-header">Order Preferences</div>
						<div class="card-block">
							<strong>Gift:</strong> No<br>
							<strong>Express Delivery:</strong> Yes<br>
							<strong>Insurance:</strong> No<br>
							<strong>Coupon:</strong> No<br>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-3 col-lg-3 float-xs-right">
					<div class="card  height">
						<div class="card-header">Shipping Address</div>
						<div class="card-block">
							<strong>David Peere:</strong><br>
							1111 Army Navy Drive<br>
							Arlington<br>
							VA<br>
							<strong>22 203</strong><br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card ">
				<div class="card-header">
					<h3 class="text-xs-center"><strong>Order summary</strong></h3>
				</div>
				<div class="card-block">
					<div class="table-responsive">
						<table class="table table-sm">
							<thead>
							<tr>
								<td><strong>Item Name</strong></td>
								<td class="text-xs-center"><strong>Item Price</strong></td>
								<td class="text-xs-center"><strong>Item Quantity</strong></td>
								<td class="text-xs-right"><strong>Total</strong></td>
							</tr>
							</thead>
							<tbody>
							<tr>
								<td>Samsung Galaxy S5</td>
								<td class="text-xs-center">$900</td>
								<td class="text-xs-center">1</td>
								<td class="text-xs-right">$900</td>
							</tr>
							<tr>
								<td>Samsung Galaxy S5 Extra Battery</td>
								<td class="text-xs-center">$30.00</td>
								<td class="text-xs-center">1</td>
								<td class="text-xs-right">$30.00</td>
							</tr>
							<tr>
								<td>Screen protector</td>
								<td class="text-xs-center">$7</td>
								<td class="text-xs-center">4</td>
								<td class="text-xs-right">$28</td>
							</tr>
							<tr>
								<td class="highrow"></td>
								<td class="highrow"></td>
								<td class="highrow text-xs-center"><strong>Subtotal</strong></td>
								<td class="highrow text-xs-right">$958.00</td>
							</tr>
							<tr>
								<td class="emptyrow"></td>
								<td class="emptyrow"></td>
								<td class="emptyrow text-xs-center"><strong>Shipping</strong></td>
								<td class="emptyrow text-xs-right">$20</td>
							</tr>
							<tr>
								<td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
								<td class="emptyrow"></td>
								<td class="emptyrow text-xs-center"><strong>Total</strong></td>
								<td class="emptyrow text-xs-right">$978.00</td>
							</tr>
							</tbody>
						</table>
					</div>
				</div>
				<button>
					<p>Convert to pdf and send to email?</p>
				</button>
			</div>
		</div>
	</div>
</div>

<style>
	.height {
		min-height: 200px;
	}

	.icon {
		font-size: 47px;
		color: #5CB85C;
	}

	.iconbig {
		font-size: 77px;
		color: #5CB85C;
	}

	.table > tbody > tr > .emptyrow {
		border-top: none;
	}

	.table > thead > tr > .emptyrow {
		border-bottom: none;
	}

	.table > tbody > tr > .highrow {
		border-top: 3px solid;
	}
</style>

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
