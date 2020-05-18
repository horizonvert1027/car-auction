<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<title>Dashboard</title>
	<style>
		.quantity {
			float: left;
			margin-right: 15px;
			background-color: #eee;
			position: relative;
			width: 80px;
			overflow: hidden
		}

		.quantity input {
			margin: 0;
			text-align: center;
			width: 15px;
			height: 15px;
			padding: 0;
			float: right;
			color: #000;
			font-size: 20px;
			border: 0;
			outline: 0;
			background-color: #F6F6F6
		}

		.quantity input.qty {
			position: relative;
			border: 0;
			width: 100%;
			height: 40px;
			padding: 10px 25px 10px 10px;
			text-align: center;
			font-weight: 400;
			font-size: 15px;
			border-radius: 0;
			background-clip: padding-box
		}

		.quantity .minus, .quantity .plus {
			line-height: 0;
			background-clip: padding-box;
			-webkit-border-radius: 0;
			-moz-border-radius: 0;
			border-radius: 0;
			-webkit-background-size: 6px 30px;
			-moz-background-size: 6px 30px;
			color: #bbb;
			font-size: 20px;
			position: absolute;
			height: 50%;
			border: 0;
			right: 0;
			padding: 0;
			width: 25px;
			z-index: 3
		}

		.quantity .minus:hover, .quantity .plus:hover {
			background-color: #dad8da
		}

		.quantity .minus {
			bottom: 0
		}
		.shopping-cart {
			margin-top: 20px;
		}
	</style>
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-fixed-top">
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

<!-- Page Content -->
<div class="container">
	<div class="card shopping-cart">
		<div class="card-header bg-dark text-light">
			<i class="fa fa-shopping-cart" aria-hidden="true"></i>
			Shipping cart
			<a href="<?php echo base_url('dashboard') ?>" class="btn btn-outline-info btn-sm pull-right">Continue shopping</a>
			<div class="clearfix"></div>
		</div>
		<div class="card-body">

			<!-- PRODUCT -->
			<?php foreach($items as $item) { ?>
			<div class="row cart-item" id="<?php echo "item_" . $item['id']; ?>">
				<div class="col-12 col-sm-12 col-md-2 text-center">
					<img class="img-responsive" src="<?php echo base_url().'assets/images/products/'.$item['image']; ?>" alt="prewiew" width="120" height="80">
				</div>
				<div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
					<h4 class="product-name"><strong><?php echo $item["name"]; ?></strong></h4>
					<h4>
						<small><?php echo $item["description"]; ?></small>
					</h4>
				</div>
				<div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
					<div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
						<h6><strong class="price"><?php echo $item["bid_price"]; ?></strong><span class="text-muted"> x</span></h6>
					</div>
					<div class="col-4 col-sm-4 col-md-4">
						<div class="quantity">
							<input type="number" step="1" max="99" min="1" value=<?php echo $item["quantity"]; ?> title="Qty" class="qty"
								   size="4">
						</div>
					</div>
					<div class="col-2 col-sm-2 col-md-2 text-right">
						<button onclick="remove_item(<?php echo $item['id']; ?>)" type="button" class="btn btn-outline-danger btn-xs">
							<i class="fa fa-trash" aria-hidden="true"></i>
						</button>
					</div>
				</div>
			</div>
			<hr>
			<?php } ?>
			<!-- END PRODUCT -->

			<div class="pull-right">
				<button onclick="update_cart()" class="btn btn-outline-secondary pull-right">
					Update shopping cart
				</button>
			</div>
		</div>
		<div class="card-footer">
			<div class="pull-right" style="margin: 10px">
				<a href="<?php echo base_url('/cart/checkout'); ?>" class="btn btn-success pull-right">Checkout</a>
				<div class="pull-right" style="margin: 5px">
					Total price: <b id="total_price">50.00€</b>
				</div>
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

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    let items = [];
    let total_price = 0;

    $( document ).ready(function() {
        update_cart();
    });

	function update_cart() {
        update_items();

		$("#total_price").text(total_price + "€");

        $.ajax({
            url:"<?php echo base_url(); ?>cart/update",
            method:"POST",
            data: { "items" : items },
            success:function(data){
			}
        });

        items = [];
        total_price = 0;
	}

	function remove_item(id) {
		$("#item_" + id).hide();
	}

	function update_items() {
        $(".cart-item").each(function(index) {
            let price = parseInt($(this).find(".price").text());
            let quantity = parseInt($(this).find(".qty").val());
            total_price += price * quantity;

            let item_data = {};
            item_data['id'] = $(this).attr('id').split("_")[1];
            item_data['quantity'] = quantity;
            item_data['is_deleted'] = false;
            if ($(this).is(":hidden")) {
                item_data['is_deleted'] = true;
            }
            items.push(item_data);
        });
	}

</script>


</body>
</html>
