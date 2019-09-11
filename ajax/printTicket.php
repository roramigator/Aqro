
<!--DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.table-borderless td,
		.table-borderless th{
    		border: 0 !important
		}
	</style>
	<script type="text/javascript" src="js/barcode.js"></script>
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.5-dist/css/bootstrap.css"/>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="table-responsive">
					<table class="table">
						<tr>
							<td class="text-center">
								<img src="img/logo.jpg" width="100"><br>
								<svg id="barcode"></svg>
							</td>
						</tr>
						<tr>
							<td><?php #echo date('d-m-Y'); ?></td>
						</tr>
						<tr>
							<td>
							<table class="table table-borderless">
								<?php
									#include("db_connection.php");
									#$user_id=$_POST['id'];
									#echo $user_id;
								?>
								<tr>
									<td>Operation</td>
									<td>$300.00</td>
								</tr>
								<tr>
									<td>Tools</td>
									<td>$50.00</td>
								</tr>
								<tr>
									<td>Total</td>
									<td>$350.00</td>
								</tr>
							</table>
							</td>
						</tr>
						<tr class="text-center">
							<td>Thank you</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<button onclick="window.print()" class="btn btn-default"><span class="glyphicon glyphicon-print"></span></button>
	</div>
	<script type="text/javascript">
		var code = 100000001;
		JsBarcode("#barcode", code, {
  			fontSize: 10,
  			width: 1,
  			height: 30
		});
	</script>
</body>
</html-->
