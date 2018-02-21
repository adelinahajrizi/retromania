<?php session_start(); ?>
<div class="header">
    <h1 class="logo"><a href="#">Retromania Theme</a></h1>
      <div class="description">Wordpress theme created by Jay Hafling</div>
      <div class="subscribe_rss"><a href="#">Subscribe<br />in a rss</a></div>
      <div class="subscribe_email"><a href="#">Send me<br />a message</a></div>
      <ul class="menu">
      <li>
        <ul>
          <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About me</a></li>
              <li><a href="contact.php">Contacts</a></li>
              <?php if(isset($_SESSION['username'])): ?>
              <li><a href="contacts_result.php">Contacts result</a></li>
            <?php endif; ?>
              <li><a href="portfolio.php">Portfolio</a></li>
          </ul>
      </li>
      </ul>
  </div>
