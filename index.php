<?php
// Example PHP code for database connection or other PHP logic
// (This is optional and depends on your requirements)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym_registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zenith Forge Gym</title>
    <link rel="stylesheet" href="style.css">
    <style>
    footer {
    margin-top: 10px;
    width: 100%;
    background-color: grey;
    color: white;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.footer div {
    text-align: center;
}



.footer div h3 {
    font-weight: 300;
    margin-bottom: 30px;
    letter-spacing: 1px;
}

.col-1 a {
    display: block;
    text-decoration: none;
    color: white;
}

form input {
    width: 400px;
    height: 40px;
    border-radius: 4px;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 40px;
    outline: none;
    border: none;
}

form button {
    background-color: transparent;
    border: 2px solid gray;
    color: #fff;
    width: 60%;
    border-radius: 70px;
    padding: 10px 30px;
    cursor: pointer;
    font-size: 15px;
}

footer {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    background-co
}

footer .col {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 20px;
}

footer .logo {
    margin-bottom: 30px;
}

footer h4 {
    font-size: 14px;
    padding-bottom: 20px;
}

footer p {
    font-size: 13px;
    margin: 0 0 8px 0;
}

footer a {
    font-size: 13px;
    text-decoration: none;
    color: #222;
    margin-bottom: 10px;
}

footer .follow {
    margin-top: 20px;
}

footer .icon {
    color: #465b52;
    padding-right: 4px;
    cursor: pointer;
}

footer .install .row img {
    border: 1px solid #088178;
    border-radius: 6px;
}

footer .install img {
    margin: 10px 0 15px 0;
}

footer .follow .icon img:hover {
    color: #088178;
}

footer a:hover {
    color: #088178;
}

footer .copyright {
    width: 100%;
    text-align: center;
}

.sectionfotter-p1 {
    background-color: gray;
}

.fav {
    padding-top: 10px;
}

.Customer {
    font-weight: 600px;
    font-family: 'Times New Roman', Times, serif;
}

.footer {
    margin-top: 10px;
    width: 100%;
    background-color:
    color: white;
    display: flex;
}

.footer div {
    text-align: center;
}

.col-2 {
    flex-grow: 2;
}

.footer div h3 {
    font-weight: 300;
    margin-bottom: 30px;
    letter-spacing: 1px;
}

.col-1 a {
    display: block;
    text-decoration: none;
    color: white;
}

footer {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

footer .col {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 20px;
}

footer .logo {
    margin-bottom: 30px;
}

footer h4 {
    font-size: 14px;
    padding-bottom: 20px;
}

footer p {
    font-size: 13px;
    margin: 0 0 8px 0;
}

footer a {
    font-size: 13px;
    text-decoration: none;
    color: #222;
    margin-bottom: 10px;
}

footer.follow {
    margin-top: 20px;
}

footer .icon {
    color: #465b52;
    padding-right: 4px;
    cursor: pointer;
}

footer .install .row img {
    border: 1px solid #088178;
    border-radius: 6px;
}

footer .follow .icon img:hover {
    color: #088178;
}

footer a:hover {
    color: #088178;
}

footer .copyright {
    width: 100%;
    text-align: center;
}


    </style>
</head>
<body>
   <header>
       <img src="logo.png" alt="logo" class="image" width="100px">
       <a href="#" class="logo">Zenith <span class="first">Forge</span> <span class="second">Gym</span></a>
       <!-- Menu icon -->
       <div class="container" id="icon" onclick="myFunction(this)">
           <div class="bar1"></div>
           <div class="bar2"></div>
           <div class="bar3"></div>
       </div>
       <ul class="bar">
           <li><a href="#home">Home</a></li>
           <li><a href="#review">Review</a></li>
           <li><a href="#services">Services</a></li>
           <li><a href="#about">About</a></li>
           <li><a href="#plans">Pricing</a></li>
       </ul>
       <div class="top_btn" id="register">
           <a href="register.php" class="nav_btn">Join us</a>
       </div>
    </header>

    <!-- Home section -->
    <section class="home" id="home">
        <div class="home_part">
            <h3>Sculpt Your</h3>
            <h1>Ideal Physique</h1>
            <h3><span class="one_text" style="color: cyan;">FITNESS</span></h3>
            <p>Join us today and start building the physique of your dreams because your best self is just a workout away!</p>
            <a href="register.php" class="btn">Join now</a>
        </div>
        <div class="main-img">
            <img src="download.png" alt="home image">
        </div>
    </section>

    <!-- Service section -->
    <section class="services" id="services">
        <h2 class="heading">Our <span class="heading">Services</span></h2>
        <div class="services_content">
            <div class="row">
                <img src="physical.jpg" alt="">
                <h4>Physical Fitness</h4>
            </div>
            <div class="row">
                <img src="fat.jpg" alt="">
                <h4>Fat Loss</h4>
            </div>
            <div class="row">
                <img src="WIGHT LIFTING.jpg" alt="">
                <h4>Weight Lifting</h4>
            </div>
            <div class="row">
                <img src="strength training.jpg" alt="">
                <h4>Strength Training</h4>
            </div>
            <div class="row">
                <img src="fat loss.jpg" alt="">
                <h4>Cardio</h4>
            </div>
            <div class="row">
                <img src="weight gain.jpg" alt="">
                <h4>Weight Gain</h4>
            </div>
        </div>
    </section>

    <!-- About section -->
    <section class="about" id="about">
        <div class="about_img">
            <img src="Gym-Environment-Page_1.jpg" alt="">
        </div>
        <div class="about_content">
            <h2 class="heading">Why Choose Us?</h2>
            <p>Choose us for state-of-the-art facilities, personalized training programs, and a supportive community.</p>
            <p>Our convenient location and flexible membership options make it easy to fit workouts into your busy schedule.</p>
            <p>Our experienced and certified trainers provide personalized workout plans and support, helping you stay motivated and reach your fitness milestones faster.</p>
            <a href=free_class.php class="btn">Book a Free Class</a>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="plans" id="plans">
        <h2 class="heading">Our <span class="heading">Pricing</span></h2>
        <div class="plans_content">
            <div class="box">
                <h3>Monthly</h3>
                <h2><span>Rs.3000/Month</span></h2>
                <ul>
                    <li>Weight exercises</li>
                    <li>Cardio</li>
                </ul>
            </div>
            <div class="box">
                <h3>Quarterly</h3>
                <h2><span>Rs.8000 for 3 months</span></h2>
                <ul>
                    <li>Weight exercises</li>
                    <li>Cardio</li>
                </ul>
            </div>
            <div class="box">
                <h3>Half-yearly</h3>
                <h2><span>Rs.15000 for 6 months</span></h2>
                <ul>
                    <li>Weight exercises</li>
                    <li>Cardio</li>
                </ul>
            </div>
            <div class="box">
                <h3>Yearly</h3>
                <h2><span>Rs.28000 for a year</span></h2>
                <ul>
                    <li>Weight exercises</li>
                    <li>Cardio</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Review Section -->
    <section class="review" id="review">
        <div class="review_box">
            <h2 class="heading">Client <span class="heading">Review</span></h2>
            <div class="opinion">
                <div class="review_item">
                    <img src="sompaal.jpeg" alt="">
                    <h2>Sompal Kami</h2>
                    <div class="rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                    </div>
                    <p>As a professional athlete, I've been to numerous gyms around the country, and I can confidently say that Zenith Forge Gym stands out as one of the best. The equipment here is top-of-the-line and always well-maintained. Whether I'm working on strength training, endurance, or flexibility, there's a wide variety of machines and free weights to suit all my needs.</p>
                </div>

                <div class="review_item">
                    <img src="ANISH.jpg" alt="">
                    <h2>Anish Pudasaini</h2>
                    <div class="rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9734;</span>
                    </div>
                    <p>As someone new to working out, I was a bit intimidated at first, but the welcoming atmosphere and supportive trainers made all the difference. The classes are fun and challenging, and the trainers are always available to offer guidance and encouragement.</p>
                </div>

                <div class="review_item">
                    <img src="yubin.jpg" alt="">
                    <h2>Yubin Shrestha</h2>
                    <div class="rating">
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                        <span class="star">&#9733;</span>
                    </div>
                    <p>This gym is fantastic! The equipment is always clean and well-maintained, and the variety of machines and weights means I never get bored. The locker rooms are spacious and luxurious, making it easy to freshen up before or after a workout.</p>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>
 <!-- Footer Section -->
  <div>
  <footer class="sectionfotter-p1">
        <div class="col">
            <h4>Contact</h4>
            <p><strong>Address: </strong> Dillibazar, Kathmandu, Nepal</p>
            <p><strong>Phone: +977 9860799430/ (+977) 01 534209</strong></p>
            <p><strong>Hours: </strong> 6:00am. - 10:00pm, Mon - Sat</p>
            <div class="Follow">
                <h4>Follow us</h4>
                <div class="icon">
                    <img src="facebooklogo.png" width="30px" height="30px">
                    <img src="instagram.png" width="30px" height="30px">
                    <img src="twitter.png" width="30px" height="30px">
                    <img src="linkedin.png" width="30px" height="30px">
                </div>
            </div>
        </div>
        <div class="col">
            <h4>About</h4>
            <a href="#">About Us</a>
           
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>
        
        <div class="col install">
           
            <p>Secured Payment Gateways</p>
            <img src="esewa.jpg" height="40px" width="40px">
        </div>
        <div class="copyright">
            <p>© 2024, ZENITH FORGE GYM</p>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>
