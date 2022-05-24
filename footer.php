    <section id="newsletter" class="section-p1 section-m1">
		<div class="newstext">
			<h4>Sign up For Newsletters</h4>
			<p>Get E-mail updates about our latest shop and <span>special offers.</span>
			</p>
		</div>
		<div class="form" style="position:relative;">
			<input type="text" placeholder="Your email address">
			<button class="normal" id="btn_newsLetter">Sign Up</button>
		</div>
	</section>

	<footer class="section-p1">
		<div class="col">
			<img class="logo" src="imgs/logo.jpg" class="logo" height="80" alt="">
			<h4>Contact</h4>
			<p><strong>Address:</strong> Zone 1 Molugan, El Salvador City, Misamis Oriental</p>
			<p><strong>Phone:</strong> +63 926 2370 781</p>
			<div class="follow">
				<h4>Follow us</h4>
				<div class="icon">
					<i class="fa-brands fa-facebook-f"></i>
					<i class="fa-brands fa-twitter"></i>
					<i class="fa-brands fa-instagram"></i>
					<i class="fa-brands fa-pinterest-p"></i>
					<i class="fa-brands fa-youtube"></i>
				</div>
			</div>
		</div>

		<div class="col">
			<h4>About</h4>
			<a href="about.php">About us</a>
			<a href="index.php">Delivery Information</a>
			<a href="index.php">Privacy Policy</a>
			<a href="index.php">Terms & Conditions</a>
			<a href="contact.php">Contact Us</a>
		</div>

		<div class="col">
			<h4>My Account</h4>
			<a href="index.php">Sign In</a>
			<a href="cart.php">View Cart</a>
			<a href="index.php">My Wishlist</a>
			<a href="index.php">Track My Order</a>
			<a href="index.php">Help</a>
		</div>

		<div class="col install">
			<h4>Install App</h4>
			<p>From App Store or Google Play</p>
			<div class="row">
				<img src="imgs/pay/app.jpg" height="40" alt="">
				<img src="imgs/pay/google.jpg" height="40" alt="">
			</div>
			<p>Secured Payment Gateways</p>
			<img src="imgs/pay/cards.jpg" alt="">
		</div>

		<div class="copyright">
			<p>© 2021, Tech2 etc - HTML CSS Ecommerce Template</p>
		</div>
	</footer>

    <div id="id01" class="modal">
  
        <form class="modal-content animate" method="post" onsubmit="return false;">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="imgs/logo.jpg" alt="Avatar" class="avatar">
            </div>

            <div class="container">
            <div style="padding:10px; border-radius:8px; border: 1px solid red; background: pink;margin-bottom: 1rem; display:none;" id="login_error_container">
                <h3 style="text-align: center;">Login Failed!</h3>
                <p style="text-align: center;">Username or password is not correct.</p>
            </div>

                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" id="uname_login" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" id="psw_login" required>
                    
                <button type="button" class="button" onclick="login()" >Login</button>
                
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <span class="psw"><a href="#" onclick="redirect_to_register();">Register</a></span>
            </div>
        </form>
    </div>

	<script src="script.js" class="section-p1"></script>
    <script src="./sweetalert2.all.min.js"></script>
    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function login() {
            var username = document.getElementById("uname_login").value;
            var password = document.getElementById("psw_login").value;

            document.getElementById('login_error_container').style.display = "none";

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == 'success') {
                        Swal.fire("Success", "Successfully Logged in!", "success")
                            .then(function () {
                                if (getParameterByName('redirect') != null) {
                                    window.location.href = getParameterByName('redirect');
                                } else {
                                    location.reload();
                                }
                            });
                        
                    } else {
                        Swal.fire("Error", "Username or password is not correct!", "error")
                            .then(function () {
                                document.getElementById('login_error_container').style.display = "block";
                            });
                    }
                }
            };
            xmlhttp.open("GET", "api/login_user.php?username=" + username + "&password=" + password, true);
            xmlhttp.send();
        }

        function logout() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    Swal.fire("Success", "You're account has been logged out successfully!", "success")
                        .then(function () {
                            location.reload();
                        });
                }
            };
            xmlhttp.open("GET", "api/logout.php", true);
            xmlhttp.send();
        }

        function getParameterByName(name, url = window.location.href) {
            name = name.replace(/[\[\]]/g, '\\$&');
            var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
                results = regex.exec(url);
            if (!results) return null;
            if (!results[2]) return '';
            return decodeURIComponent(results[2].replace(/\+/g, ' '));
        }

        function add_to_cart(id, quantity, price, image, name) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = this.responseText;

                    Swal.fire("Success", "Item has been successfully added to the cart!", "success")
                        .then(function () {
                            document.getElementById("cart_count1").innerHTML = response;
                            document.getElementById("cart_count2").innerHTML = response;
                        });
                }
            };
            xmlhttp.open("GET", "api/add_to_cart.php?id=" + (+id) + "&quantity=" + quantity + "&price=" + price + "&image=" + image + "&name=" + name, true);
            xmlhttp.send();
        }

        function remove_item_to_cart(id) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    Swal.fire("Success", "Item has been successfully from cart!", "success")
                        .then(function () {
                            location.reload();
                        });
                }
            };
            xmlhttp.open("GET", "api/remove_to_cart.php?id=" + (+id), true);
            xmlhttp.send();
	    }

        function update_cart_item_quantity(id, quantity) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    location.reload();
                }
            };
            xmlhttp.open("GET", "api/update_cart.php?id=" + (+id) + "&quantity=" + quantity, true);
            xmlhttp.send();
        }

        function redirect_to_register() {
            var field = 'redirect';
            var url = window.location.href;

            if(url.indexOf('?' + field + '=') != -1)
                modal.style.display = "none";
            else if(url.indexOf('&' + field + '=') != -1)
                modal.style.display = "none";
            else 
                window.location.href = "register.php?redirect=" + window.location.href + "&newlettertop=true";
        }

        function page_load() {
            var field = 'newlettertop';
            var url = window.location.href;
            var button = document.getElementById('btn_newsLetter');

            if(url.indexOf('?' + field + '=') != -1)
                button.style.top = "6px";
            else if(url.indexOf('&' + field + '=') != -1)
                button.style.top = "5px";
        }
    </script>
</body>
</html>