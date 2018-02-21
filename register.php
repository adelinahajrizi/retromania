<?php

	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'retromania');

	if(!$db) {
		die('Problem while connecting to db: ' . mysql_connect_error);
	}

	$errors = array();

	function test_input($data) {
		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	// if submitted
	if(isset($_POST['submit'])) {
		$username = mysql_real_escape_string($_POST['username']);
		$email = mysql_real_escape_string($_POST['email']);
		$password = mysql_real_escape_string($_POST['password']);
		$confirm_password = mysql_real_escape_string($_POST['confirm_password']);

		# Validate each data from submitted form_data
	if(empty($username)) {
		array_push($errors, "Username is required!");
	}

	if(empty($email)) {
		array_push($errors, "Email is required!");
	} else {
		$email = test_input($email);
		// check if e-mail is well formed
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			array_push($errors, "Email is invalid format!");
		}
	}

	if(empty($password)) {
		array_push($errors, "Password is required!");
	}

	if(empty($confirm_password)){
		array_push($errors, "Confirm password is required!");
	}

	if($password != $confirm_password){
		array_push($errors, "Password and confirm password should be same!");
	}

	# If validates passes insert the data into DB
	if(count($errors) == 0) {
		$hashed_password = md5($password);
		$query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
		// Executing the query
		mysqli_query($db, $query);
		$_SESSION['username'] = $username;
		header('location: index.php');
	}
}

?>

<html>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

<title>Retromania Wordpress Theme</title>
<style>
	@import url("css/style.css");
</style>
<script type='text/javascript' src='js/jquery.min.js'></script>
</head>
<body>
	<div class="wrap">

			<?php include 'partials/_header.php'; ?>

        <div class="content">
        	<div class="content_left">
                <div class="content_right">
                	<div class="mainbar">
                        <div class="mainbar_top">
                            <div class="mainbar_bottom">
                                <div class="mainbar_inner">
                                	<div class="post">
                                    <div class="comments">
                                        <div class="post_line"></div>
                                        <h3>Register</h3>
																				<!-- <?php if(count($errors) > 0): ?>
																				<ul>
																					<?php foreach ($errors as $error): ?>
																						<li><?php echo $error; ?></li>
																					<?php endforeach; ?>
																				</ul>
																			<?php endif; ?> -->
                                        <form id="contact" method="post" action="register.php">
																					<!-- Name -->
																					<div>
																						<label for="contact_name">Username:</label>
																						<input type="text" id="contact_name" name="username"></input>
																						<span class="error-1" style="display: none;">Username is required</span>
																					</div>
																					<br />
																					<!-- Email -->
																					<div>
																						<label for="contact_email">Email:</label>
																						<input type="email" id="contact_email" name="email"></input>
																						<span class="error-2" style="display: none;">A valid email is required</span>
																					</div>
																					<br />
																					<!--Website -->
																					<div>
																						<label for="password">Password:</label>
																						<input type="password" id="password" name="password"></input>
																						<span class="error-3" style="display: none;">Password is required</span>
																					</div>
																					<br />
																					<!-- Message -->
																					<div>
																						<label for="confirm_password">Confirm password:</label>
																						<input type="password" id="confirm_password" name="confirm_password"></input>
																						<span class="error-4" style="display: none;">Confirm password is required</span>
																					</div>
																					<br />
																					<!-- Submit Button -->
																					<div id="contact_submit">
																						<input type="submit" name="submit" class="submit" value="Register">
																					</div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
	        </div>
          	<?php include 'partials/_footer.php'; ?>
        </div>
    </div>

<div align="center">Сайт создан в системе <a href="http://www.ucoz.ru/" title="Создать сайт бесплатно">uCoz</a><br /></div>
</body>

</html>
<script>

// Real-time frontend validation
    $('#contact_name').on('input', function(){
        if($(this).val() == "") {
            $('.error-1').show();
        } else {
            $('.error-1').hide();
        }
    });
    $('#contact_email').on('input', function(){
        if (!(/(.+)@(.+){2,}\.(.+){2,}/.test($(this).val())) || $(this).val() == ""){
            $('.error-2').show();
        } else {
            $('.error-2').hide();
        }
    });
		$('#password').on('input', function(){
				if($(this).val() == "") {
						$('.error-3').show();
				} else {
						$('.error-3').hide();
				}
		});
		$('#confirm_password').on('input', function(){
				if($(this).val() == "") {
						$('.error-4').show();
				} else {
						$('.error-4').hide();
				}
		});
		// End of real-time frontend
		// On submit
		    $('#contact').submit(function(e){
		            // Values from inputs
		            var name = $('#contact_name').val();
		            var email = $("#contact_email").val();
		            var pass = $('#password').val();
		            var confirm_pass = $('#confirm_password').val();
		            // Name validation
		            if (name == ""){
		                $('.error-1').show();
		                var flag_n = false;
		            } else {
		                flag_n = true;
		            }
		            // Email validation
		        		if (!(/(.+)@(.+){2,}\.(.+){2,}/.test(email)) || email == ""){
		                $('.error-2').show();
		                var flag_e = false;
		            } else {
		                flag_e = true;
		            }
								//Password validation
								if (pass == ""){
										$('.error-3').show();
										var flag_p = false;
								} else {
										flag_p = true;
								}
								//Confirm password validation
								if (confirm_pass == ""){
										$('.error-4').text('Confirm password is required!')
										$('.error-4').show();
										var flag_c = false;
								} else {
										if(confirm_pass != pass){
											$('.error-4').text('Confirm password should be same')
											$('.error-4').show();
											var flag_c = false;
										} else {
											flag_c = true;
										}
								}
		            if (flag_n == true && flag_e == true && flag_p == true && flag_c == true) {
		                return true;
		            }
								e.preventDefault();
		    });
				</script>
