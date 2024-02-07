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
	<style>
		 .order1-header {
            background-color: #4CAF50;
    border: none;
    cursor: pointer;
    font-weight: 500;
    font-family: Poppins;
    width: 100%;
    border-radius: 10px;
    padding:0px 10px 0px 10px;
    
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1), 0px 1px 3px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
        }

        .order1-header:hover {
            background-color: #45a049; /* Darker shade of green on hover */
    box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.2), 0px 2px 4px rgba(0, 0, 0, 0.1); /* Increase shadow on hover */
    transform: translateY(-1px); /* Change background color on hover */
}

	</style>
</head>

<body>
	<header class="main-header">
		<nav class="navbar">
			<ul class="main-menu">
				<li>
					<h1>MediCare</h1>
				</li>

				<form action="config/search.inc.php" method="POST">
					<li>
						<input type="text" name="keyword" placeholder="Eye" style="padding: 5px 5px; margin-left: 10px; width: 200px;">
						<button type="submit" style="padding: 5px 5px; background-color: white; color: black;">Search</button>
					</li>
				</form>

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
				
					require_once 'cart-button.php';
				
				?>
				<li><a href="wishlist.php"><img src="./uploads/wishlist.256x245.png" alt="" style="width: 30px; height: 30px;"></a></li>



				<?php 
				$con = mysqli_connect("localhost", "root", "", "medicare");
				$sql555 = "SELECT * FROM statustable WHERE status LIKE '%proccesing%'";
				$result555 = mysqli_query($con, $sql555);
				$row555 = mysqli_num_rows($result555);
				

				?>



				<?php if (isset($_SESSION["userType"])) : ?>
					
					<?php if ($_SESSION["userType"] === "admin") : ?>
						<li><a href="profile.php">Profile</a></li>
						<li><a href="admin-dashboard.php">Dashboard</a></li>
						<li class="order1-header"><a href="test-q-for-admin.php" >Orders(<?= $row555 ?>)</a></li>
					<?php elseif ($_SESSION["userType"] === "loginfo") : ?>
						<li><a href="profile.php">Profile</a></li>

					<?php elseif ($_SESSION["userType"] === "superadmin") : ?>
						<li><a href="super-admin-dashboard.php">Dashboard</a></li>
						<li class="order1-header"><a href="test-q-for-admin.php" >Orders(<?= $row555 ?>)</a></li>
					<?php endif; ?>
					<li><a href="logout.php">Logout</a></li>
				<?php else : ?>
					<li><a href="login.php">Login</a></li>
				<?php endif; ?>
			</ul>
		</nav>
	</header>