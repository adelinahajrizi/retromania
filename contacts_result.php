<?php
  session_start();
  if(!isset($_SESSION['username'])){
    header('location: login.php');
  }
?>

<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

<title>Retromania Wordpress Theme</title>
<style>
	@import url("css/style.css");
</style>
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
                                <div class="mainbar_inner table-container">
                                	<div class="post">
                                    <div class="comments">
                                        <table border='1'>
                                          <thead>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Website</th>
                                            <th>Gender</th>
                                            <th>Occupation</th>
                                            <th>Receive Updates</th>
                                            <th>Message</th>
                                          </thead>
                                          <tbody>
                                            <?php
                                              $db = mysqli_connect('localhost', 'root', '', 'retromania');
                                              $query = "SELECT * FROM contacts";
                                              $result = mysqli_query($db, $query);

                                              while($row = mysqli_fetch_array($result)){

                                                if($row['receive_updates'] == true){
                                                  $final_receive_u = 'Yes';
                                                }else {
                                                  $final_receive_u = 'No';
                                                }

                                                echo "<tr><td>".$row['name']."</td>";
                                                echo "<td>".$row['email']."</td>";
                                                echo "<td>".$row['website']."</td>";
                                                echo "<td>".$row['gender']."</td>";
                                                echo "<td>".$row['occupation']."</td>";
                                                echo "<td>".$final_receive_u."</td>";
                                                echo "<td>".$row['message']."</td></tr>";
                                              }
                                            ?>
                                          </tbody>
                                        </table>
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
