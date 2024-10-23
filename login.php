<?php
// Start the session
session_start();
$title = "Login";
// Include database connection and functions
include("./connection.php");
include("./function.php");

// Check if the form is submitted
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles/style.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Login</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        // Display error message if it exists
                        if (isset($error_message)) {
                            echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                        }

                        // Check if the form is submitted
                        if ($_SERVER['REQUEST_METHOD'] == "POST") {
                            // Retrieve form data
                            $email = $_POST['email'];
                            $password = $_POST['password'];

                            // Call the login function
                            login($email, $password);
                        }
                        ?>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input required id="email" type="email" name="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" name="password" class="form-control" placeholder="Enter your password">
                            </div>
                            <div class="mb-3 text-end">
                                <a href="change_psw.php" class="text-decoration-none">Forgot Password?</a>
                            </div>
                            <div class="d-grid">
                                <input id="button" type="submit" value="Login" class="btn btn-primary btn-block">
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="signup.php" class="text-decoration-none">Don't have an account? Signup</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
