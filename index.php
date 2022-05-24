<?php require_once 'header.php'; ?>

<section id="hero">
	<h4>Trade-in-offer</h4>
	<h2>Super Value Deals</h2>
	<h1>On all products</h1>
	<p>Save more with coupons & up to 70% off!	</p>
	<button>Shop Now</button>
</section>

<section id="feature" class="section-p1">
	<div class="fe-box">
		<img src="imgs/isolated-delivery-truck-and-gps-mark-design-free-vector.jpg" alt="" height="90">
		<h6>Free Shipping</h6>
	</div>
	<div class="fe-box">
		<img src="imgs/72639125646f557ca7563514a980aaee.jpg" alt="" height="90">
		<h6>Online Order</h6>
	</div>
	<div class="fe-box">
		<img src="imgs/istockphoto-537487845-612x612.jpg" alt="" height="90">
		<h6>Cash on Delivery</h6>
	</div>
	<div class="fe-box">
		<img src="imgs/sale-round-circle-5.png" alt="" height="90">
		<h6>Promotions</h6>
	</div>
	<div class="fe-box">
		<img src="imgs/voucher-vector-black-friday-related-flat-icon-style-165304061.jpg" alt="" height="90">
		<h6>Vouchers</h6>
	</div>
	<div class="fe-box">
		<img src="imgs/Managed_Support_Top.png" alt="" height="90">
		<h6>Support</h6>
	</div>
</section>

<section id="product1" class="section-p1">
	<h2>Featured Products</h2>
	<p>Summer Collection New Modern Design</p>

	<div class="pro-container">
	<?php
		$new_arrival = "SELECT * FROM products ORDER BY RAND() LIMIT 12";
		$result = $conn->query($new_arrival);
	?>

	<?php if ($result->num_rows > 0): ?>
		<?php while($row = $result->fetch_assoc()): ?>
			<div class="pro">
				<a href="product.php?id=<?php echo $row['id']; ?>">
					<img src="imgs/products/<?php echo $row['image']; ?>" alt="">
				</a>

				<div class="des">
					<span>Brand</span>
					<h5><?php echo $row['name']; ?></h5>
					<div class="star">
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
					</div>
					<h4>$<?php echo $row['price']; ?></h4>
				</div>

				<span onclick="add_to_cart(<?php echo $row['id']; ?>, 1, <?php echo $row['price']; ?>, '<?php echo $row['image']; ?>', '<?php echo $row['name']; ?>')">
					<i class="fa-solid fa-cart-shopping cart"></i>
				</span>
			</div>
	<?php 
		endwhile;
		endif;
	?>
	</div>
	</div>
</section>

<section id="banner" class="section-m1">
	<h4>Repair Services</h4>
	<h2>Up to <span>70% Off</span> - All T-shirts & Accessories</h2>
	<button class="normal">Explore More</button>
</section>

<section id="product1" class="section-p1">
	<h2>New Arrivals</h2>
	<p>Aesthetic Collection New Modern Design</p>

	<div class="pro-container">
	<?php
		$new_arrival = "SELECT * FROM products ORDER BY RAND() LIMIT 6";
		$result = $conn->query($new_arrival);
	?>

	<?php if ($result->num_rows > 0): ?>
		<?php while($row = $result->fetch_assoc()): ?>
			<div class="pro">
				<a href="product.php?id=<?php echo $row['id']; ?>">
					<img src="imgs/products/<?php echo $row['image']; ?>" alt="">
				</a>
				
				<div class="des">
					<span>Brand</span>
					<h5><?php echo $row['name']; ?></h5>
					<div class="star">
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
						<i class="fa-solid fa-star"></i>
					</div>
					<h4>$<?php echo $row['price']; ?></h4>
				</div>

				<span onclick="add_to_cart(<?php echo $row['id']; ?>, 1, <?php echo $row['price']; ?>, '<?php echo $row['image']; ?>', '<?php echo $row['name']; ?>')">
					<i class="fa-solid fa-cart-shopping cart"></i>
				</span>
			</div>
	<?php 
		endwhile;
		endif;
		$conn->close();
	?>
	</div>
</section>

<section id="sm-banner" class="section-p1">
	<div class="banner-box">
		<h4>crazy deals</h4>
		<h2>buy 1 get 1 free</h2>
		<span>The best classic dress is on sale at clothhand</span>
		<button class="white">Learn More</button>
	</div>
	<div class="banner-box banner-box2">
		<h4>spring/summer</h4>
		<h2>upcoming season</h2>
		<span>The best classic dress is on sale at clothhand</span>
		<button class="white">Collection</button>
	</div>
</section>

<section id="banner3">
	<div class="banner-box">
		<h2>SEASONAL SALE</h2>
		<h3>Winter Collection -50% OFF</h3>
	</div>
	<div class="banner-box banner-box2">
		<h2>NEW FOOTWEAR COLLECTION</h2>
		<h3>Spring/Summer 2022</h3>
	</div>
	<div class="banner-box banner-box3">
		<h2>T-SHIRTS</h2>
		<h3>New Trendy Prints</h3>
	</div>
</section>

<?php require_once 'footer.php'; ?>