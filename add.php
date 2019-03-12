
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<form action="add.php" method="post" class="container">
    <div class="form-group">
        <label for="name">NAME:</label>
        <input type="text" id="name" name="Name" class="form-control">
    </div>
    <div class="form-group">
        <label for="address">ADDRESS:</label>
        <input type="text" id="address" name="Address" class="form-control">
    </div>
    <div class="form-group">
        <label for="salary">SALARY:</label>
        <input type="text" id="salary" name="Salary" class="form-control">
    </div>

    <div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </div>
</form>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>

<?php
include "dbconnect.php";
$Name = mysqli_real_escape_string($connection, $_POST['Name']);
$Address = mysqli_real_escape_string($connection, $_POST['Address']);
$Salary = mysqli_real_escape_string($connection, $_POST['Salary']);


$sql = "INSERT INTO employees (Name, Address, Salary) VALUES
    
('$Name', '$Address', '$Salary')";
if(mysqli_query($connection, $sql)){
    echo "Records added successfuly.";
}else{
    echo "Error: Could not able to execute $sql. " . mysqli_error($connection);
}
header("location:view.php");
mysqli_close($connection);

?>
