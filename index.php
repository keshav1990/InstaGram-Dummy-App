<?php

require 'instagram.class.php';

// initialize class
$instagram = new Instagram(array(
  'apiKey'      => '8387e541978142fd9d221a79b01e61bb',
  'apiSecret'   => '20c9cc87010849bc99fcd54daf415ef9',
  'apiCallback' => 'http://neowebsolution.com/ig/success.php' // must point to success.php
));

// create login URL
$loginUrl = $instagram->getLoginUrl(array(
  'basic',
  'likes',
  'relationships'
));

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram - OAuth Login</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <style>
      .login {
        display: block;
        font-size: 20px;
        font-weight: bold;
        margin-top: 50px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <header class="clearfix">
        <h1>Instagram <span>display your photo stream</span></h1>
      </header>
      <div class="main">
        <ul class="grid">
          <li><img src="assets/instagram-big.png" alt="Instagram logo"></li>
          <li>
            <a class="login" href="<? echo $loginUrl ?>">» Login with Instagram</a>
            <h>Use your Instagram account to login.</h4>
          </li>
        </ul>
      
      </div>
    </div>
  </body>
</html>