<!DOCTYPE html>
<html>

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

<title>Retromania Wordpress Theme</title>
<style>
	@import url("css/style.css");
</style>
<link rel="stylesheet" href="css/vanillaslider.css">
<script src="js/vanillaslider.js"></script>
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
                                    	<div class="post_date">
                                        	<div class="post_date_top">11</div>
                                            <div class="post_date_bottom">Jul</div>
                                        </div>
                                    	<h2 class="post_header"><a href="#">ADELINA ROCKS!!!</a></h2>
                                        <div class="post_line"></div>
                                        <div class="post_content">
                                        <p>
                                        	This is my first theme. It needs some alterations. So, keep watch over renewal ;)
RED STAR! Theme entirely compatible with wordpress version 2.5 and it cut out under GPL license. So, you can be brave in using this one, but please, don’t take away the link of my site.</p>
<p>
If you have any questions in using or setting it, feel free to ask me. I’ll be glad to answer.
RED STAR! Theme for Wordpress v.2.5 (.zip file 169KB).</p>
										<p>
                                        <strong>Instalation:</strong>
                                        </p>

                                        <ol>
                                        <li>Download the RedStar! Theme from my site</li>
                                        <li>Unzip redstar folder into /wp-content/themes/ in your server</li>
                                        <li>Enter redstar folder and open contact.php file</li>
                                        <li>Change data on your lines 12 and 13
                                              <ul>
                                              <li>$your_site=”Your site address”;/Edit this address/</li>
                                              <li>$mailto=”Your e-mail address”;/Edit this e-mail/</li>
                                              </ul>
                                         </li>
                                        <li>After it enter the administration panel into design inset and choose the Red Star! theme active</li>
                                        <li>Download the Brian’s Latest Comments (mirror) plugin</li>
                                        <li>Unzip brianslatestcomments.php file into /wp-content/plugins/ in your server</li>
                                        <li>After it enter the administration panel into Plugins inset and activate Brian’s Latest Comments Plugin.</li>
                                        </ol>

                                        </div>
                                        <div class="post_data">
                                        	Posted by <a href="#">Jay Hafling</a> on June 21st, 2008 in <a href="#">Wordpress Themes</a> and have <a href="#">Comments (11)</a>                                </div>

                                    </div>

                                    <div class="comments">
                                    	<h1>Comments</h1>
                                        <div class="post_line"></div>
                                        <div class="comment">
                                            <div class="comment_data">
                                                <a href="#">Jay Hafling</a> on June 21st, 2008
                                            </div>
                                            <p>
                                            This is my first theme. It needs some alterations. So, keep watch over renewal ;)
                                            </p>
                                        </div>
                                        <h3>Slider</h3>
																				<div class="vanilla-slider">
																				  <ul class="vanilla-slider-container"
																				      data-height="300"
																				      data-width="400">
																				    <li><img src="images/1.jpg"></li>
																				    <li><img src="images/rsz_nature-2.jpg"></li>
																						<li><img src="images/rsz_nature-3.jpg"></li>
																				  </ul>
																				</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar">
                    	<ul>
                       		<li>
                            	<form class="sidebar_search">
                                	<input type="text" class="search_input" value="Search" /><input type="submit" value="Go" class="submit_search" />
                                </form>
                            </li>
                 <li>
            	<h2>Categories</h2>
                    <ul>
                        <li><a title="Wordpress Themes" href="#">Wordpress Themes</a></li>
                        <li><a title="Wordpress Themes" href="#">Design</a></li>
                        <li><a title="Wordpress Themes" href="#">Webdesign</a></li>
                        <li><a title="Wordpress Themes" href="#">City</a></li>
                        <li><a title="Wordpress Themes" href="#">Urban Live</a></li>
                        <li><a title="Wordpress Themes" href="#">Redstar Theme</a></li>
                        <li><a title="Wordpress Themes" href="#">Green Blood Theme</a></li>
                    </ul>
                </li>
                <li>
            	<h2>Latest posts</h2>
                    <ul>
                        <li><a title="Wordpress Themes" href="#">6 Steps A Designer Should Consider Doing To Prepare For A Website Project</a></li>
                        <li><a title="Wordpress Themes" href="#">Speed Up Your Development Time With The Blueprint CSS Framework</a></li>
                        <li><a title="Wordpress Themes" href="#">Display A Google Ad After Your Blog Posts In Wordpress</a></li>
                    </ul>
                </li>
								<li>
            	<h2>META</h2>
                    <ul>
                        <li><a title="Wordpress Themes" href="#">See Admin</a></li>
												<?php if(isset($_SESSION['username'])): ?>
														<li><a href="logout.php">Logout</a></li>
												<?php else: ?>
													<li><a title="Wordpress Themes" href="login.php">Login</a></li>
                        	<li><a title="Wordpress Themes" href="register.php">Sign up</a></li>
												<?php endif; ?>
                    </ul>
                </li>

                        </ul>
                    </div>
                    <div class="clear"></div>

                </div>
	        </div>
            <?php include 'partials/_footer.php'; ?>
        </div>
    </div>

<div align="center">Сайт создан в системе <a href="http://www.ucoz.ru/" title="Создать сайт бесплатно">uCoz</a><br /></div>
<script>
	var mySlider = document.querySelector('.vanilla-slider');
	var vanillaSlider = new VanillaSlider(mySlider);
	vanillaSlider.init({
		// autoplay
		autoplay: true,

		// autoplay interval
		autoplayTime: 3000,

		// shows navigation
		control: true,

		// shows pagination
		pagination: true
	});

</script>
</body>

</html>
