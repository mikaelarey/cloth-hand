<?php require_once 'header.php'; ?>
<?php $subtotal = 0; ?>

<section id="page-header" class="cart-header">
	<h2>#cart</h2>
	<p>Add your coupon code & SAVE up to 70%!</p>
</section>

<section id="cart" class="section-p1">
    <table width="100%">
        <thead>
            <tr>
                <td>Remove</td>
                <td>Image</td>
                <td>Product</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead> 
        <tbody>
		<?php if ($cart_count > 0): ?>
			<?php foreach ($_SESSION['products_in_cart'] as $item): ?>
				<tr>
					<td>
						<span onclick="remove_item_to_cart(<?php echo $item['id']; ?>)" style="cursor: pointer;">
							<i class="fa-regular fa-circle-xmark"></i>
						</span>
					</td>
					<td>
						<img src="imgs/products/<?php echo $item['image']; ?>" alt="">
					</td>
					<td>
						<?php echo $item['name']; ?>
					</td>
					<td>
						$<?php echo $item['price']; ?>.00
					</td>
					<td>
						<input type="number" value="<?php echo $item['quantity']; ?>" onchange="update_cart_item_quantity(<?php echo $item['id']; ?>, this.value)">
					</td>
					<td>
						$<?php echo $item['price'] * $item['quantity']; ?>.00
					</td>
				</tr>
				<?php $subtotal += $item['price'] * $item['quantity']; ?>
			<?php endforeach; ?>
		<?php else: ?>
			<h3 style="text-align: center; color: red; margin-top:2rem; margin-bottom: 2rem;">No items on cart</h3>
		<?php endif; ?>
        </tbody>
    </table>
</section>

<section id="cart-add" class="section-p1">
<?php if ($cart_count > 0): ?>
    <div id="coupon">
        <h3>Apply Coupon</h3>
        <div>
            <input type="text" placeholder="Enter Your Coupon">
            <button class="normal">Apply</button>
        </div>
    </div>

    <div id="subtotal">
        <h3>Cart Total</h3>
        <table>
            <tr>
                <td>Cart Subtotal</td>
                <td>$<?php echo $subtotal; ?>.00</td>
            </tr>
            <tr>
                <td>Shipping</td>
                <td>$100.00</td>
            </tr>
            <td><strong>Total</strong></td>
            <td><strong>$<?php echo $subtotal + 100; ?>.00</strong></td>
        </table>
		<?php if (isset($_SESSION['UserId'])): ?>
			<button class="normal" onclick="window.location.href = 'checkout.php'">Proceed to checkout</button>
		<?php else: ?>
			<button class="normal" onclick="proceed_to_login()">Proceed to checkout</button>
		<?php endif; ?>
        
    </div>
<?php endif; ?>
</section>

<script>
    function proceed_to_login() {
        Swal.fire("Login Required", "Please login to your account to continue to checkout page.", "info")
            .then(function () {
                document.getElementById('id01').style.display='block';
            });
    }
</script>

<?php require_once 'footer.php'; ?>
