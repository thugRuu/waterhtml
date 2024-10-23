<?php
session_start();

include("./connection.php");
include("./function.php");

$error_message = "";

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $user_name = $_POST['user_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the form fields
    if(empty($user_name) || empty($phone_number) || empty($email) || empty($password)) {
        $error_message = "Please fill in all fields";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address";
    } elseif (strlen($phone_number) !== 10) {
        $error_message = "Phone number should be exactly 10 digits";
    } elseif (strlen($password) < 8) {
        $error_message = "Password should be at least 8 characters long";
    } else {
        // Check if the email already exists
        $existing_user_query = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($con, $existing_user_query);
        
        if(mysqli_num_rows($result) > 0) {
            $error_message = "This email is already registered";
        } else {
            // If no error, insert the new user
            $query = "INSERT INTO user (user_name, password, phone_number, email, role) 
                      VALUES ('$user_name', '$password', '$phone_number', '$email', '0')";

            if(mysqli_query($con, $query)){
                header("Location: login.php");
                die;
            } else {
                $error_message = "Error: " . mysqli_error($con);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Sign Up</h3>
                        <?php
                        // Display error message if any
                        if (!empty($error_message)) {
                            echo "<div class='alert alert-danger'>$error_message</div>";
                        }
                        ?>
                        <form method="post">
                            <div class="mb-3">
                                <label for="user_name" class="form-label">Username</label>
                                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter your username" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Enter your phone number" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Sign Up</button>
                            </div>
                            <div class="mt-3 text-center">
                                <a href="login.php" class="text-decoration-none">Already have an account? Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq6nLNHFQKtbzAoMcfZ5g5RyJh7qlINjy1kNokl5Vo+pI9pkaV" crossorigin="anonymous"></script>
</body>

</html>
