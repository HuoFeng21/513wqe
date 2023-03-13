<!DOCTYPE HTML>
<!DOCTYPE HTML>
<html>
<head>
<title>Cappuccino A Resturant Category Flat Bootstarp Resposive Website Template | About :: w3layouts</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Cappuccino Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<script src="js/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
<script type="text/javascript" src="js/move-top.js"></script>
       <script type="text/javascript" src="js/easing.js"></script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},1200);
				});
			});
		</script>
		<script type="text/javascript">
		$(document).ready(function() {
				/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
				*/
		$().UItoTop({ easingType: 'easeOutQuart' });
});
</script>
</head>
<body>
<!-- header -->
 <div class="banner1">
		<div class="header">
		<div class="container">
			<div class="logo">
				<a href="index.html"><img src="images/logo2.png" class="img-responsive" alt="" /></a>
			</div>
				<div class="hader-left">
				<h1><a href="index.html">Luca’s Loaves</a></h1>
				</div>
				<div class="head-nav">
					<span class="menu"> </span>
					<ul class="cl-effect-3">
						<li class="active"><a href="index.html" accesskey="1" title="">Home</a></li>
							<li><a href="aboutus.html" accesskey="2" title="">About US</a></li>
							<li><a href="upload.html" accesskey="3" title="">Careers </a></li>
							<li><a href="orderonline.php" accesskey="4" title="">Order online </a></li>
							<li><a href="contactus.html" accesskey="5" title="">Contact Us</a></li>
							<li><a href="create.php" accesskey="6" title="">Register</a></li>
								<div class="clearfix"> </div>
						</ul>
				</div>
			<div class="clearfix"> </div>
						<!-- script-for-nav -->
					<script>
						$( "span.menu" ).click(function() {
						  $( ".head-nav ul" ).slideToggle(300, function() {
							// Animation complete.
						  });
						});
					</script>
				<!-- script-for-nav --> 	
				</div>				
			</div> 
<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:http://localhost/login.php");
    exit;
}
?>
<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="style.css" rel="stylesheet" type="text/css" media="all" />

</head>
<body>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>


<a id="btnEmpty" href="orderonline.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>	
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="orderonline.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>		
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>

<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="orderonline.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"></div>
			<div class="product-tile-footer">
			<div class="product-title"><?php echo $product_array[$key]["name"]; ?></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			<div> id=<?php echo $product_array[$key]["id"] ; ?> </div>
			<a href='get-product-info.php?id=<?php echo $product_array[$key]["id"] ; ?>' target="_black"> click</a>
			<div> <a href="http://localhost"
           target="popup"
           onclick="window.open('get-product-info.php?id=<?php echo $product_array[$key]["id"] ; ?>','popup','width=300,height=300');return false;">
           Open Link in Popup</a></div>
		    </form>
	</div>
	<?php
		}
	}
	?>
	
</div>

 <a href="http://localhost/welcome.php">
 <button id="button1">logout</button>
 </a>
 
 <div class="footer" id="contact">
		<div class="container">
			<div class="col-md-3 nam">
				<h4>Namlacus dingi</h4>
					<ul class="number">
						<li><span><i class="phone"> </i>phone:(000) 888 88888</span>
						</li><li><a href="mailto:Luca bread@163.com"><i class="mail"> </i>Luca bread@163.com </a></li>						
					</ul>
			</div>
			<div class="col-md-3 set">
				<h4>Setaliquam sil</h4>
					<p>Building name, street number, name of the City, State and Country.</p>
			</div>
			<div class="col-md-3 morb">
				<h4>Morbi odio</h4>
				<div class="stay">
					<div class="stay-left">
						<form>
							<input type="text" placeholder="" required="">
						</form>
					</div>
					<div class="button">
						<form>
							<input type="submit" value="Subscribe">
						</form>
					</div>
						<div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 inte">
				<h4>Integer sagitest</h4>
				<div class="social">
					<ul>
						<li><a href="#"><i class="facebok"> </i></a></li>
						<li><a href="#"><i class="twiter"> </i></a></li>
						<li><a href="#"><i class="in"> </i></a></li>
						<li><a href="#"><i class="pp"> </i></a></li>
						<li><a href="#"><i class="goog"> </i></a></li>
							<div class="clearfix"></div>	
					</ul>
				</div>
			</div>
				<div class="clearfix"></div>
		</div>
	</div>
	<!-- footer -->
<!-- footer -->
	<div class="footer-bottom">
		<div class="container">
			<p>Copyrights © 2015 Cappuccino All rights reserved | Template by <a href="http://w3layouts.com/">W3layouts</a></p>
		</div>
	</div>
<!-- footer -->
</body>
</html>