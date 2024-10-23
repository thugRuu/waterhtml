<?php
session_start();
$title = "viewReviews";
include("../function.php");
is_admin_logged_in()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<div class="container-fluid">
            <div class="row">
            
                <nav class="col-md-3 col-lg-2 d-md-block sidebar p-0">               
                            <?php
                            include('./components/header.php');
?>
                   
                    
            
                </nav>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Welcome, Admin</h1>
                </div>

                <!-- <p>This is your admin dashboard. Use the sidebar to navigate through the available options.</p> -->
                <div class="product-list w-100 p-5">
    
    <table class="table tabled-bordered">
        <h2>Products List</h2>
        <thead>
            <tr>
                <th style="width:15%"> Name</th>
                <th style="width:15%">Email</th>
                <th style="width:40%">Detail</th>
                <th style="width:15%">created at</th>
              
                <!-- <th style="width:5%">Added Date</th> -->
                <th style="width:25%">Action</th>
            </tr>
        </thead>
        <tbody>
    <?php
        $query = "SELECT * FROM feedback";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result)>0){
            while ($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                        <!-- <td type="hidden"> <?php echo $data["productId"] ?></td> -->
                        <td> <?php echo  $row['name'] ?></td>
                        <td> <?php echo  $row['email'] ?></td>
                        <td> <?php echo  $row['feedback'] ?></td>
                        <td> <?php echo $row['created_at'] ?></td>
                        <td>
                        <a class="btn btn-info" href="view.php?id=<?php echo $data["Item_ID"] ?>">View</a>
                            <a class="btn btn-warning" href="edit.php?id=<?php echo $data["Item_ID"] ?>">Edit</a>
                            <a class="btn btn-danger" href="delete.php?id=<?php echo $data["Item_ID"] ?>">Delete</a>
                            </td>
                    </tr>   
                 
                <?php       
            }
        }

    ?>
  </tbody>
    </table>
</div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7VJ5qDAdRR3wwJ23c1qFZf+Yr4cS3hfnpfN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBsdoY6RYieFMO4tE3n3z8Z5a5F1A2YeV4WZ5q5T+UYJc61L" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBsdoY6RYieFMO4tE3n3z8Z5a5F1A2YeV4WZ5q5T+UYJc61L" crossorigin="anonymous"></script>
  
</body>
</html>
