<?php require_once 'header.php'; ?>

		<section id="page-header">
			<h2>#stayhome</h2>
			<p>Save more with coupons & up to 70% off!	</p>
		</section>

		<section id="product1" class="section-p1">
			<div class="pro-container">
			<?php
				$new_arrival = "SELECT * FROM products ORDER BY RAND()";
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
		</section>

<?php require_once 'footer.php'; ?>