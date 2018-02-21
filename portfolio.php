<?php

	session_start();

  if(!isset($_SESSION['username'])){
    header('location: login.php');
  }

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
	if(isset($_POST['post'])) {
		$title = mysql_real_escape_string($_POST['title']);
		$description = mysql_real_escape_string($_POST['description']);
    $filename = basename($_FILES['image']['name']);

    $target = 'uploads/'.basename($_FILES['image']['name']);

	# Validate each data from submitted form_data
	if(empty($title)) {
		array_push($errors, "Username is required!");
	}

	if(empty($description)){
		array_push($errors, "Password is required!");
	}

  if(empty($filename)){
		array_push($errors, "Image should be chosen!");
	}

	# If validates passes insert the data into DB
	if(count($errors) == 0) {
    if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $query = "INSERT INTO portfolio (title, description, image) VALUES ('$title', '$description', '$filename')";
  		// Executing the query
  		mysqli_query($db, $query);
      header('location: portfolio.php');
    }
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
                                        <h2>Posts Feed:</h2>
                                        <?php
                                          $db = mysqli_connect('localhost', 'root', '', 'retromania');
                                          $query = "SELECT * FROM portfolio ORDER BY id DESC";
                                          $result = mysqli_query($db, $query);

                                          while($row = mysqli_fetch_array($result)){
                                            echo "<div id='post'>";
                                              echo "<h1>".$row['title']."</h1><br />";
                                              echo "<p>".$row['description']."</p><br />";
                                              echo '<img src="uploads/'.$row['image'].'" width="360" /><br /><br />';
                                            echo "</div>";
                                          }

                                        ?>
                                        <h3>Post</h3>
                                        <form id="contact" method="post" action="portfolio.php" enctype="multipart/form-data">
                                          <input type="hidden" name="size" size="1000000"></input>
																					<!-- Name -->
																					<div>
																						<label for="title">Title:</label>
																						<input type="text" id="title" name="title"></input>
																						<span class="error-1" style="display: none;">This field is required</span>
																					</div>
																					<br />
																					<!-- Email -->
																					<div>
																						<label for="description">Description:</label>
																						<textarea type="text" id="description" name="description"></textarea>
																						<span class="error-2" style="display: none;">This field is required</span>
																					</div>
																					<br />
																					<br />
																					<!--Website -->
																					<div>
																						<label for="image">Image:</label>
																						<input style="width: 182px;" type="file" id="image" name="image"></input>
																						<span class="error-3" style="display: none;">Image should be uploaded!</span>
																					</div>
																					<br />
																					<br />
																					<!-- Submit Button -->
																					<div id="contact_submit">
																						<input type="submit" class="submit" name="post" value="Post">
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
	$('#title').on('input', function(){
			if($(this).val() == "") {
					$('.error-1').show();
			} else {
					$('.error-1').hide();
			}
	});

	$('#description').on('input', function(){
			if ($(this).val() == "") {
					$('.error-2').text('This field is required!');
					$('.error-2').show();
			} else {
					if ($(this).val().length < 5) {
							$('.error-2').text('Message should be more than 5 chars!');
							$('.error-2').show();
					} else {
							$('.error-2').hide();
					}
			}
	});
	// End of real-time frontend
	//On submit
	$('#contact').submit(function(e){
					// Values from inputs
					var title = $('#title').val();
					var description = $("#description").val();
					var img_file = $('#image').val();

					// Title validation
					if (title == ""){
							$('.error-1').show();
							var flag_t = false;
					} else {
							flag_t = true;
					}

					// Description validation
					if (description == "") {
							$('.error-2').text('This field is required!');
							$('.error-2').show();
							var flag_d = false;
					} else {
							if (description.length < 5) {
									$('.error-2').text('Message should be more than 5 chars!');
									$('.error-2').show();
									var flag_d = false;
							} else {
									flag_d = true;
							}
					}

					// Image validation
					if(img_file == ''){
						$('.error-3').show();
						var flag_i = false;
					} else {
						flag_i = true;
					}


					if (flag_t == true && flag_d == true && flag_i == true) {
							return true;
					}
					e.preventDefault();
				});
		</script>
