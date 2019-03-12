<?php
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    include "dbconnect.php";
    $sql = "SELECT *FROM employees WHERE id=?";


    if ($stmt = mysqli_prepare($connection, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_id);


        $param_id = trim($_GET["id"]);
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) ==1){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];
            }
        }else{
            echo "Oops! ";
        }
    }
    mysqli_stmt_close($stmt);

    mysqli_close($connection);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<h1>view record</h1>
<form action="read.php" method="get" class="container">
    <div class="form-group">
        <label>name:</label>
        <p class="form-control-static"><?php echo $row["name"];?></p>
    </div>
    <div class="form-group">
        <label>address:</label>
        <p class="form-control-static"><?php echo $row["address"];?></p>
    </div>
    <div class="form-group">
        <label>salary:</label>
        <p class="form-control-static"><?php echo $row["salary"];?></p>
    </div>

    <div>
        <button class="btn btn-primary" type="submit">Submit</button>
        <button class="btn btn-primary" type="reset">cancel</button>
    </div>
</form>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
