<?php require_once 'header.php'; ?>

<style>
    /* body {font-family: Arial, Helvetica, sans-serif;}
    * {box-sizing: border-box} */

    /* Full-width input fields */
    input[type=text], input[type=password] {
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      display: inline-block;
      border: none;
      background: #f1f1f1;
    }

    input[type=text]:focus, input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }

    hr {
      border: 1px solid #f1f1f1;
      margin-bottom: 25px;
    }

    


    /* Extra styles for the cancel button */
    /* .cancelbtn {
      padding: 14px 20px;
      background-color: #f44336;
    } */

    /* Float cancel and signup buttons and add an equal width */
    .signupbtn-register {
      float: left;
      width: 50%;
    }

    /* Add padding to container elements */
    .container-register {
      padding: 16px;
      max-width: 50rem;;
      width: 100%;
      margin-left:auto;
      margin-right: auto;
      margin-top:3rem;
      margin-bottom: 2rem;
    }

    /* Clear floats */
    .clearfix::after {
      content: "";
      clear: both;
      display: table;
    }

    /* Change styles for cancel button and signup button on extra small screens */
    @media screen and (max-width: 300px) {
      .signupbtn-register {
        width: 100%;
      }
    }
</style>

<form class="container-register" onsubmit="return submit_registration_form()">
    <h3>REGISTER</h3>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <div id="registration_form_container">
      <div style="padding:10px; border-radius:8px; border: 1px solid red; background: pink;margin-bottom: 1rem; display:none;" id="register_error_container">
        <p style="text-align: center;" id="register_error">test error</p>
      </div>
      <label for="email"><b>First Name</b></label>
      <input type="text" placeholder="Enter Email" id="firstName">

      <label for="email"><b>Last Name</b></label>
      <input type="text" placeholder="Enter Email" id="lasName">

      <label for="email"><b>Username</b></label>
      <input type="text" placeholder="Enter Email" id="username">

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" id="psw">

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" id="psw_repeat">
      
      <!-- <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label> -->
      
      <!-- <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p> -->

      <div class="clearfix">
        <!-- <button type="button" class="cancelbtn">Cancel</button> -->
        <button type="submit" class="signupbtn-register button" style="width:100%;" onclick="submit_registration_form()">Register</button>
      </div>
    </div>

    <div style="padding:10px; padding-top:2rem; border-radius:8px; border: 1px solid green; background: lightgreen;margin-bottom: 1rem; display:none;" id="register_success_container">
      <h3 style="text-align: center;">Your account has been successfully created!</h3>
      <p style="text-align: center;">Login to your account to continue processing your transaction.</p>
    </div>
</form>

<script>
  function submit_registration_form() {
    var firstName = document.getElementById('firstName').value;
    var lasName = document.getElementById('lasName').value;
    var username = document.getElementById('username').value;
    var psw = document.getElementById('psw').value;
    var psw_repeat = document.getElementById('psw_repeat').value;

    var register_error_container = document.getElementById('register_error_container');
    var register_error = document.getElementById('register_error');

    var registration_form_container =  document.getElementById('registration_form_container');
    var register_success_container =  document.getElementById('register_success_container');

    register_error_container.style.display = "none";
    register_error.innerHTML = "";

    if (firstName == "" || lasName == "" || username == "" || psw == "") {
      Swal.fire("Error", "All fields are required!", "error");
      register_error_container.style.display = "block";
      register_error.innerHTML = "All fields are required!";
         
      return false;
    }

    if (psw != psw_repeat) {
      Swal.fire("Error", "Two passwords did not match!", "error");
      register_error_container.style.display = "block";
      register_error.innerHTML = "Two passwords did not match!";
      
      return false;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        if (this.responseText == 'exists') {
          register_error_container.style.display = "block";
          register_error.innerHTML = "Username already exists!";
        } else if (this.responseText == 'inserted') {
          register_error_container.style.display = "none";
          register_error.innerHTML = "";

          registration_form_container.style.display = "none";
          register_success_container.style.display = "block";
        } else {
          register_error_container.style.display = "block";
          register_error.innerHTML = "There was an error while creating your account!";
        }
      }
    };
    xmlhttp.open("GET", "api/register_user.php?username=" + username + "&password=" + psw + "&firstname=" + firstName + "&lastname=" + lasName, true);
    xmlhttp.send();

    return false;
  }
</script>

<?php require_once 'footer.php'; ?>