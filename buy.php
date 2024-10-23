<?php
session_start(); // Start the session
include("connection.php"); // Assuming connection.php handles database connection
include("./function.php");
is_client_logged_in(); // Ensure the user is logged in

// Initialize variables
$item = null;
$error_message = null;
$success_message = null;

// Fetch item details
if (isset($_GET['id'])) {
    $itemID = intval($_GET['id']); // Convert to integer for safety
    
    // Use prepared statements to avoid SQL injection
    $stmt = $con->prepare("SELECT * FROM product WHERE Item_ID = ?");
    $stmt->bind_param("i", $itemID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            $item = $result->fetch_assoc();
        } else {
            $error_message = "Item not found!";
        }
    } else {
        $error_message = "Error: " . $con->error;
    }
    
    $stmt->close();
} else {
    $error_message = "Invalid item ID!";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['user_id'])) {
        if (isset($_POST['itemName'])) {
            $itemName = $con->real_escape_string($_POST['itemName']);
            $currentDate = date("Y-m-d");
            $userID = $con->real_escape_string($_SESSION['user_id']);

            // Use prepared statement for security
            $stmt = $con->prepare("INSERT INTO orders (orderedItem, orderedDate, orderedBy) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $itemName, $currentDate, $userID);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Order placed successfully!";
                $_SESSION['message_type'] = "success";
            } else {
                $_SESSION['message'] = "Error: " . $con->error;
                $_SESSION['message_type'] = "error";
            }

            $stmt->close();
            header("Location: /index.php");
            exit();
        } else {
            $_SESSION['message'] = "Item name is missing!";
            $_SESSION['message_type'] = "error";
            header("Location: /index.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "User not logged in.";
        $_SESSION['message_type'] = "error";
        exit();
    }
}

$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/styles/style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            margin: 0;
            padding: 0;
        }
      
        h2 {
            font-size: 2rem;
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .item-section {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 20px;
        }
        .item-details {
            flex: 1;
            max-width: 50%;
        }
        .item-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .item-content {
            flex: 1;
            max-width: 50%;
        }
        h3 {
            font-size: 1.5rem;
            color: #00796b;
            margin-bottom: 10px;
        }
        p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 20px;
        }
        span {
            font-size: 1.2rem;
            font-weight: bold;
            color: #00796b;
            display: block;
            margin-bottom: 20px;
        }
        button {
            background-color: #00796b;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #004d40;
        }
        .message {
            font-size: 1rem;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .success {
            background-color: #e8f5e9;
            color: #388e3c;
        }
        .error {
            background-color: #fbe9e7;
            color: #d32f2f;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
      <div class="">
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
    <div class="container">
        <h2>Buy Item</h2>
        <?php if ($error_message): ?>
            <div class="message error"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <?php if ($item): ?>
            <div class="item-section">
                <div class="item-content">
                    <h3><?php echo htmlspecialchars($item['itemName']); ?></h3>
                    <p><?php echo htmlspecialchars($item['Description']); ?></p>
                    <span>$<?php echo htmlspecialchars(number_format($item['Price'], 2)); ?></span>
                    <form method="POST" action="">
                        <input type="hidden" name="itemName" value="<?php echo htmlspecialchars($item['itemName']); ?>">
                        <input type="hidden" name="price" value="<?php echo htmlspecialchars($item['Price']); ?>">
                        <button type="submit">Pay</button>
                    </form>
                </div>
                <div class="item-image">
                    <img src="assets/images/<?php echo htmlspecialchars($item['itemName']); ?>.jpg" alt="<?php echo htmlspecialchars($item['itemName']); ?>" class="item-image">
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

