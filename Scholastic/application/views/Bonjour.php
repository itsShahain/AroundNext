<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="<?php echo base_url("application/assets/images/book-white-title.png"); ?>" type="image/x-icon" />
  <script src="https://kit.fontawesome.com/ded7d2cbbf.js" crossorigin="anonymous"></script>
  <script defer src="<?php echo base_url("application/assets/js/Bonjour.js") ?>"></script>
  <link rel="stylesheet" href="<?php echo base_url("application/assets/css/Bonjour.css") ?>">
  <script src="http://localhost/Shahain/Scholastic/application/assets/js/jquery-3.6.0.min.js"></script>
  <title>Scholastic - Bonjour!</title>
  <style>
    .school {
      background: url(<?php echo base_url("application/assets/images/happening.png") ?>);
    }
  </style>

</head>

<body>
  <div class="container">
    <div class="school"><img src="<?php echo base_url("application/assets/images/scholastic.svg") ?>" alt="" class="aniSVG" /></div>
    <div class="details">
      <div class="detail-cont">
        <img src="<?php echo base_url("application/assets/images/Scholastic-logos_white.png") ?>" alt="" class="logo" />
        <div class="sub-cont">
          <h1 class="header-main">It's What's Happening Now...</h1>
          <h3 class="header-sub">Join to see what's coming up.</h3>
          <button class="signup">Sign up with email</button><br />
          <p class="agree">
            By signing up you agree to the use of data governed by the
            <a href="https://gdpr-info.eu/">General Data Protection Regulation</a>
            and
            <a href="https://gdpr.eu/cookies/">Cookie Use.</a>
          </p>
          <span class="strike"></span><span> or </span><span class="strike"></span>
          <p class="question">Already have an account?</p>
          <button class="signin">Sign in</button>
        </div>
      </div>
    </div>
  </div>
  <div class="form" id="form">
    <img class="book" src="<?php echo base_url("application/assets/images/book-white.png") ?>" alt="" />
    <i class="far fa-times-circle"></i>
    <h2 class="create">Create your account</h2>
    <?php echo form_open("Scholastic/sign_up", array("autocomplete" => "off")) ?>
    <div class="inp-cont"><input class="Req" type="text" name="name" id="name" required onkeyup="EnableButton()" maxlength="20" /><label for="name" style="cursor: pointer;">Name</label><span></span></div>
    <br />
    <div class="inp-cont"><input class="Patt" type="text" name="email" id="email" required onkeyup="EnableButton()" maxlength="30" /><label for="email" style="cursor: pointer;">Email</label><span></span></div>
    <br />
    <div class="inp-cont"><input class="Req" type="text" name="cteacher" id="cteacher" required onkeyup="EnableButton()" maxlength="25" /><label for="cteacher" style="cursor: pointer;">Class Teacher</label><span></span></div>
    <br />
    <div class="btn-cont"><button class="signup-conf" type="submit">Sign up</button></div>
    <?php echo form_close() ?>
  </div>
</body>

</html>