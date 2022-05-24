<?php require_once 'header.php'; ?>
<?php $subtotal = 0; ?>

<style>
    body {
        font-family: Arial;
        font-size: 17px;
        padding: 8px;
    }

    /* * {
        box-sizing: border-box;
    } */

    .row {
        display: -ms-flexbox; /* IE10 */
        display: flex;
        -ms-flex-wrap: wrap; /* IE10 */
        flex-wrap: wrap;
        margin: 0 -16px;
    }

    .col-25 {
        -ms-flex: 25%; /* IE10 */
        flex: 25%;
    }

    .col-50 {
        -ms-flex: 50%; /* IE10 */
        flex: 50%;
    }

    .col-75 {
        -ms-flex: 75%; /* IE10 */
        flex: 75%;
    }

    .col-25,
    .col-50,
    .col-75 {
        padding: 0 16px;
    }

    .container {
        background-color: #f2f2f2;
        padding: 5px 20px 15px 20px;
        border: 1px solid lightgrey;
        border-radius: 3px;
    }

    input[type=text] {
        width: 100%;
        margin-bottom: 20px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    label {
        margin-bottom: 10px;
        display: block;
    }

    .icon-container {
        margin-bottom: 20px;
        padding: 7px 0;
        font-size: 24px;
    }

    .btn {
        background-color: #04AA6D;
        color: white;
        padding: 12px;
        margin: 10px 0;
        border: none;
        width: 100%;
        border-radius: 3px;
        cursor: pointer;
        font-size: 17px;
    }

    .btn:hover {
        background-color: #45a049;
    }

    a {
        color: #2196F3;
    }

    hr {
        border: 1px solid lightgrey;
    }

    span.price {
        float: right;
        color: grey;
    }

    /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
    @media (max-width: 800px) {
        .row {
            flex-direction: column-reverse;
        }
        .col-25 {
            margin-bottom: 20px;
        }
    }
</style>

<h3 style="text-align: center; margin-top: 3rem; font-size: 2rem;">Checkout Form</h3>

<div class="row" style="margin-top: 3rem; max-width: 1500px; margin-left:auto; margin-right:auto;">
  <div class="col-50">
    <div class="container">
      <form action="/action_page.php">
      
        <div class="row">
          <div class="col-50">
            <h3 style="margin:2rem 0;">Billing Address</h3>
            
            <label for="fullname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fullname" name="fullname" readonly value="<?php echo isset($_SESSION['fullname']) ? $_SESSION['fullname'] : ''; ?>">
            
            <label for="contact"><i class="fa fa-phone"></i> Contact Number</label>
            <input type="text" id="contact" name="contact" value="<?php echo isset($_SESSION['contact']) ? $_SESSION['contact'] : ''; ?>">
            
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
            
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="address" name="address" value="<?php echo isset($_SESSION['address']) ? $_SESSION['address'] : ''; ?>">
            
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" value="<?php echo isset($_SESSION['city']) ? $_SESSION['city'] : ''; ?>">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" value="<?php echo isset($_SESSION['state']) ? $_SESSION['state'] : ''; ?>">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" value="<?php echo isset($_SESSION['zip']) ? $_SESSION['zip'] : ''; ?>">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3 style="margin:2rem 0;">Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>

            <div id="payment_method_card">
                <strong>Payment Method</strong>
                <p>Cash on delivery</p>
            </div>
            <div id="payment_method_card" style="display:none">
                <label for="cname">Name on Card</label>
                <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                <label for="ccnum">Credit card number</label>
                <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                <label for="expmonth">Exp Month</label>
                <input type="text" id="expmonth" name="expmonth" placeholder="September">
                <div class="row">
                <div class="col-50">
                    <label for="expyear">Exp Year</label>
                    <input type="text" id="expyear" name="expyear" placeholder="2018">
                </div>
                <div class="col-50">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" placeholder="352">
                </div>
                </div>
            </div>
          </div>
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
        <?php if ($cart_count > 0): ?>
          <button type="button" class="btn" onclick="validate_checkout()">Place Order</button>
        <?php endif; ?>
      </form>
    </div>
  </div>
  <div class="col-50">
    <div class="container">
      <h3 style="margin:2rem 0;">Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo $cart_count; ?></b></span></h3>
      <?php if ($cart_count > 0): ?>
        <?php foreach ($_SESSION['products_in_cart'] as $item): ?>
          <p>
            <a href="product.php?id=<?php echo $item['id']; ?>">
              <img src="imgs/products/<?php echo $item['image']; ?>" alt="" style="width:3rem; margin-right:1rem">
              <span style="display:inline-block; position:relative; top: -1.5rem"><?php echo $item['name']; ?></span>
            </a> 
            <span class="price">
              $<?php echo $item['price'] * $item['quantity']; ?>.00
            </span>
          </p>
          <?php $subtotal += $item['price'] * $item['quantity']; ?>
        <?php endforeach; ?>
      <?php else: ?>
        <h3 style="text-align: center; color: red; margin-top:2rem; margin-bottom: 2rem;">No items on cart</h3>
      <?php endif; ?>
      <hr>
      <p>Sub Total <span class="price" style="color:black"><b>$<?php echo $subtotal; ?></b></span></p>
      <p>Shipping Fee <span class="price" style="color:black"><b>$100</b></span></p>
      <p>Total <span class="price" style="color:black"><b>$<?php echo $subtotal + 100; ?></b></span></p>
    </div>
  </div>
</div>


<script>
  function validate_checkout() {
    var fullname = document.getElementById('fullname').value;
    var contact = document.getElementById('contact').value;
    var email = document.getElementById('email').value;
    var address = document.getElementById('address').value;
    var city = document.getElementById('city').value;
    var state = document.getElementById('state').value;
    var zip = document.getElementById('zip').value;

    if (fullname == '' || contact == '' || email == '' || address == '' || city == '' || state == '' || zip == '') {
      Swal.fire("Checkout Failed!", "All fields are required!", "error");
    } else {
      Swal.fire({
        title: 'Confirmation?',
        text: "Are you sure you want to place an order with the total amount of $<?php echo $subtotal + 100; ?>?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Place Order'
      }).then((result) => {
        if (result.isConfirmed) {
          var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = this.responseText;

                    console.log(response);

                    if (response == "No items on cart") {
                      Swal.fire("Error", "No items on cart!", "error");
                    } else if (response == "Error updating user record") {
                      Swal.fire("Error", "There was an error purchasing your order!", "error");
                    } else {
                      Swal.fire("Success", "You order has been successfully processed.", "success")
                          .then(function () {
                            window.location.href = "order_details.php?ordernumber=" + response;
                          });
                    }
                } else {
                  Swal.fire("Failed!", "There was an error while processing your purchase!", "error")
                }
          };
          xmlhttp.open("GET", "api/place_order.php?fullname=" + fullname + "&contact=" + contact + "&email=" + email + "&address=" + address + "&city=" + city + "&state=" + state + "&zip=" + zip, true);
          xmlhttp.send();
        }
      })
    }
  }
</script>

<?php require_once 'footer.php'; ?>