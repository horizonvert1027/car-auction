<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<title>Detail Product</title>
</head>
<body>
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

<div class="container pt-5">
	<table>
		<tr>
			<img src='<?= base_url() ?>assets/images/users/<?= $product['image'] ?>' alt="user_image">
		</tr>
		<tr>
			<th>Name</th>
			<td><?php echo $product['name'] ?></td>
		</tr>
		<tr>
			<th>Description</th>
			<td><?php echo $product['description'] ?></td>
		</tr>
		<tr>
			<th>Price</th>
			<td><?php echo $product['bid_price'] ?></td>
		</tr>
	</table>

	<div id="comments">
		<h3>Comments</h3>

		<?php foreach($comments as $comment) { ?>
			<div class="row">
				<p><strong><?php echo $comment['username'] ?></strong>: <?php echo $comment['content'] ?></p>
			</div>
		<?php } ?>
	</div>

	<form id="comment_form">
		<div class="form-group">
			<label>Your comment</label>
			<input type="text" name="comment" class="form-control" />
		</div>
		<div class="form-group">
			<input id="send_comment" type="button" name="add_comment" value="Send" class="btn btn-info" />
		</div>
	</form>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
		$("#send_comment").click(function() {
            $.ajax({
                url:"<?php echo base_url(); ?>product/send_comment/<?php echo $product['id']?>",
                method:"POST",
                data:{content: $( "#comment_form input[name='comment']" ).val()},
                success:function(data){
                    console.log(data);
                    $('#comments').append(data);
                }
            })
		});
	});
</script>
</body>
</html>

