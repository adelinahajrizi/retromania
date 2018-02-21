<?php

$db = mysqli_connect('localhost', 'root', '', 'retromania');

if(!$db) {
	die("Failure in connection to db: " . mysqli_connect_error());
}

# BACKEND VALIDATION FORM
# Array of errors
$errors = array();

function test_input($data) {
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

# Check if submit is clicked
if(isset($_POST['submit'])) {
	# Get the data from submitted form
	$name = mysql_real_escape_string($_POST['name']);
	$email = mysql_real_escape_string($_POST['email']);
	$website = mysql_real_escape_string($_POST['website']);
	$gender = mysql_real_escape_string($_POST['gender']);
	$occupation = mysql_real_escape_string($_POST['occupation']);
	$message =  mysql_real_escape_string($_POST['message']);

	# Validate each data from submitted form_data
	if(empty($name)) {
		array_push($errors, "Name is required!");
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

	if(empty($website)){
		array_push($errors, "Website is required");
	} else{
		$website = test_input($_POST["website"]);
		if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
  	array_push($errors, "Invalid URL");
		}
	}

	if(empty($gender)) {
		array_push($errors, "Gender should be selected");
	}

	if(empty($occupation)) {
		array_push($errors, "Occupation should be chosen");
	}

	if(isset($_POST['receive_updates'])) {
		$final_receive_u = true;
	} else {
		$final_receive_u = false;
	}

	if(empty($message)){
		array_push($errors, "Message is required!");
	} else {
		if (strlen($message) < 4) {
			array_push($errors, "Message is too short!");
		}
	}

	# If validatins passes insert the data into DB
	if(count($errors) == 0) {
		$query = "INSERT INTO contacts (name, email, website, gender, occupation, receive_updates, message) VALUES ('$name', '$email', '$website', '$gender', '$occupation', '$final_receive_u', '$message')";
		// Executing the query
		mysqli_query($db, $query);
		header('location: index.php');
	}
}
?>


<!DOCTYPE html>
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
                                        <h3>Contact Us</h3>
                                        <form id="contact" method="post" action="">
																					<!-- Name -->
																					<div>
																						<label for="contact_name">Name:</label>
																						<input type="text" id="contact_name" name="name"></input>
																						<span class="error-1" style="display: none;">This field is required</span>
																					</div>
																					<br />
																					<!-- Email -->
																					<div>
																						<label for="contact_email">Email:</label>
																						<input type="text" id="contact_email" name="email"></input>
																						<span class="error-2" style="display: none;">A valid email is required</span>
																					</div>
																					<br />
																					<!--Website -->
																					<div>
																						<label for="contact_website">Website:</label>
																						<input type='text' id="contact_website" name="website"></input>
																						<span class="error-3" style="display: none;">A valid url is required</span>
																					</div>
																					<br />
																					<!-- Radio button -->
																					<div style="float:left;" class="g-cont">
																						<p style="display: inline;">Gender:</p>
																				      Male <input type="radio" id="gender" name="gender" value="male">
																				      Female <input type="radio" id="gender" name="gender" value="female">
																							<span class="error-5" style="display: none;">Gender is required</span>
																					</div><br /><br /><br />

																					<!-- Select -->
																					<div style="float:left" class="left-div">
																						<label style="width:auto;">Choose occupation: </label>
																						<select id="occupation" name="occupation">
																						<option></option>
																						<option value="student">Student</option>
																						<option value="employed">Employed</option>
																						<option value="self-employed">Self-employed</option>
																						<option value="unemployed">Unemployed</option>
																					</select>
																					<span class="error-6" style="display: none;">Occupation is required</span>
																				</div><br /><br />

																					<!-- Checkbox -->
																					Receive updates: <input type="checkbox" name="receive_updates" /><br /><br />
																					<div>
																						<label for="contact_message">Message:</label>
																						<textarea id="contact_message" name="message"></textarea>
																						<span class="error-4" style="display: none;">This field is required</span>
																					</div>
																					<br />
																					<!-- Submit Button -->
																					<div id="contact_submit">
																						<input type="submit" name="submit" class="submit" value="Submit">
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
    $('#contact_website').on('input', function(){
        var url = 'http://'+$(this).val();
        if (!(/(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/.test(url)) || url == ""){
            $('.error-3').show();
        } else {
            $('.error-3').hide();
        }
    });

		$('gender').on('input', function(){
			var radios = document.getElementsByName("gender");
			var valid = false;
			var i =0;
			if(!valid && i < radios.length){
				if (radios[i].checked) valid = true;
        i++;
			}
			if (!valid){
				$('.error-5').show();
			} else {
				$('.error-5').hide();
			}
		});
		$('occupation').on('input', function(){
			var occupationElement = document.getElementById('occupation');
			if(!occupationElement.value){
				$('.error-6').show();
			} else {
				$('.error-6').hide();
			}
		});
    $('#contact_message').on('input', function(){
        if ($(this).val() == "") {
            $('.error-4').text('This field is required!');
            $('.error-4').show();
        } else {
            if ($(this).val().length < 5) {
                $('.error-4').text('Message should be more than 5 chars!');
                $('.error-4').show();
            } else {
                $('.error-4').hide();
            }
        }
    });
    // End of real-time frontend
// On submit
    $('#contact').submit(function(e){
            // Values from inputs
            var name = $('#contact_name').val();
            var email = $("#contact_email").val();
            var url = 'http://'+$('#contact_website').val();
            var message = $('#contact_message').val();
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
            // URL validation
            if (!(/(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:\/~+#-]*[\w@?^=%&amp;\/~+#-])?/.test(url)) || url == ""){
                $('.error-3').show();
                var flag_url = false;
            } else {
                flag_url = true;
            }
						// Gender validation
						var radios = document.getElementsByName("gender");
						var valid = false;
						var i =0;
						if(!valid && i < radios.length){
							if (radios[i].checked) valid = true;
			        i++;
						}
						if (!valid){
							$('.error-5').show();
						} else {
							$('.error-5').hide();
						}
						//Occupation validation
						var occupationElement = document.getElementById('occupation');
						if(!occupationElement.value){
							$('.error-6').show();
						} else {
							$('.error-6').hide();
						}
            // Message validation
            if (message == "") {
                $('.error-4').text('This field is required!');
                $('.error-4').show();
                var flag_m = false;
            } else {
                if (message.length < 5) {
                    $('.error-4').text('Message should be more than 5 chars!');
                    $('.error-4').show();
                    var flag_m = false;
                } else {
                    flag_m = true;
                }
            }
            if (flag_n == true && flag_e == true && flag_url == true && flag_m == true) {
                return true;
            }
            e.preventDefault();
    });
</script>
