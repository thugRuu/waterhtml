<?php
session_start();
$title = "Homepage";
include("./function.php");
is_client_logged_in();

$query = "SELECT * FROM product";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <!-- Owl Carousel CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
    />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/styles/style.css">
    <style>
      .product-heading {
    font-size: 2.5rem;
    font-weight: 700;
    color: #004d40; /* Dark teal color */
    text-shadow: 2px 2px 4px rgba(0, 77, 64, 0.3); /* Soft shadow for a 3D effect */
    position: relative;
    display: inline-block;
}

.product-heading::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: -10px;
    height: 5px;
    width: 100%;
    background: linear-gradient(90deg, rgba(0, 150, 136, 0.8) 0%, rgba(0, 77, 64, 0.8) 100%);
    border-radius: 5px;
}

       body {
            font-family: 'Arial', sans-serif;
            background: #e0f7fa;
            color: #004d40;
        }
        /* Styling to fade out the message */
        .fade-out {
            opacity: 1;
            transition: opacity 1s ease-in-out; /* Duration of fade-out */
        }
        .hidden {
            opacity: 0;
        }
    </style>
</head>

<body>

    <!-- header content -->
    <!-- navbar section-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#"
          ><img
            class="nav-logo"
            src="assets/images/drnkable.svg"
            alt="logo"
            height="40px"
        /></a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#navbarOffcanvasLg"
          aria-controls="#navbarOffcanvasLg"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="offcanvas offcanvas-end"
          tabindex="-1"
          id="navbarOffcanvasLg"
          aria-labelledby="navbarOffcanvasLgLabel"
        >
          <div class="offcanvas-header justify-content-end">
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            ></button>
          </div>
          <div class="offcanvas-body">
            <ul
              class="navbar-nav justify-content-end flex-grow-1 pe-3 text-end"
            >
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Products
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Household Filters</a></li>
                  <li>
                    <a class="dropdown-item" href="#">Industrial Filters</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Services
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Purity Checks</a></li>
                  <li><a class="dropdown-item" href="#">Free Consultations</a></li>
                  <li><a class="dropdown-item" href="#">Free Servicing</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Contact
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="dropdown-item" href="#">Contact us</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">About Us</a>
                  </li>
                </ul>
                
              </li>
              <!-- <li class="btn-box mx-1">
                <a href="login.php" class="btn btn-primary">Login</a>
              </li> -->
              <li class="btn-box mx-1">
                <a href="signout.php" class="btn btn-outline-primary">Sign Out</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- navbar section-->
    <!-- hero section-->
    <section id="hero-area">
    <div class="">
        <div class="row">
            <!-- Bootstrap Carousel -->
            <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="8000">
                <img src="https://picsum.photos/id/15/1080/768" style="width:100%; height:600px ;object-fit:cover" alt="" class="img-fluid">
            </div>

            <div class="carousel-item" data-bs-interval="8000">
                <img src="https://picsum.photos/id/74/1080/768" style="width:100%; height:600px ;object-fit:cover" alt="" class="img-fluid">
            </div>

            <div class="carousel-item" data-bs-interval="8000">
                <img src="https://picsum.photos/id/41/1080/768" style="width:100%; height:600px ;object-fit:cover" alt="" class="img-fluid">
            </div>
        </div>

        <!-- Left and right controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
      </div>
    </section>
    <!-- hero section-->

    <!-- Products Section -->
    <div class="container">
      <div class="mb-3">
      <h3 class="text-center mt-5 mb-4 product-heading">Products</h3>

      </div>
      <div class="row">
      <?php
      $count = 0;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $count++;
        // Use heredoc syntax for cleaner HTML embedding within PHP
        echo <<<HTML
       <div class="col-md-6 col-lg-4 mb-4">
    <div class="card h-100 shadow-lg border-0 rounded-lg overflow-hidden hover-effect">
        <!-- Product image -->
        <img src="assets/images/{$row['itemName']}.jpg" class="card-img-top img-fluid" alt="Product Image" style="height: 200px; object-fit: cover;">

        <div class="card-body d-flex flex-column">
            <h5 class="card-title text-dark font-weight-bold mb-2">{$row['itemName']}</h5>
            <p class="card-text text-muted mb-4">{$row['Description']}</p>
            <div class="mt-auto">
                <p class="card-text mb-1">
                    <strong class="text-success">Price: \${$row['Price']}</strong>
                </p>
                <p class="card-text mb-2">
                    <small class="text-warning">Status: {$row['Status']}</small>
                </p>
            </div>
        </div>
        <div class="card-footer bg-light text-center border-0">
            <a href="buy.php?id={$row['Item_ID']}" class="btn btn-success btn-lg rounded-pill px-4">Buy Now</a>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 1rem;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-img-top {
        border-bottom: 1px solid #dee2e6;
        transition: transform 0.3s ease;
    }
    .card-body {
        padding: 1.25rem;
    }
    .card-title {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    .card-text {
        font-size: 1rem;
        margin-bottom: 1rem;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        border-radius: 50px;
        font-size: 1rem;
        padding: 0.75rem 1.5rem;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }
    .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }
    .hover-effect:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .hover-effect:hover .card-img-top {
        transform: scale(1.1);
    }
