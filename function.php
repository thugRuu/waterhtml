<?php
// Start session
// Function to check login status and role
include("connection.php");
function set_session($user_id, $role) {
    // Start session if not already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Set session variables
    $_SESSION['user_id'] = $user_id;
    $_SESSION['role'] = $role;
}
function check_login($con) {
    // Check if user is logged in
    if(isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
        $user_id = $_SESSION['user_id'];
        $role = $_SESSION['role'];

        // Validate user session in the database
        $query = "SELECT * FROM user WHERE user_id = '$user_id' AND role = '$role'";
        $result = mysqli_query($con, $query);

        if($result && mysqli_num_rows($result) == 1) {
            // User session is valid
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    // Redirect to specified URL if user is not logged in or session is invalid
    header("Location: ./login.php");
    exit;
}

// Function to set session cookie for login

// Example usage:
// Connect to database (Replace with your database connection details)

// Check if user is logged in as admin

function is_admin_logged_in() {
    // global $con;
    // return check_login($con);
    $role = $_SESSION['role'];
    if(!$role==1){
        header("Location: notfound.php");
    }
    
  }
// Check if user is logged in as client
function is_client_logged_in() {
    // global $con;
    // return check_login($con);
    $role = $_SESSION['role'];
    if(!$role==0){
        header("Location: ./notfound.php");
    }
}

// Example login process
function login($email, $password) {
    global $con;
    // Validate user credentials
    $query = "SELECT * FROM user WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($con, $query);

    if($result && mysqli_num_rows($result) == 1) {
        // User authentication successful, set session cookie
        $user_data = mysqli_fetch_assoc($result);
        set_session($user_data['user_id'], $user_data['role']);

        // Redirect user to appropriate page after login
        if($user_data['role'] == '1') {
            header("Location: admin/index.php");
            exit;
        } else {
            header("Location: index.php");
            exit;
        }
    } else {
        // Authentication failed, handle error (e.g., display error message)
        echo "Invalid email or password";
    }
}

function getAllFrom($select, $table, $where = NULL, $order = NULL, $orderBy = NULL) {
    global $con;
    $sql = "SELECT $select FROM $table";
    if ($where !== NULL) {
        $sql .= " WHERE $where";
    }
    if ($orderBy !== NULL) {
        $sql .= " ORDER BY $orderBy"; // Only add ORDER BY clause if $orderBy is provided
    }
    // Prepare and execute the SQL query
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}


// Example logout process
function logout() {
    // Destroy session and redirect to login page
    session_destroy();
    header("Location: login.php");
    exit;
}

// Close database connection (optional)
// mysqli_close($con);


function random_num($length)
{
    $text = "";
    if ($length < 5)
    {
        $length = 5;
    }

    $len = rand(4, $length);

    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }
    return $text;
}
?>
