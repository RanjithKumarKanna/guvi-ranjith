<?php
   include("config.php");
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['uname']);
      $mypassword = mysqli_real_escape_string($db,$_POST['pass']); 
      
      $sql = "SELECT * FROM user WHERE uname = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
        // session_register("myusername");
        session_start();
		 $_SESSION['loggedin'] = TRUE;
         $_SESSION['login_user'] = $myusername;
         
echo "<script>alert('Login Successful');window.location.href='info.php';</script>";
	}
	  else
	  {
         echo "<script>alert('Your Login Name or Password is invalid');window.location.href='login.php';</script>";
		 exit();
      }
   }	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">

<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>

</head>
<body>

    <div class="main">

        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                    <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <h2 class="form-title">Register</h2>
                        <form  class="register-form" id="reg">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="mail" id="mail" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="#log" class="signup-image-link">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- login  Form -->
        <section class="sign-in" id="log">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <form id="login" method="post">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="uname" id="uname" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="https://www.facebook.com/"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="https://twitter.com/"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="https://myaccount.google.com/"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>

    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
$(document).on('submit', '#reg', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append("save_reg", true);
            $.ajax({
                type: "POST",
                url: "insert2.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                      $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                       $('#errorMessage').addClass('d-none');
                        $('#reg')[0].reset();

                       alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                     //  $('#user').load(location.href + " #user");

                    }else if(res.status == 500) {
						$('#errorMessage').addClass('d-none');
                        $('#reg')[0].reset();
                       alertify.set('notifier','position', 'top-right');
                       alertify.success(res.message);
                    }
                }
            });

        });	

</script>

</body>
</html>