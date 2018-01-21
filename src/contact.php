<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Ocatgon Project</title>
		<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
		<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
		<!--build:css css/styles.min.css-->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/styles.css">
		<!--endbuild-->
		<link href="https://fonts.googleapis.com/css?family=Alegreya+Sans:700|Lato:700|Poppins|Raleway:700" rel="stylesheet">
	</head>

	<body class="contactform">
		<?php
			
			// echo "<meta http-equiv='refresh' content='0'>";
			$configs = include('config.php');
			// echo json_encode($configs->pass);
			$host = $configs->host;  
			$pass = $configs->pass;  
			$user = $configs->user;  
			$dbname = $configs->dbname; 
			
			
			try {
				$conn = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $pass);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				// echo "connected"; 
				if(isset($_POST['submit'])){
					$firstname = $_POST['firstname'];
					$lastname = $_POST['lastname'];
					$email = $_POST['email'];
					$zipcode = $_POST['zipcode'];
					$state = $_POST['state'];
					$message = $_POST['message'];

					// mail("carla.severe@gmail.com", "Guest Info", $firstname, $lastname, $zipcode, $state, $message); 

					$fnamerror = 'Name must contain letters only. Please click Contact from menu and try again.';
					// $fnamerror2 = 'Please enter a first name.';
					$lnamerror = 'Please enter a valid last name. Please click Contact from menu and try again.';
					// $lnamerror2 = 'Please enter a last name.';
					$emailerror = 'Please enter a valid email address.';
					$ziperror = 'Please enter a valid zipcode.';
					// $ziprror2 = 'Please enter a zipcode';
					// $messerror = 'Please write a message';
					$messerror2 = 'Message is too long';	

					//form validation and redirecting to home page upon successful submission 
					
					if($firstname == ''|| $lastname == '' || $email =='' || $zipcode == '' || $message == ''){
						echo "<div style='display:none;'>Cannot leave fields empty!</div>";
					}elseif(ctype_alpha($firstname) === false && $firstname !='') {
						// echo  "<div style='display:none;'>".$fnamerror."</div>"; 
						echo ''; 
					}elseif(!preg_match('/^([a-zA-Z]+[\'-]?[a-zA-Z]+[ ]?)+$/', $lastname)){
						echo '';
					}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						echo '';
					}elseif(!preg_match('#[0-9]{5}#', $zipcode)){
						echo '';
					}else{
						$insert = $conn->prepare('INSERT INTO guests (firstname, lastname, email, zipcode, state, message)
						values(:firstname,:lastname,:email,:zipcode,:state,:message)');

						$insert->bindParam(':firstname',$firstname);
						$insert->bindParam(':lastname',$lastname);
						$insert->bindParam(':email',$email);
						$insert->bindParam(':zipcode',$zipcode);
						$insert->bindParam(':state',$state);
						$insert->bindParam(':message',$message);
						header("Location:/octagon_projectx/src/");

						$insert->execute();
				
					}
					
				}
				
			}

			catch(PDOException $e){
				echo "error" . $e->getMessage(); 
			}	

		?>

		<nav class="navbar navbar-expand-md">
			<div class="container">
					<img src="./images/logo.png" width = "50" height = "50" alt="">
				<a href="index.php" class="navbar-brand">Phantom Reality</a>
				<button class="navbar-toggler" data-toggle="collapse" data-target="#navNavbar"><span class="icon"><i class="fa fa-bars" aria-hidden="true"></i></span></button>
				<div class="collapse navbar-collapse" id="navNavbar">
					<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<a href="index.php#about" class="nav-link">About</a>
							</li>
							<li class="nav-item">
								<a href="index.php#products" class="nav-link">Products</a>
							</li>
								<li class="nav-item">
									<a href="index.php#news" class="nav-link">News</a>
								</li>
							<li class="nav-item">
								<a href="index.php#careers" class="nav-link">Careers</a>
							</li>
							<li class="nav-item active">
								<a href="contact.php" class="nav-link">Contact</a>
							</li>
						</ul>
				</div>
			</div>
		</nav>

	
		<!-- CONTACT -->
    <section id="contact" class="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <h3>Contact Us</h3>
            <p class="lead text-dark">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe eum tenetur dolores 
            </p>
					
            <form action="" method="POST">

              <div class="form-group">
                <div class="input-group-lg d-flex flex-column">
                  <input type="text" class="form-control" placeholder="First Name" name="firstname" required="required">
									<div style = "color:red;">
										<?php 
											if(isset($firstname)){
												if (ctype_alpha($firstname) === false && $firstname !='') {
													echo  $fnamerror;
												}
												if ($firstname == '') {
													echo $fnamerror2; 
												}
											}
										?>
									</div>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group-lg d-flex flex-column">
                  <input type="text" class="form-control" placeholder="Last Name" name="lastname" required="required">
									<div style="color:red;">
										<?php 
											if(isset($lastname)){
												if(!preg_match('/^([a-zA-Z]+[\'-]?[a-zA-Z]+[ ]?)+$/', $lastname)){
													echo $lnamerror;
												}
											}
										?>
									</div>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group-lg d-flex flex-column">
                  <input type="email" class="form-control" placeholder="Email" name="email" required="required">
									<div style="color:red;">
										<?php 
											if (isset($email)) {
												$email = filter_var($email, FILTER_SANITIZE_EMAIL);
												if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
														echo ''; 
												} else {
														echo  $emailerror;
												}
											}
										?>
									</div>
                </div>
              </div>

              <div class="form-group">
                <div class="input-group-lg d-flex flex-column">
                  <input type="text" class="form-control" placeholder="Zipcode" name="zipcode" required="required">
									<div style="color:red;">
											<?php
													if(isset($zipcode)){
														if (preg_match('#[0-9]{5}#', $zipcode) || $zipcode = '')
														// if (preg_match('#[0-9]{5}#', $zipcode) || $zipcode = '')
															return true;
														else
															echo $ziperror;
													}
											?>
									</div>
                </div>
              </div>

							<div class="form-group">
								<div class="input-group-lg">
									<input type="hidden" value="2">
									<select id="inputState" class="form-control" name="state">
										<option selected>Choose State...</option>
										<option value="AL">Alabama</option>
										<option value="AK">Alaska</option>
										<option value="AZ">Arizona</option>
										<option value="AR">Arkansas</option>
										<option value="CA">California</option>
										<option value="CO">Colorado</option>
										<option value="CT">Connecticut</option>
										<option value="DE">Delaware</option>
										<option value="DC">District Of Columbia</option>
										<option value="FL">Florida</option>
										<option value="GA">Georgia</option>
										<option value="HI">Hawaii</option>
										<option value="ID">Idaho</option>
										<option value="IL">Illinois</option>
										<option value="IN">Indiana</option>
										<option value="IA">Iowa</option>
										<option value="KS">Kansas</option>
										<option value="KY">Kentucky</option>
										<option value="LA">Louisiana</option>
										<option value="ME">Maine</option>
										<option value="MD">Maryland</option>
										<option value="MA">Massachusetts</option>
										<option value="MI">Michigan</option>
										<option value="MN">Minnesota</option>
										<option value="MS">Mississippi</option>
										<option value="MO">Missouri</option>
										<option value="MT">Montana</option>
										<option value="NE">Nebraska</option>
										<option value="NV">Nevada</option>
										<option value="NH">New Hampshire</option>
										<option value="NJ">New Jersey</option>
										<option value="NM">New Mexico</option>
										<option value="NY">New York</option>
										<option value="NC">North Carolina</option>
										<option value="ND">North Dakota</option>
										<option value="OH">Ohio</option>
										<option value="OK">Oklahoma</option>
										<option value="OR">Oregon</option>
										<option value="PA">Pennsylvania</option>
										<option value="RI">Rhode Island</option>
										<option value="SC">South Carolina</option>
										<option value="SD">South Dakota</option>
										<option value="TN">Tennessee</option>
										<option value="TX">Texas</option>
										<option value="UT">Utah</option>
										<option value="VT">Vermont</option>
										<option value="VA">Virginia</option>
										<option value="WA">Washington</option>
										<option value="WV">West Virginia</option>
										<option value="WI">Wisconsin</option>
										<option value="WY">Wyoming</option>
									</select>
									
								</div>
							</div>

              <div class="form-group">
                <div class="input-group-lg d-flex flex-column">
									<input type="hidden">
                  <textarea class="form-control" placeholder="Please write your message here..." rows = "5" name="message" required="required"></textarea>
									<div style="color:red;">
										<?php 
											if(isset($message)){
												if (strlen($message) > 280){
													echo $messrror2; 
												}
											}
										?>
									</div>
                </div>
              </div>
              <input type="submit" name ="submit" value="Submit" class="btn btn-block btn-lg">
            </form>
          </div>
          <div class="col-lg-3 align-self-center d-none d-lg-block">
            <img src="./images/logo.png" alt="" class="img-fluid">
          </div>
        </div>
      </div>
		</section>

		<footer class="footer p-5 text-white">
			<div class="container">
				<div class="row d-flex flex-column no-gutters">
					<div class="footer-socialmedia mr-auto p-2">
						<a href=""><i class="fa fa-facebook pr-3" aria-hidden="true"></i></a>
						<a href=""><i class="fa fa-twitter pr-3" aria-hidden="true"></i></a>
						<a href=""><i class="fa fa-youtube pr-3" aria-hidden="true"></i></a>
						<a href=""><i class="fa fa-twitch pr-3" aria-hidden="true"></i></a>
					</div>
					<div class="footer-links1 mr-auto p-2">
						For business inqueries <i class="fa fa-arrow-right p-2" aria-hidden="true"></i> <a href="#">partnerships@phantomrealitylabs.com</a>
					</div>
					<div class="footer-links2 mr-auto p-2">
						<a class="pr-2"href="">Press</a>|<a class="p-2" href="">Terms</a>|<a class="p-2" href="">Privacy</a>
					</div>
					<div class="mr-auto rights p-2">
							<p>Copyright &copy; 2018 Phantom Reality, Inc. All Rights Reserved.</p>
					</div>
				</div>
			</div>
		</footer>
		

		<!--build:js js/main.min.js -->
		<script src="js/jquery.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
		<script src = "js/navbar-fixed.js"></script>
		<!-- endbuild -->
		<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="slick/slick.min.js"></script>
		
	</body>
</html>
