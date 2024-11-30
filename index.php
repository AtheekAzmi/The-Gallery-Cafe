<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-solid-rounded/css/uicons-solid-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-bold-rounded/css/uicons-bold-rounded.css'>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatibel" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <title>The Gallery Café | Home</title>
</head>

<body>
    <!-- Navigation Bar -->    
    <div class="header">
        <div class="logo">
            <a href="#hero"><img src="images/logo 1.png" alt=""></a>
        </div>
        <div class="bar">
            <a href="login.php"><i class='bx bx-menu bx-md'></i></a>
            <i class='bx bx-x bx-md' id="cross"></i>
        </div>
        <div class="nav">
            <ul>
                <a href="#aboutus">
                    <li>About</li>
                </a>
                <a href="#menu">
                    <li>Menu</li>
                </a>
                <a href="#story">
                    <li>Story</li>
                </a>
                <a href="#event">
                    <li>Events</li>
                </a>
                <a href="reserve.php">
                    <li>Reserve Online</li>
                </a>
            </ul>
        </div>
            <div class="account">
                <ul>
                  <a href="#">
                      <li>
                        <a href="#contactus"><i class='bx bx-phone-call bx-sm'></i></a>
                      </li>
                      <li>
                          <a href="signup.php"><i class="bx bx-user bx-sm" id="user"></i></a>
                      </li>
                      <li>
                          <a href="logout-user.php"><i class="fi fi-br-exit"></i></a>
                      </li>
                    </a>
                </ul>
            </div>
    </div>

    <!-- Hero section with image and short title -->
    <hero>
        <div class="hero" id="hero">
            <img src="images/backgound.png" alt="">
            <h1 class="welcome">Welcome to the <span class="wname">The Gallery Café</span></h1>
            <h1 class="h1-tittle">
                Elevate Your Dining Experience, Discover the Art of Fine Cuisine at <span class="name">The Gallery Café</span>
            </h1>
            </div>
            <button class="booking" onclick="location.href='reserve.php'">Book a table</button>
        </div>
    </hero>

    <!-- <div class="contactus">
      <img src="images/phone.png" alt="">
    </div> -->

    <!-- Services sesction -->
    <section class="services" id="services">
      <div class="container">
        <h1>Our Services</h1>
      </div>
        <div class="ser">
          <div class="icon"><i class="fi fi-sr-restaurant"></i></div>
          <h1>Dine-In Service</h1>
          <p>Enjoy a full-service dining experience in our comfortable and elegant dining area.</p>
        </div>
        <div class="ser">
          <div class="icon"><i class="fi fi-sr-coffee"></i></div>
          <h1>Takeout & Curbside Pickup</h1>
          <p>Savor our delicious meals from the comfort of your home.</p>
        </div>
        <div class="ser">
          <div class="icon"><i class="fi fi-sr-reservation-smartphone"></i></div>
          <h1>Reservation Services</h1>
          <p>Reserve your table in advance through our easy online booking system or by phone.</p>
        </div>
        <div class="ser">
          <div class="icon"><i class="fi fi-sr-free-delivery"></i></div>
          <h1>Delivery Service</h1>
          <p>Get your favorite dishes delivered straight to your doorstep.</p>
        </div>    
    </section>

    <!-- About us section -->  
    <section class="about">
      <h2>About Us</h2>
      <main class="aboutus" id="aboutus">
          <div class="img-about">
            <img src="images/chefcartoon.png" alt="About Us Image">
          </div>
          <div class="aboutus-content">
            <p>At <b class="bold">The Gallery Café</b>, we are passionate about crafting unforgettable dining experiences. Our culinary team combines the freshest ingredients with innovative techniques to create dishes that delight the senses. Whether you're joining us for a casual meal or a special occasion, our warm ambiance and attentive service will make you feel right at home. Come savor the flavors and traditions that make The Gallery Café a true culinary destination.</p>

            <button class="aboutusbtn">Learn More</button>
          </div>
      </main>
    </section>
      
    <!-- Menu section -->
    <section class="menu" id="menu">
        <h2 class="ourmenu">Our Menu</h2>
            <div class="menu-item">
              <img src="images/sl1.jpg" alt="Menu Item 1" class="menu-image">
              <h1 class="menu-name">Pol Rotti with Sambal</h1>
              <span class="menu-price">LKR 45.00</span>
            </div>
            <div class="menu-item">
              <img src="assets/asset 7.jpeg" alt="Menu Item 2" class="menu-image">
              <h1 class="menu-name">Fresh mixed green salad</h1>
              <span class="menu-price">LKR 110.00</span>
            </div>
            <div class="menu-item">
              <img src="images/masala_dosa.jpg" alt="Menu Item 3" class="menu-image">
              <h1 class="menu-name">Masala Dosa</h1>
              <span class="menu-price">LKR 260.00</span>
            </div>
            <div class="menu-item">
              <img src="images/food-ita.jpg" alt="Menu Item 3" class="menu-image">
              <h1 class="menu-name">Lasagna</h1>
              <span class="menu-price">LKR 140.00</span>
            </div>
            <div class="menu-item">
              <img src="images/sl-seafood 1.jpg" alt="Menu Item 3" class="menu-image">
              <h1 class="menu-name">Seafood</h1>
              
              <span class="menu-price">LKR 175.00</span>
            </div>
        <!-- redirecting to the menu page -->
        <button type="button" class="more-menu" onclick="location.href='menu1.php'">Pre-Order</button>
    </section>

    <!-- Story Section Container -->
    <section id="story" class="story-section">
        <!-- Story Header -->
        <div class="story-header">
          <h2>Our Story</h2>
          <p>Discover the passion behind our restaurant</p>
        </div>
      
        <!-- Story Content -->
        <div class="story-content">
          <div class="story-image">
            <img src="images/story.jpg" alt="Our Story">
            <img src="images/story1.jpg" alt="Our Story">
            <img src="images/story.jpg" alt="Our Story">
          </div>
          <div class="story-text">
            <p>In the heart of Beruwala, where the streets hum with life and the aroma of fresh ingredients fills the air, a dream was born. The Gallery Café began as a simple idea—an idea rooted in a deep love for food and a desire to bring people together around the table. It was here, in a cozy kitchen, that our founder, S Perera, first envisioned a place where culinary tradition would meet modern innovation, creating a space where every meal is an experience to be savored.</p>
          </div>
        </div>
      
        <!-- Story Call-to-Action -->
        <div class="story-cta">
          <button id="learn-more-btn">Learn More</button>
        </div>
      
        <!-- Modal for additional story content -->

        <div id="story-modal" class="modal">
          <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Our Story Continues...</h2>
            <p> **Our Story: From Passion to Plate**<br>

                In the heart of Beruwala, where the streets hum with life and the aroma of fresh ingredients fills the air, a dream was born. The Gallery Café began as a simple idea—an idea rooted in a deep love for food and a desire to bring people together around the table. It was here, in a cozy kitchen, that our founder, S Perera, first envisioned a place where culinary tradition would meet modern innovation, creating a space where every meal is an experience to be savored.
                
                With a passion for the finest ingredients and a commitment to excellence, S Perera set out on a journey to bring this vision to life. What started as a small, intimate dining spot has grown into a beloved destination for food lovers from all walks of life. At The Gallery Café, every dish tells a story—of the farmers and artisans who supply our ingredients, of the skilled hands that craft each plate, and of the rich culinary heritage that inspires our menu.
                
                But The Gallery Café is more than just a place to eat; it's a community. It's where friends gather to celebrate milestones, where families create lasting memories, and where strangers become friends over a shared love of great food. Our team is dedicated to making every visit special, with warm hospitality and a genuine passion for what we do.
                
                As we continue to grow and evolve, our commitment to quality remains unchanged. We invite you to join us at The Gallery Café, where every meal is a celebration of flavor, creativity, and the joy of dining together. Welcome to our table. </p>
          </div>
        </div>
    </section>

      <!-- Event Section -->
    <section class="events" id="event">
      <h2>Events</h2>
      <div class="event-slider">
        <div class="slider-container">
          <div class="slider-inner">
            <div class="event-slide">
              <img src="images/cooking class.jpg" alt="Event Image 1">
              <h3>Event 1: Cooking Classes</h3>
              <p>Guests can learn how to prepare restaurant dishes with a hands-on cooking class led by the restaurant’s chef.</p>
              <button onclick="location.href='events.php'">Learn More</button>
            </div>
            <div class="event-slide">
              <img src="images/music nigth.jpg" alt="Event Image 2">
              <h3>Event 2: Live Music Night</h3>
              <p>Enjoy live music and a special menu on Friday nights.</p>
              <button onclick="location.href='events.php'">Learn More</button>
            </div>
            <div class="event-slide">
              <img src="images/brunch.jpg" alt="Event Image 3">
              <h3>Event 3: Brunch Special</h3>
              <p>Indulge in our weekend brunch specials and mimosas.</p>
              <button onclick="location.href='events.php'">Learn More</button>
            </div>
            <!-- Add more event slides here -->
          </div>
          <div class="slider-nav">
            <button class="prev"><</button>
            <button class="next">></button>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonal Section -->
    <section class="testimonial">

      <h2 class="test-head">Testimonials</h1>
      <h1 class="test-title">What they're saying about us</h1>

      <figure class="snip1390">
        <img src="assets/asset 18.jpeg" alt="profile-sample3" class="profile" />
        <figcaption>
          <h2>Emily R. </h2>
          <h4>UX Design</h4>
          <blockquote><b>Culinary Delight!</b>
            Every dish bursts with flavor, and the staff is incredibly welcoming. An exceptional meal every time.</blockquote>
        </figcaption>
      </figure>
      <figure class="snip1390 hover"><img src="assets/asset 19.jpeg" alt="profile-sample5" class="profile" />
        <figcaption>
          <h2>Gordon Norman</h2>
          <h4>Accountant</h4>
          <blockquote><b>Perfect for Any Occasion! </b>We've celebrated many milestones here, and it never disappoints. Outstanding food and service!</blockquote>
        </figcaption>
      </figure>
      <figure class="snip1390 hover"><img src="assets/asset 21.jpeg" alt="profile-sample5" class="profile" />
        <figcaption>
          <h2>James P.</h2>
          <h4>Business Manager</h4>
          <blockquote><b>A Hidden Gem!</b> Stumbled upon The Gallery Café and it quickly became a favorite. Cozy atmosphere and delicious food!</blockquote>
        </figcaption>
      </figure>
      <figure class="snip1390"><img src="assets/asset 20.jpeg" alt="profile-sample6" class="profile" />
        <figcaption>
          <h2>Lily & David M.</h2>
          <h4>Public Relations</h4>
          <blockquote><b>Unforgettable!</b> The ambiance, service, and food were simply divine. Our new favorite spot for special occasions!</blockquote>
        </figcaption>
      </figure>
    </section>

    <!-- Footer Section -->
    <section class="foot">
     <footer class="footer">
      <div class="footer-content">
        <img src="images/logo 1.png" alt="logo">
        <p>small menu-description abou our cafe. Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>

        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.5.1/uicons-brands/css/uicons-brands.css'>
        <div class="icons">
          <h3>Follow Us on</h3>
          <a href="#"><i class="fi fi-brands-facebook"></i></a>
          <a href="#"><i class="fi fi-brands-instagram"></i></a>
          <a href="#"><i class="fi fi-brands-twitter-alt-circle"></i></a>
          <a href="#"><i class="fi fi-brands-telegram"></i></a>
          <a href="#"><i class="fi fi-brands-youtube"></i></a>
        </div>
      </div>

      <div class="footer-content">
        <h4>The Gallery Café</h4>
        <li><a href="#aboutus">About Us</a></li>
        <li><a href="#menu">Menu</a></li>
        <li><a href="#story">Story</a></li>
        <li><a href="#event">Events</a></li>
        <li><a href="#services">Our Services</a></li>
        <li><a href="reservation.php">Online Reservation</a></li>
      </div>

      <div class="footer-content">
        <h4>Help</h4>
        <li><a href="#">Privacy</a></li>
        <li><a href="#">Policy</a></li>
        <li><a href="#">Terms</a></li>
        <li><a href="#">Conditions</a></li>
        <li><a href="login-staff.php">Staff</a></li>
      </div>

      <div class="footer-content" id="contactus">
        <h4>Contact Us</h4>
        <li><i class="fi fi-sr-marker"></i>No.30, Galle Road, Colombo 04</li>
        <li><i class="fi fi-sr-envelope"></i>info@thecafegallery.lk</li>
        <li><i class="fi fi-sr-phone-call"></i>+94 77 159 1456</li>
      </div>
    </footer>
    <h5>© 2024 The Gallery Café. All Rights Reserved</h5>
  </section>

    
    <script src="script.js"></script>
</body>
</html>