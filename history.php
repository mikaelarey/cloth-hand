<?php 
require_once 'header.php';

$sql = "SELECT date, order_number, (SELECT count(product_id) FROM purchase WHERE order_number = p.order_number) as count,(SELECT sum(quantity) FROM purchase WHERE order_number = p.order_number) as sum FROM purchase p WHERE user_id = " . $_SESSION['UserId'];
$result = $conn->query($sql);

$curren_order_number = "";
?>

<section id="page-header" class="cart-header">
	<h2>PURCHASE HISTORY</h2>
</section>

<section id="cart" class="section-p1">
    <table width="100%">
        <thead>
            <tr>
                <td>Date</td>
                <td>Order Number</td>
                <td>Number Of Product</td>
                <td>Total Quantity</td>
                <td>Action</td>
            </tr>
        </thead> 
        <tbody>
            <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <?php if ($curren_order_number == $row['order_number']) continue; ?>
                <tr>
					<td>
						<?php echo $row['date']; ?>
					</td>
					<td>
						$<?php echo $row['order_number']; ?>
					</td>
					<td>
						<?php echo $row['count']; ?> items
					</td>
					<td>
						<?php echo $row['sum']; ?> total quantity
					</td>
                    <td>
                        <a href="order_details.php?ordernumber=<?php echo $row['order_number']; ?>">
                            VIEW DETAILS
                        </a>
					</td>
				</tr>
                <?php $curren_order_number = $row['order_number']; ?>
            <?php endwhile; ?> 
            <?php endif; ?>
        </tbody>
    </table>
</section>
<?php require_once 'footer.php'; ?>