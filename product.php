<?php 
require_once 'header.php';

$id = $_GET['id'];

$sql = "SELECT * FROM products WHERE id = " . $id;
$result = $conn->query($sql);

$isAddedToCart = false;

if (isset($_SESSION['products_in_cart'])) {
	if (count($_SESSION['products_in_cart']) > 0) {
		foreach ((array)$_SESSION['products_in_cart'] as $item) {
			if ($item["id"] == $id) {
				$isAddedToCart = true;
				break;
			}
		}
	}
}
?>

<?php if ($result->num_rows > 0): ?>
  	<?php while($row = $result->fetch_assoc()): ?>
	<section id="prodetails" class="section-p1">
		<div class="single-pro-image">
			<img id="image" src="imgs/products/<?php echo $row['image']; ?>" width="100%" id="MainImg" alt="">
		</div>

		<div class="single-pro-details">
			<h6>Brand</h6>
			<h4 id="name"><?php echo $row['name']; ?></h4>
			<h2>$<span id="price"><?php echo $row['price']; ?></span></h2>
			<select>
				<option>Select Size</option>
				<option>Large</option>
				<option>Medium</option>
				<option>Small</option>
			</select>
			<div id="btn_add" style="display:<?php echo $isAddedToCart ? 'none' : 'block'; ?>">
				<input type="number" value="1" style="padding:0.5rem;height:2.5rem" id="quantity">
				<button class="normal" onclick="prepare_item('<?php echo $row['image']; ?>')" id="btn_add">Add To Cart</button>
			</div>
			<div id="product_message" style="display:<?php echo $isAddedToCart ? 'block' : 'none'; ?>">
				<h5 style="margin-top:2rem; color:red;">This item was already added to cart</h5>
			</div>
			
			<h4>Product Details</h4>
			<p><?php echo $row['description']; ?></p>
		</div>
	</section>

	<?php endwhile; ?>
<?php else: ?>
	<h1 style="margin-top: 5rem; color: red; text-align:center;">ITEM NOT FOUND</h1>
<?php 
	endif; 
	$conn->close();
?>

<script>
	function prepare_item(image) {
		var id = <?php echo $_GET['id']; ?>;
		var quantity = document.getElementById('quantity').value;
		var price = document.getElementById('price').innerHTML;
		var name = document.getElementById('name').innerHTML;

		
		Swal.fire("Success", "Item has been successfully added to cart!", "success")
			.then(function () {
				add_to_cart(id, quantity, price, image, name);
				location.reload();
			});
	}
</script>

<?php require_once 'footer.php'; ?>

