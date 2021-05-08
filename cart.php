<?php 
session_start();
$connect = mysqli_connect("localhost", "root", "", "ecommerce");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="index.php"</script>';
			}
		}
	}
}
?>
<!docktype html>
<html>
    <head>
        <link rel="stylesheet" href="../css/style.css">
        <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Acme&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        
    </head>
    <body>
	<div class="main-container">
            
            <header>
                <div class="nav-container">
                    <div class="nav-logo">
                        <img src="../images/shop.png"><span>CheapMart</span>
                    </div>
                    <div class="nav-search">
                        <input type="text" placeholder="search...">
                    </div>
                      <div class="header-set2">
                        <ul id="nav-links">
                    <li><a href="#">HOME</a></li>
                    <li><a href="#">ABOUT</a>
                    </li>
                   <li><a href="#">LAPTOP</a>
                        <ul>
                            <li><a href="#">HP</a></li>   <li><a href="#">DELL</a></li>
                            <li><a href="#">LENOVO</a></li>
                            <li><a href="#">APPLE</a></li>
                        </ul>
                    </li>
                    <li><a href="#">MOBILE</a>
                        <ul>
                            <li><a href="#">MI</a></li>
                            <li><a href="#">SAMSUNG</a></li>
                            <li><a href="#">NOKIA</a></li>
                            <li><a href="#">APPLE</a></li>
                        </ul>
                    </li>
                    <li><a href="#">TV</a>
                        <ul>
                            <li><a href="#">PANASONIC</a></li>
                            <li><a href="#">SONY</a></li>
                            <li><a href="#">SAMSUNG</a></li>
                            <li><a href="#">MI</a></li>
                        </ul>
                    </li>
                    <li><a href="cart.php">Cart</a>
                        
                    </li>
                    <li><a href="sign-up.html">SIGN-UP</a>
                        
                    </li>
                    
                </ul>
            </div>
                </div>
            </header>
        <h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
            </div>
			<h3><a href="payment.html"><centre>Buy Now</centre></a></h3>
			</div>
    </body>
</html>