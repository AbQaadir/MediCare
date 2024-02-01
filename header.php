<?php
require_once 'config/config-session.php';
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
	<meta charset="utf-8">
	<title>MediCare</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="profile.css">
	<link rel="stylesheet" href="product.css">
	<link rel="stylesheet" href="cart-button.css">
</head>

<body>
	<header class="main-header">
		<nav class="navbar">
			<ul class="main-menu">
				<li>
					<h1>MediCare</h1>
				</li>
				<li>
					<input type="text" placeholder="Search..." style="padding: 8px 16px; margin-left: 10px; width: 200px;">
				</li>

				<li><span></span></li>
				<li><span></span></li>
				<li><span></span></li>
				<li><span></span></li>
				<li><span></span></li>



				<li><a href="index.php">Home</a></li>
				<li><a href="#">Blog<i class="ti-angle-down"></i></a>
					<ul class="dropdown">
						<li><a href="blog-single-sidebar.php">Blog Single Sidebar</a></li>
					</ul>
				</li>
				<li><a href="contact-us.php">Contact Us</a></li>
				<?php
				if (isset($_SESSION["email"])) {
					require_once 'cart-button.php';
				}
				?>



				<?php if (isset($_SESSION["userType"])) : ?>
					<li><a href="profile.php">Profile</a> </li>
					<?php if ($_SESSION["userType"] === "admin") : ?>
						<li><a href="profile.php">Profile</a></li>
						<li><a href="admin-dashboard.php">Dashboard</a></li>
					<?php elseif ($_SESSION["userType"] === "user") : ?>
						<li><a href="profile.php">Profile</a></li>

					<?php elseif ($_SESSION["userType"] === "superadmin") : ?>
						<li><a href="super-admin-dashboard.php">Dashboard</a></li>
					<?php endif; ?>
					<li><a href="logout.php">Logout</a></li>
				<?php else : ?>
					<li><a href="login.php">Login</a></li>
				<?php endif; ?>
			</ul>
		</nav>
	</header>