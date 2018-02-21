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
		$password = mysql_real_escape_string($_POST['password']);

		# Validate each data from submitted form_data
	if(empty($username)) {
		array_push($errors, "Username is required!");
	}

	if(empty($password)) {
		array_push($errors, "Password is required!");
	}

	# If validates passes insert the data into DB
	if(count($errors) == 0) {
		$hashed_password = md5($password);
		$query = "SELECT * FROM users WHERE username = '$username' AND password = '$hashed_password'";
		// Executing the query
    $result = mysqli_query($db, $query);
		if(mysqli_num_rows($result) == 1) {
      $_SESSION['username'] = $username;
      header('location: index.php');
    } else {
			$_SESSION['login_err_msg'] = "Username or password not correct!";
			header('location: login.php');
		}
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
                                        <h3>Log in</h3>
																				<!--<?php if(count($errors) > 0): ?>
																				<ul>
																					<?php foreach ($errors as $error): ?>
																						<li><?php echo $error; ?></li>
																					<?php endforeach; ?>
																				</ul>
																			<?php endif; ?> -->
                                        <form id="contact" method="post" action="login.php">
																					<div>
																						<label for="contact_name">Username:</label>
																						<input type="text" id="contact_name" name="username"></input>
																						<span class="error-1" style="display: none;">Username is required</span>
																					</div>
																					<br />
																					<div>
																						<label for="password">Password:</label>
																						<input type="password" id="password" name="password"></input>
																						<span class="error-2" style="display: none;">Password is required</span>
																					</div>
																					<br />
																					<br />
																					<?php if(isset($_SESSION['login_err_msg'])): ?>
																						<?php
																							echo "<p>";
																							echo $_SESSION['login_err_msg'] . "<br/>";
																							echo "</p>";
																							unset($_SESSION['login_err_msg']);
																						?>
																					<?php endif; ?>
																					<!-- Submit Button -->
																					<div id="contact_submit">
																						<input type="submit" name="submit" class="submit" value="Login">
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
	$('#password').on('input', function(){
			if($(this).val() == "") {
					$('.error-2').show();
			} else {
					$('.error-2').hide();
			}
	});
	// End of real-time frontend
	//On submit
	$('#contact').submit(function(e){
					// Values from inputs
					var name = $('#contact_name').val();
					var pass = $("#password").val();
					// Name validation
					if (name == ""){
							$('.error-1').show();
							var flag_n = false;
					} else {
							flag_n = true;
					}
					// Password validation
					if (pass == ""){
							$('.error-2').show();
							var flag_p = false;
					} else {
							flag_p = true;
					}
					if (flag_n == true && flag_p == true) {
							return true;
					}
					e.preventDefault();
				});
		</script>
