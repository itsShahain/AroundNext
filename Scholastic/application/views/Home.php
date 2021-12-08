<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/ded7d2cbbf.js" crossorigin="anonymous"></script>
  <script src="http://localhost/Shahain/Scholastic/application/assets/js/jquery-3.6.0.min.js"></script>
  <link rel="shortcut icon" href="<?php echo base_url("application/assets/images/book-white-title.png"); ?>" type="image/x-icon" />
  <script defer src="http://localhost/Shahain/Scholastic/application/assets/js/Home.js"></script>
  <?php echo link_tag('application/assets/css/Home.css') ?>
  <title>Scholastic - What's happening</title>
</head>

<body id="main">
  <div class="mobile-search-super-container">
    <i class="far fa-times-circle" id="close-search"></i>
    <div class="search-cont" id="search-cont-mobile"><input class="search-bar" id="search-bar-mobile" type="text" placeholder="Search for events" /><i class="fas fa-search search-query-mobile search-query"></i></div>
  </div>

  <div class="create-new-bottom">
    <div class="tag tag-create" id="tag-create-mobile"><i class="fas fa-pencil-alt"></i><span>Create Event</span></div>
  </div>
  <div class="bottom-menu">
    <div class="tag tag1" id="home-mobile"><img src="<?php echo base_url("application/assets/images/book-white.png") ?>" alt="" /></div>
    <div class="tag tag2 beta"><i class="fas fa-school"></i><span>School</span></div>
    <div class="tag tag3" id="bookmark-mobile"><i class="fas fa-bookmark"></i><span>Bookmarks</span></div>
    <div class="tag tag4" id="new-num-mobile-tag"><span id="new-num-mobile">0</span><i class="fas fa-bell"></i><span>New Events</span></div>
    <div class="tag tag6" id="tag6-mobile"><i class="fas fa-search"></i><span>Search</span></div>
    <div class="tag tag5 beta"><i class="fas fa-list-ul"></i><span>My Lists</span></div>
  </div>
  <div class="container">
    <div class="left">
      <div class="left-container">
        <div class="tag tag1" id="home-main"><img src="<?php echo base_url("application/assets/images/book-white.png") ?>" alt="" /></div>
        <div class="tag tag2 beta" ><i class="fas fa-school"></i><span>School</span></div>
        <div class="tag tag3" id="bookmark-main"><i class="fas fa-bookmark"></i><span>Bookmarks</span></div>
        <div class="tag tag4" id="new-num-main-tag"><span id="new-num-main">3</span><i class="fas fa-bell"></i><span>New Events</span></div>
        <div class="tag tag6" id="tag6-main"><i class="fas fa-search"></i><span>Search</span></div>
        <div class="tag tag5 beta"><i class="fas fa-list-ul"></i><span>My Lists</span></div>
      </div>
      <!-- <i class="fas fa-search"></i> -->
      <div class="create-new">
        <div class="tag tag-create" id="tag-create-main"><i class="fas fa-pencil-alt"></i><span>Create Event</span></div>
      </div>
      <div class="profile-cont">
        <div class="profile-bottom"><i class="fas fa-user"></i><span><?php echo $whoami ?></span></div>
      </div>
    </div>
    <div class="mid">
      <div class="polka">
        <div class="header">
          <div class="hero-main">
            <h1>Scholastic</h1>
            <h2>Ad Astra!</h2>
          </div>
          <div class="whereami"><?php echo $whereami; ?></div>
        </div>
      </div>
      <div class="event-cont">
        <?php foreach ($Events as $Event) {
          echo $Event;
        } ?>
      </div>
    </div>
    <div class="right">
      <div class="search-super-cont">
        <div class="search-cont" id="search-cont-main"><input class="search-bar" id="search-bar-main" type="text" placeholder="Search for events" /><i class="fas fa-search search-query-main search-query"></i></div>
      </div>
      <h2 class="news-hero">School News</h2>
      <div class="school-news">
        <div class="card-frame" id="card-frame">
          <div class="cards-container">
            <div class="cards">
              <div class="card one">
                <div class="card-content">
                  <h2 class="card-title">It's What's Happening!</h2>
                  <div class="card-body">
                    Scholastic proudly launched it's first ever upcoming event management system on the 6th of December 2021. A platform to share all upcoming events!
                  </div>
                </div>
              </div>
            </div>
            <div class="cards">
              <div class="card two">
                <div class="card-content">
                  <h2 class="card-title">STEM 2021</h2>
                  <div class="card-body">
                    A call to submit the projects for the annual STEM (Science Technology Engineering & Management) competition by the 14th of December.
                  </div>
                </div>
              </div>
            </div>
            <div class="cards">
              <div class="card three">
                <div class="card-content">
                  <h2 class="card-title">A talk on Social Media</h2>
                  <div class="card-body">
                    Social media albeit awesome has some setbacks... Join us to learn more during this talk on the 15th of December.
                  </div>
                </div>
              </div>
            </div>
            <div class="cards">
              <div class="card four">
                <div class="card-content">
                  <h2 class="card-title">A season of giving!</h2>
                  <div class="card-body"> Join us in making this season of Christmas joyful in donating to the needy! Please contact your class teacher to know more.</div>
                </div>
              </div>
              <div class="cards">
                <div class="card five">
                  <div class="card-content">
                    <h2 class="card-title">Our new Drama Club!</h2>
                    <div class="card-body">
                      Scholastic proudy launches it's first ever Drama club on the 4th of January 2022. All are welcome to join.
                    </div>
                  </div>
                </div>
              </div>
              <div class="cards">
                <div class="card six">
                  <div class="card-content">
                    <h2 class="card-title">'22 Hackathon : Open</h2>
                    <div class="card-body">
                      Admissions are now open for the 2022 January Hackathon!
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


</body>


</html>