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
							<li><a href="contactus.html" accesskey="6" title="">Register</a></li>
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
			</div>
<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$name = $address = $salary = $username = $password =  "";
$name_err = $address_err = $salary_err = $username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name723 = trim($_POST["name723"]);
    if(empty($input_name723)){
        $name723_err = "Please enter a name.";
    } elseif(!filter_var($input_name723, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name723_err = "Please enter a valid name.";
    } else{
        $name723 = $input_name723;
    }
    
    // Validate address
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Please enter an address.";     
    } else{
        $address = $input_address;
    }
    
    // Validate salary
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $salary = $input_salary;
    }


        // Validate username
        $input_username = trim($_POST["username"]);
        // Prepare a select statement
        if(empty($input_username)){
            $username_err = "Please enter a username.";
        } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', $input_username)){
            $username_err = "Username can only contain letters, numbers, and underscores.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM employees WHERE username = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_username);
                
                // Set parameters
                $param_username = $input_username ;
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_err = "This username is already taken.";
                    } else{
                        $username =  $input_username ;
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    
        

    $input_password = trim($_POST["password"]);
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } else{
        $password = $input_password;
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err) && empty($username_err) && empty($password_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (name723, address, salary,username,password) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_name, $param_address, $param_salary , $param_username, $param_password);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $param_username = $username;
            $param_password = $password;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>

    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

    <div class="hero">
      <div class="container">
        <h1>Welcome To Luca's Bread</h1>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Maiores, consequuntur?</p>
      </div>
    </div>    
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea>
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Salary</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                            <span class="invalid-feedback"><?php echo $username_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                            <span class="invalid-feedback"><?php echo $password_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
 <!--================ start footer Area  =================-->	
 <footer class="footer-area p_120">
  <div class="container">
      
          <div class="col-lg-4 col-md-6 col-sm-6">
              <aside class="f_widget news_widget">
        <p>Stay updated with our latest trends</p>
        <div id="mc_embed_signup">
                      <form target="_blank" action="" method="get" class="subscribe_form relative">
                        <div class="input-group d-flex flex-row">
                              <input name="EMAIL" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address '" required="" type="email">
                              <button class="btn sub-btn"><span class="lnr lnr-arrow-right"></span></button>		
                          </div>				
                          <div class="mt-10 info"></div>
                      </form>
                  </div>
      </aside>
          </div>
      </div>
      <div class="row footer-bottom d-flex justify-content-between align-items-center">
      <div class="col-md-3 morb">
      <div class="footer" id="contact">
		<div class="container">
			<div class="col-md-3 nam">
				<h4>Namlacus dingi</h4>
					<ul class="number">
						<li><span><i class="phone"> </i>phone:(000) 888 88888</span>
						</li><li><a href="mailto:info@example.com"><i class="mail"> </i>info@sitename.com </a></li>					
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
