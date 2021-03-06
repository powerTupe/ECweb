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
                    <li><a href="index.php">HOME</a></li>
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
            <!--section has been started-->
            <section>
                <div class="slideshow-container">

  
                    <div class="mySlides fade">
                        <div class="numbertext">1 / 4</div>
                        <img src="../images/download%20(1).jfif" style="width:100%">
                    </div>

                    <div class="mySlides fade">
                        <div class="numbertext">2 / 4</div>
                        <img src="../images/download.jfif" style="width:100%">
                    </div>
                    <div class="mySlides fade">
                        <div class="numbertext">3 / 4</div>
                        <img src="../images/images%20(1).jfif" style="width:100%">
                    </div>
                    <div class="mySlides fade">
                        <div class="numbertext">4 / 4</div>
                        <img src="../images/images.jfif" style="width:100%">
                    </div>
                </div>
            </section>
            <div class="shopping">
                <h1>lets get into shopping!!</h1>
                <h3>mobile today...</h3>
                
                <?php
				$query = "SELECT * FROM tbl_product ORDER BY id ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			    <div class="col-md-4">
				<form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
					<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px;" align="center">
						<img src="images/<?php echo $row["image"]; ?>" class="img-responsive" /><br />

						<h4 class="text-info"><?php echo $row["name"]; ?></h4>

						<h4 class="text-danger">$ <?php echo $row["price"]; ?></h4>

						<input type="text" name="quantity" value="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px;" class="btn btn-success" value="Add to Cart" />

					</div>
				</form>
			    </div>
                <?php
					}
				}
			?>
               
                <h3>laptop today...</h3>
                  <div class="shopping-cards">
                    <div class="card" data-aos="zoom-in-right">
                        <h4>offer</h4>
                        <img src="../images/hp-14q-cy0006au-7qg88pa-laptop-amd-dual-core-a9-4-gb-256-gb-ssd-windows-10-135138-v3-small-1.jpg">
                        <p id="name">HP 14q-cy0006au (7QG88PA) Laptop</p>
                        <p>get up to<b> 15%</b>off</p>
                        <p id="blue">Price = 20,990/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                      <div class="card" data-aos="zoom-in-right">
                        <h4>offer</h4>
                        <img src="../images/hp-15-ec0062ax-9la60pa-136760-v1-large-1.jpg">
                          <p id="name">HP Pavilion Gaming 15</p>
                        <p>get up to<b> 35%</b>off</p>
                          <p id="blue">Price = 47,990/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                      <div class="card" data-aos="zoom-in-right">
                        <h4>offer</h4>
                        <img src="../images/dell-15-3581-c553103win9-136332-v1-large-1.jpg">
                          <p id="name">Dell Vostro 15</p>
                        <p>get up to<b> 30%</b>off</p>
                          <p id="blue">Price = 27,499/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                      <div class="card" data-aos="zoom-in-right">
                        <h4>offer</h4>
                        <img src="../images/dell%20inspiron.jpg">
                          <p id="name">Dell Inspiron 14</p>
                        <p>get up to<b> 20%</b>off</p>
                          <p id="blue">Price = 25,599/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                      <div class="card" data-aos="zoom-in-right">
                        <h4>offer</h4>
                        <img src="../images/dellllll.jpg">
                          <p id="name">Dell G3 15 </p>
                        <p>get up to<b> 25%</b>off</p>
                          <p id="blue">Price = 51,299/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                    <div class="card" data-aos="zoom-in-right">
                    <h4>offer</h4>
                        <img src="../images/apple%20macbook%20air.jpg">
                        <p id="name">apple macbook air</p>
                        <p>get up to<b> 60%</b>off</p>
                        <p id="blue">Price = 1,14,990/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                    <div class="card" data-aos="zoom-in-right">
                    <h4>offer</h4>
                        <img src="../images/apple%20macbook%20pro.jpg">
                        <p id="name">Apple MacBook Pro </p>
                        <p>get up to<b> 30%</b>off</p>
                        <p id="blue">Price = 1,34,599/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                    <div class="card" data-aos="zoom-in-right">
                    <h4>offer</h4>
                        <img src="../images/lenovo-s145-81n30063in-136733-v1-large-1.jpg">
                        <p id="name">Lenovo Ideapad </p>
                        <p>get up to<b> 40%</b>off</p>
                        <p id="blue">Price = 20,500/-</p>
                        <a href="payment.html">buy now</a>
                    </div>    
                </div>
                <h3>TV Today flat 40% off on all...</h3>
                  <div class="shopping-cards">
                    <div class="card" data-aos="zoom-in-left">
                    <h4>offer</h4>
                        <img src="../images/panasonic1.jpg">
                        <p id="name">Panasonic VIERA </p>
                        <p>get up to<b> 40%</b>off</p>
                        <p id="blue">Price = 15,500/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                      <div class="card" data-aos="zoom-in-left">
                    <h4>offer</h4>
                        <img src="../images/panasonic2.jpg">
                          <p id="name">Panasonic VIERA</p>
                        <p>get up to<b> 40%</b>off</p>
                          <p id="blue">Price = 55,500/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                      <div class="card" data-aos="zoom-in-left">
                    <h4>offer</h4>
                        <img src="../images/sony1.jpg">
                          <p id="name">Sony BRAVIA</p>
                        <p>get up to<b> 40%</b>off</p>
                          <p id="blue">Price = 55,599/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                      <div class="card" data-aos="zoom-in-left">
                    <h4>offer</h4>
                        <img src="../images/sony2.jpg">
                          <p id="name">Sony BRAVIA</p>
                        <p>get up to<b> 40%</b>off</p>
                          <p id="blue">Price = 25,500/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                    <div class="card" data-aos="zoom-in-left">
                    <h4>offer</h4>
                        <img src="../images/mitv1.jpg">
                        <p id="name">Xiaomi Mi TV 4A Pro</p>
                        <p>get up to<b> 40%</b>off</p>
                        <p id="blue">Price = 10,499/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                    <div class="card" data-aos="zoom-in-left">
                    <h4>offer</h4>
                        <img src="../images/samsung%20tv1.jpg">
                        <p id="name">SAMSUNG LED TV</p>
                        <p>get up to<b> 40%</b>off</p>
                        <p id="blue">Price = 17,500/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                    <div class="card" data-aos="zoom-in-left">
                    <h4>offer</h4>
                        <img src="../images/samsung%20tv2.jpg">
                        <p id="name">SAMSUNg LED TV 32Inch</p>
                        <p>get up to<b> 40%</b>off</p>
                        <p id="blue">Price = 14,599/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                    
                </div>
                <h3>trending ....</h3>
                <div class="shopping-cards">
                    <div class="card" data-aos="zoom-out-down">
                    <h4>offer</h4>
                        <img src="../images/115054-v6-nokia-9-mobile-phone-medium-1.jpg">
                        <p id="name">NOKIA 9</p>
                        <p>get up to<b> 40%</b>off</p>
                        <p id="blue">Price = 17,500/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                    <div class="card" data-aos="zoom-out-down">
                    <h4>offer</h4>
                        <img src="../images/dell%20inspiron.jpg">
                        <p id="name">DELL INSPIRON</p>
                        <p>get up to<b> 40%</b>off</p>
                        <p id="blue">Price = 43,500/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                    <div class="card" data-aos="zoom-out-down">
                    <h4>offer</h4>
                        <img src="../images/mitv1.jpg">
                        <p id="name">MI TV</p>
                        <p>get up to<b> 40%</b>off</p>
                        <p id="blue">Price = 10,500/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                    <div class="card" data-aos="zoom-out-down">
                    <h4>offer</h4>
                        <img src="../images/135857-v3-apple-iphone-11-pro-max-mobile-phone-medium-1.jpg">
                        <p id="name">APPLE PRO 11</p>
                        <p>get up to<b> 40%</b>off</p>
                        <p id="blue">Price = 70,549/-</p>
                        <a href="payment.html">buy now</a>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="container-8">
            <div class="container-8-block">
                <div class="container-8-heading">
                    <h1>Latest From Our Blog</h1>
                    <p>The blog that keep you update. Have chek out</p>
                </div>
                <div class="container-8-blog">
                    <div class="blog-1">
                        <img src="../images/download%20(2).jfif" class="img"><br>
                        <span>MON, 07 Apr, 2020</span>
                        <h3>Corona is taking pace in INDIA</h3>
                        <p>Coronavirus live updates: Death to,ll rises to 83,<br>cases climb to 3,577,<br>govt says</p>
                    </div>
                    <div class="blog-2">
                        <img src="../images/modi.webp" class="img"><br>
                        <span>Sun, 05 Apr, 2020</span>
                        <h3>Take a look on modi's advice</h3>
                        <p>PM Modi dials leaders of various political parties,<br> discusses fight against Covid-19</p>
                    </div>
                    <div class="blog-3">
                        <img src="../images/28_MigrantLabourers_K_Asif_12-647x363.webp" class="img"><br>
                        <span>Fri, 27 Mar, 2020</span>
                        <h3>Walking miles from corona</h3>
                        <p>A long walk home for migrant worker in<br> times of coronavirus lockdown </p>
                    </div>
                    <div class="blog-4">
                        <img src="../images/encounter-170x96.webp" class="img"><br>
                        <span>Sun, 05 Apr, 2020</span>
                        <h3>Terrorist Attack</h3>
                        <p>Security forces eliminate 9 terrorists in <br>last 24 hours in Jammu and Kashmir</p>
                    </div>
                </div>
            </div>
        </div>

        <footer>
            <div class="footer-block">
                <div class="footer-block-wrap">
                    <div class="links">
                        <ul>
                            <li id="size6"><h2>Quick links</h2></li>
                            <li>Jobs</li>
                            <li>Brand assests</li>
                            <li>invester relation</li>
                            <li>terms and condition</li>
                        </ul>
                    </div>
                    <div class="links">
                         <ul>
                            <li id="size6"><h2>Quick links</h2></li>
                            <li>Jobs</li>
                            <li>Brand assests</li>
                            <li>invester relation</li>
                            <li>terms and condition</li>
                        </ul>
                    </div>
                    <div class="links">
                         <ul>
                            <li id="size6"><h2>Quick links</h2></li>
                            <li>Jobs</li>
                            <li>Brand assests</li>
                            <li>invester relation</li>
                            <li>terms and condition</li>
                             <li><a href="employee.html" style="text-transform: capitalize; text-decoration: none; color: white;">employee login</a></li>
                        </ul>
                    </div>
                    <div class="links">
                         <ul>
                            <li id="size6"><h2>Follow us</h2></li>
                            <li>connect with us</li>
                            
                        </ul>
                    </div>
                    <div class="links">
                        <h4>NEWSLETTER</h4>
                        <input type="email" placeholder="Enter the email" /><span>-></span>
                    </div>
                </div>
            </div>
        </footer>
        
        <script>AOS.init();</script>
        <script src="../js/main.js"></script>
        </div>
    </body>
</html>
}
}}
?>