</style>


HTML;
    }
}
?>

        </div>
    </div>

    <!-- Feedback Form -->
     <?php
     $success_message = $error_message = "";

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         // Retrieve data from the form
         $name = $_POST['name'];
         $email = $_POST['email'];
         $feedback = $_POST['feedback'];
     
         // Check if any of the fields are empty
         if (empty($name) || empty($email) || empty($feedback)) {
             $error_message = "Please fill in all fields";
         } else {
             // Insert the data into the database
             $query = "INSERT INTO feedback (name, email, feedback) VALUES ('$name', '$email', '$feedback')";     
             if (mysqli_query($con, $query)) {
                 $success_message = "feedback added sucessfully";
             } else {
                 $error_message = "Error: " . $query . "<br>" . mysqli_error($con);
             }
         }
     
         $con->close();
     }
     ?>

<div id="feedback" class="container my-5">
    <div class="row mb-4">
        <div class="col text-center">
            <h3 class="font-weight-bold">Feedback Form</h3>
            <p class="text-muted">We value your feedback. Please let us know how we’re doing!</p>
        </div>
    </div>
    <?php
        // Display success or error message
        if (!empty($success_message)) {
            echo "<div id='message' class='alert alert-success fade-out' role='alert'>" . $success_message . "</div>";
        }
        if (!empty($error_message)) {
            echo "<div id='message' class='alert alert-danger fade-out' role='alert'>" . $error_message . "</div>";
        }
    ?>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="name" class="form-label font-weight-semibold">Full Name:</label>
            <input type="text" id="name" name="name" class="form-control form-control-lg" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label font-weight-semibold">Email:</label>
            <input type="email" id="email" name="email" class="form-control form-control-lg" required>
        </div>
        <div class="mb-3">
            <label for="feedback" class="form-label font-weight-semibold">Feedback:</label>
            <textarea id="feedback" name="feedback" rows="4" class="form-control form-control-lg" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Submit Feedback</button>
    </form>
</div>

<style>
    #feedback {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .alert {
        margin-bottom: 20px;
        border-radius: 5px;
        padding: 15px;
        transition: opacity 0.5s ease;
    }
    .alert-success {
        background-color: #d4edda;
        color: #155724;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
    }
    .fade-out {
        opacity: 0;
    }
    .font-weight-semibold {
        font-weight: 600;
    }
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 50px;
        padding: 12px 30px;
        font-size: 16px;
    }
    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
