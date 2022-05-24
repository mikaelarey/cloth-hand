<?php require_once 'header.php'; ?>
<?php $subtotal = 0; ?>

<?php 

//echo  $_GET['ordernumber'];

$sql = "SELECT pur.quantity as pur_quantity, pur.*, pro.* FROM purchase pur INNER JOIN products pro ON pro.id = pur.product_id WHERE pur.order_number = '" . $_GET['ordernumber'] . "'";
$result = $conn->query($sql);
?>

<section id="page-header" class="cart-header">
	<h2>PURCHASE DETAILS</h2>
	<p>ORDER NUMBER: <?php echo $_GET['ordernumber']; ?></p>
</section>

<section id="cart" class="section-p1">
    <table width="100%">
        <thead>
            <tr>
                <td>Image</td>
                <td>Product</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Subtotal</td>
            </tr>
        </thead> 
        <tbody>
            <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
					<td>
						<img src="imgs/products/<?php echo $row['image']; ?>" alt="">
					</td>
					<td>
						<?php echo $row['name']; ?>
					</td>
					<td>
						$<?php echo $row['price']; ?>.00
					</td>
					<td>
						<?php echo $row['pur_quantity']; ?>
					</td>
					<td>
						$<?php echo $row['price'] * $row['pur_quantity']; ?>.00
					</td>
				</tr>
                <?php $subtotal += $row['price'] * $row['pur_quantity']; ?>
            <?php endwhile; ?> 
            <?php endif; ?>
        </tbody>
    </table>
</section>


<section id="cart-add" class="section-p1">
    <div id="coupon"></div>
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
    </div>
</section>


<?php require_once 'footer.php'; ?>