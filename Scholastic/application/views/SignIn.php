<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <script defer src="<?php echo base_url("application/assets/js/SignIn.js") ?>"></script>
  <script src="https://kit.fontawesome.com/ded7d2cbbf.js" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="<?php echo base_url("application/assets/images/book-white-title.png"); ?>" type="image/x-icon" />
  <link rel="stylesheet" href="<?php echo base_url("application/assets/css/SignIn.css") ?>">
</head>

<body>
  <div class="form" id="form">
    <img class="book" src="<?php echo base_url("application/assets/images/book-white.png") ?>" alt="" />
    <i class="far fa-times-circle"></i>
    <h2 class="create">Sign in to your account</h2>
    <?php echo form_open("Scholastic/validate_sign_in", array("autocomplete" => "off")) ?>
    <div class="inp-cont"><input class="Req" type="text" name="name" id="name" required onkeyup="EnableButton()" maxlength="20" /><label for="name">Name</label><span class="error_cont"><?php echo form_error('name', ' ', ' '); ?></span></div>
    <br />
    <div class="inp-cont"><input class="Patt" type="text" name="email" id="email" required onkeyup="EnableButton()" maxlength="30" /><label for="email">Email</label><span class="error_cont"><?php echo form_error('email', ' ', ' '); ?></span></div>
    <br />
    <div class="btn-cont"><button class="signup-conf" type="submit">Sign in</button></div>
    <?php echo form_close() ?>
  </div>


</body>


</html>