</style>


    <!-- Footer Section -->
    <section id="footer-area" class="bg-dark text-light py-5">
    <div class="container">
        <hr class="my-4 border-light">
        <div class="row mb-4">
            <!-- Footer Logo Section -->
            <div class="col-lg-3 col-sm-12 d-flex flex-column align-items-center justify-content-center mb-4 mb-lg-0">
                <div class="footer-logo mb-3">
                    <img class="footer-logo" src="assets/images/drnkable.svg" alt="logo" height="40px">
                </div>
                <div class="logo-text text-center">
                    <p class="text-light">
                        We believe in our clients' satisfaction through rendering quality services on time with efficiency.
                    </p>
                </div>
            </div>

            <!-- Links Section -->
            <div class="col-lg-3 col-sm-12 mb-4 mb-lg-0">
                <h5 class="footer-title text-primary mb-3">Quick Links</h5>
                <ul class="footer-links list-unstyled">
                    <li><a href="about.html" class="d-flex align-items-center text-light text-decoration-none mb-2"><i class="bi bi-arrow-right-circle me-2"></i> About Us</a></li>
                    <li><a href="services.html" class="d-flex align-items-center text-light text-decoration-none mb-2"><i class="bi bi-arrow-right-circle me-2"></i> Services</a></li>
                    <li><a href="projects.html" class="d-flex align-items-center text-light text-decoration-none mb-2"><i class="bi bi-arrow-right-circle me-2"></i> Projects</a></li>
                    <li><a href="gallery.html" class="d-flex align-items-center text-light text-decoration-none mb-2"><i class="bi bi-arrow-right-circle me-2"></i> Gallery</a></li>
                    <li><a href="contact.html" class="d-flex align-items-center text-light text-decoration-none mb-2"><i class="bi bi-arrow-right-circle me-2"></i> Contact</a></li>
                </ul>
            </div>

            <!-- Social Links Section -->
            <div class="col-lg-3 col-sm-12 mb-4 mb-lg-0">
                <h5 class="footer-title text-primary mb-3">Social Links</h5>
                <ul class="footer-links list-unstyled">
                    <li><a href="https://www.facebook.com" class="d-flex align-items-center text-light text-decoration-none mb-2"><i class="bi bi-facebook me-2 footer-icons"></i> Facebook</a></li>
                    <li><a href="https://www.twitter.com" class="d-flex align-items-center text-light text-decoration-none mb-2"><i class="bi bi-twitter me-2 footer-icons"></i> Twitter</a></li>
                    <li><a href="https://www.linkedin.com" class="d-flex align-items-center text-light text-decoration-none mb-2"><i class="bi bi-linkedin me-2 footer-icons"></i> LinkedIn</a></li>
                    <li><a href="https://www.instagram.com" class="d-flex align-items-center text-light text-decoration-none mb-2"><i class="bi bi-instagram me-2 footer-icons"></i> Instagram</a></li>
                </ul>
            </div>

            <!-- Footer Contacts Section -->
            <div class="col-lg-3 col-sm-12 mb-4 mb-lg-0">
                <h5 class="footer-title text-primary mb-3">Contact Us</h5>
                <ul class="footer-links list-unstyled">
                    <li><a href="#" class="d-flex align-items-center text-light text-decoration-none mb-2"><i class="bi bi-geo-alt-fill me-2 footer-icons"></i> Selangor, Malaysia</a></li>
                    <li><a href="mailto:info@drnkable.com" class="d-flex align-items-center text-light text-decoration-none mb-2"><i class="bi bi-envelope-fill me-2 footer-icons"></i> info@drnkable.com</a></li>
                    <li><a href="tel:+977014010574" class="d-flex align-items-center text-light text-decoration-none mb-2"><i class="bi bi-telephone-fill me-2 footer-icons"></i> +977 01-4010574</a></li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom Section -->
        <div class="row">
            <div class="col-12 text-center text-light">
                <p class="mb-0">
                    &copy; 2024 DRNKABLE INC. All rights reserved. Designed by 
                    <a href="#" class="text-decoration-none text-light fw-bold">DRNKABLE INC.</a>
                </p>
            </div>
        </div>
    </div>
</section>

<style>
    #footer-area {
        background-color: #343a40;
        color: #f8f9fa;
    }
    #footerTop .footer-title {
        font-size: 1.25rem;
        font-weight: bold;
    }
    #footerTop .footer-links a {
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }
    #footerTop .footer-links a:hover {
        color: #17a2b8;
    }
    .footer-icons {
        font-size: 1.2rem;
        color: #17a2b8;
    }
    .footer-icons:hover {
        color: #0d6efd;
    }
    .text-light {
        color: #f8f9fa !important;
    }
    .text-primary {
        color: #0d6efd !important;
    }
    .footer-logo img {
        transition: transform 0.3s ease;
    }
    .footer-logo img:hover {
        transform: scale(1.1);
    }
    #footerBottom {
        border-top: 1px solid #495057;
        padding-top: 1rem;
    }
</style>




    <!--------------SCRIPTS---------------->

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>

    <!-- Owl Carousel JQuery -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    ></script>

    <!-- Owl Carousel JS -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    ></script>
    
    <script>
        // const carouselElement = document.querySelector('#homeCarousel');
        // const carousel = new bootstrap.Carousel(carouselElement, {
        //     interval: 2000, // Adjust the interval as needed
        //     wrap: true // Enable continuous loop of slides
        // });

        $(document).ready(function(){
            $(".owl-carousel").owlCarousel();
        });

        //
        // Hero carousel
        //
      var heroCarousel = $(".hero-area").owlCarousel({
        loop: true,
        margin: 10,
        autoplay: false,
        autoplayTimeout: 5000,
        responsive: {
          0: {
            items: 1,
          },
          400: {
            items: 1,
            margin: 20,
          },
          500: {
            items: 1,
            margin: 20,
          },
          768: {
            items: 1,
            margin: 20,
          },
          991: {
            items: 1,
            margin: 20,
          },
          1000: {
            items: 1,
            margin: 20,
          },
        },
      });

      // copy logos slide
      var copy = document.querySelector(".logos-slide").cloneNode(true);
      document.querySelector(".logos").appendChild(copy);
    </script>
</body>
<script>
// JavaScript to hide the message after 2 seconds
setTimeout(function() {
    var message = document.getElementById('message');
    if (message) {
        message.classList.add('hidden');
    }
}, 1000);
document.getElementById('feedbackForm').addEventListener('submit', function(event) {
  event.preventDefault()}) // 2000 milliseconds = 2 seconds
</script>
</html>
