<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Scholastic - What's happening</title>
  <script src="https://kit.fontawesome.com/ded7d2cbbf.js" crossorigin="anonymous"></script>
  <script defer src="<?php echo base_url("application/assets/js/Create.js"); ?>"></script>
  <link rel="shortcut icon" href="<?php echo base_url("application/assets/images/book-white-title.png"); ?>" type="image/x-icon" />
  <?php echo link_tag("application/assets/css/Create.css") ?>
</head>

<body>
  <div class="form" id="form">
    <?php echo form_open_multipart("Scholastic/create_event", array("autocomplete" => "off")) ?>
    <i class="fas fa-pencil-alt"></i> <i class="far fa-times-circle"></i>
    <h2 class="create">Create an Event</h2>
    <div class="inp-cont">
      <input class="Req" type="text" name="title" id="title" required onkeyup="EnableButton()" maxlength="20" /><label for="title">Title</label><span class="error_cont"></span>
    </div>
    <br />
    <div class="inp-cont">
      <textarea class="Patt" type="text" name="desc" id="desc" required onkeyup="EnableButton()"></textarea><label for="desc">Description</label><span class="error_cont"></span>
    </div>
    <br />
    <div class="btn-cont"><button class="signup-conf" type="submit">Create Event</button></div>
    <div class="super-prog-cont">
      <div class="nmb-container">
        <span class="progress-nmb">0</span>
      </div>
      <div class="progress-bar" id="progress-bar">
        <div class="progress-inner" id="progress-inner"></div>
      </div>
    </div>
    <div class="inp-cont">
      <input class="check_file" name="file" type="file" accept="image/png, image/jpg, image/gif" onchange="EnableButton()" /><label></label><span class="error_cont file_error_cont"></span>
      <div class="date-cont">
        <i class="fas fa-calendar-alt"></i><input type="date" name="date" class="ev_date" onchange="EnableButton()" /><label></label><span class="error_cont file_error_cont"></span>
      </div>
    </div>
    <?php echo form_close() ?>
  </div>
</body>