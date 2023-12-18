<?php
require_once 'header.php';
?>
<section id="contact-us" class="contact-us section">
	<div class="title">
		<h1>Hi! How we can help you?</h1>
	</div>
	<form class="form" method="post" action="mail/mail.php">

		<div class="form-group">
			<label for="name">Your Name<span>*</span></label>
			<input id="name" name="name" type="text" placeholder="">
		</div>

		<div class="form-group">
			<label for="email">Your Email<span>*</span></label>
			<input id="email" name="email" type="email" placeholder="">

		</div>

		<div class="form-group message">
			<label for="message">Your Message<span>*</span></label>
			<textarea id="message" name="message" placeholder=""></textarea>
		</div>

		<div class="form-group button">
			<button type="submit" class="btn">Send Message</button>
		</div>
	</form>
</section>


<section class="shop-newsletter section">
	<div class="inner">
		<h4>Newsletter</h4>
		<p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
		<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
			<input name="EMAIL" placeholder="Your email address" required="" type="email">
			<button class="btn">Subscribe</button>
		</form>
	</div>
</section>

<?php
	require_once 'footer.php';
?>
</body>

</html>