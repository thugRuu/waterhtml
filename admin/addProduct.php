<?php
session_start();
$title = "Add Product";

include("../connection.php");
include("../function.php");
is_admin_logged_in();

// Initialize messages
$success_message = $error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $itemName = $_POST['itemName'];
    $description = $_POST['Description'];
    $price = $_POST['Price'];
    $status = $_POST['Status'];

    // Check if any of the fields are empty
    if (empty($itemName) || empty($description) || empty($price) || empty($status)) {
        $error_message = "Please fill in all fields";
    } else {
        // Insert the data into the database
        $query = "INSERT INTO product (itemName, Description, Price, Status) VALUES ('$itemName', '$description', '$price', '$status')";
        
        if (mysqli_query($con, $query)) {
            $success_message = "Item added successfully!";
        } else {
            $error_message = "Error: " . $query . "<br>" . mysqli_error($con);
        }
    }

    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Styling to fade out the message */
        .fade-out {
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }

        .hidden {
            opacity: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar p-0">
                <?php include('./components/header.php'); ?>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Add New Product</h1>
                </div>

                <!-- Display success or error message -->
                <?php
                if (!empty($success_message)) {
                    echo "<div id='message' class='fade-out alert alert-success'>" . $success_message . "</div>";
                }
                if (!empty($error_message)) {
                    echo "<div id='message' class='fade-out alert alert-danger'>" . $error_message . "</div>";
                }
                ?>

                <!-- Form to add product -->
                <div class="form-container">
                    <form action="" method="POST">
                        <div class="form-group mb-3">
                            <label for="itemName">Product Name</label>
                            <input type="text" class="form-control" name="itemName" placeholder="Product Name" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Description">Description</label>
                            <input type="text" class="form-control" name="Description" placeholder="Description" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Status">Availability</label>
                            <select class="form-select" name="Status" required>
                                <option value="">Select Availability</option>
                                <option value="Available">Available</option>
                                <option value="Out of stock">Out of stock</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Price">Price</label>
                            <input type="text" class="form-control" name="Price" placeholder="Price" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Item</button>
                    </form>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7VJ5qDAdRR3wwJ23c1qFZf+Yr4cS3hfnpfN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBsdoY6RYieFMO4tE3n3z8Z5a5F1A2YeV4WZ5q5T+UYJc61L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBsdoY6RYieFMO4tE3n3z8Z5a5F1A2YeV4WZ5q5T+UYJc61L" crossorigin="anonymous"></script>

    <script>
        // JavaScript to hide the message after 2 seconds
        setTimeout(function() {
            var message = document.getElementById('message');
            if (message) {
                message.classList.add('hidden');
            }
        }, 2000); // 2000 milliseconds = 2 seconds
    </script>
</body>

</html>
