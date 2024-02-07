<?php
require_once 'config/config-session.php';

// $_SESSION["email"] = "soloqaadir@gmail.com";
$email = $_SESSION["email"];

if (!isset($_SESSION['email'])) {
	echo '<script type="text/javascript">';
	echo 'alert("Please login to access the contact us page.");';
	echo 'window.location.href = "login.php";';
	echo '</script>';
	exit();
}
require_once "config/controllers/shipping.contr.php";




require_once 'config/db.inc.php';
require_once 'config/models/shipping.model.php';

//check user already has shipping info
if(isEmailAlreadyExist($pdo,$email)){
	header("Location: payment-cash.php");
	exit();
}

$result = null;

if (recentShoppingInfo($pdo, $_SESSION['email'])) {
	$result = recentShoppingInfo($pdo, $_SESSION['email']);

	if ($result) {
		$name = $result['ship_name'];
		$number = $result['ship_number'];
		$address = $result['ship_address'];
		$city = $result['ship_city'];
		$zip = $result['ship_zip'];
		$country = $result['ship_country'];
	}
}

$name = "";
$number = "";
$address = "";
$city = "";
$zip = "";
$country = "";



require_once 'config/components/button.component.php';
require_once 'config/components/input.component.php';
require_once 'config/components/textarea.component.php';
require_once 'config/components/select.component.php';

require_once 'config/views/shipping.view.php';


$options = [
	'sl' => 'Sri Lanka',
	'ind' => 'India',
	'us' => 'EUnited States',
	'pak' => 'Pakistan',
	'aus' => 'Australia'
];

?>


<!DOCTYPE html>
<html lang="zxx">

<head>
	<!-- Meta Tag -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="style/checkout.css">
</head>

<body class="js">

	<!-- Start Checkout -->
	<section class="shop checkout section">
		<div class="container">
			<div class="row">
				<!-- Shipping Information -->
				<div class="col-lg-4 col-12">
					<div class="shipping-info">
						<h2>Shipping Information</h2>
						<br>
						<form action="config/shipping.inc.php" method="post">
							<div class="row">
								<div class="col-md-12">
									<label for="ship-name">Full Name</label>
									<?php generateInput('text', 'ship-name', $value = $name); ?>
								</div>
								<?php showNameError(); ?>
								<div class="col-md-6">
									<label for="ship-city">Contact Number</label>
									<?php generateInput('number', 'ship-number', $value = $number); ?>
								</div>
								<?php showPhoneError(); ?>
								<div class="col-md-12">
									<label for="ship-address">Shipping Address</label>
									<?php generateTextarea('text', 'ship-address', $value = $address); ?>
								</div>
								<?php showAddressError(); ?>
								<div class="col-md-6">
									<label for="ship-city">City</label>
									<?php generateInput('text', 'ship-city', $value = $city); ?>
								</div>
								<?php showCityError(); ?>
								<div class="col-md-6">
									<label for="ship-zip">ZIP Code</label>
									<?php generateInput('text', 'ship-zip', $value = $zip); ?>
								</div>
								<?php showZipError(); ?>
								<div class="col-md-12">
									<label for="ship-country">Country</label>
									<?php generateSelect('ship-country', 'ship-country', $options, $value = $country); ?>
								</div>
								<?php showCountryError(); ?>
								<div class="col-md-12">
									<?php generateInput("hidden", $name = "email", $value = $email); ?>
								</div>
								<div class="col-md-6">
									<br>
									<?php generateButton("Next", "next"); ?>
								</div>
							</div>
						</form>
					</div>
					<?php unset($_SESSION["errorsShipping"]) ?>
				</div>
			</div>
	</section>
	<!-- End Checkout -->

	<!-- Shop Newsletter -->
	<section class="shop-newsletter section">
		<div class="container">
			<div class="inner-top">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-12">
						<!-- Start Newsletter Inner -->
						<div class="inner">
							<h4>Newsletter</h4>
							<p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
							<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
								<input name="EMAIL" placeholder="Your email address" required="" type="email">
								<button class="btn">Subscribe</button>
							</form>
						</div>
						<!-- End Newsletter Inner -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Newsletter -->

	<script>
		function togglePaymentSections() {
			var creditCardSection = document.querySelector('.credit-card-section');
			var paypalSection = document.querySelector('.paypal-section');
			var creditCardRadio = document.getElementById('1');
			var paypalRadio = document.getElementById('3');

			creditCardSection.style.display = creditCardRadio.checked ? 'block' : 'none';
			paypalSection.style.display = paypalRadio.checked ? 'block' : 'none';
		}
	</script>

</body>

</html>