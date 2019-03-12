<?php
require_once "dbconnect.php";

$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";

if(isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } else {
        $f_name = $input_name;
    }

    $input_address = trim($_POST["address"]);
    if (empty($input_address)) {
        $address_err = "Please enter an address.";
    } else {
        $address = $input_address;

        $input_salary = trim($_POST["salary"]);
        if (empty($input_salary)) {
            $salary_err = "Please enter the salary.";
        } else {
            $salary = $input_salary;

        }


        if (empty($name_err) && empty($address_err) && empty($salary_err)) {

            $sql = "UPDATE employees SET name=?, address=? WHERE id=?";

            if ($stmt = mysqli_prepare($connection, $sql)) {
                mysqli_stmt_bind_param($stmt, "ssi", $param_name, $param_address, $param_salary, $param_id);};
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }

    mysqli_close($connection);
} else{
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
         $id = trim($_GET["id"]);

          $sql = "SELECT *FROM employees WHERE id = ?";
          if($stmt = mysqli_prepare($connection, $sql)) {
              mysqli_stmt_bind_param($stmt, "i", $param_id);
              $param_id = $id;


              if(mysqli_stmt_execute($stmt)){
                  $result = mysqli_stmt_get_result($stmt);

                  if(mysqli_num_rows($result) == 1){
                      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                      $name = $row["name"];
                      $address = $row["address"];
                      $salary = $row["salary"];
                  }
              } else{
                  echo "Something went wrong. Please try again later.";
              }
          }

          mysqli_stmt_close($stmt);
    }
          mysqli_close($connection);

}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<div class="page-header">
    <h2>Update record</h2>
</div>
<p>Please edit the input values and submit to update the record.</p>
<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" class="container">
    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
        <label for="name">name:</label>
        <input type="text" id="name" name="name" class="form-control" value=" <?php echo $name; ?>">
        <span class="help-block"><?php echo $name_err;?></span>
    </div>
    <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
        <label for="address">address:</label>
        <input type="text" id="address" name="address" class="form-control" value=" <?php echo $address; ?>">
        <span class="help-block"><?php echo $address_err;?></span>
    </div>
    <div class="form-group <?php echo (!empty($salary_err)) ? 'has-error' : ''; ?>">
        <label for="salary">salary:</label>
        <input type="text" id="salary" name="salary" class="form-control" value=" <?php echo $salary; ?>">
        <span class="help-block"><?php echo $salary_err;?></span>
    </div>
    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
    <input type="submit" class="btn btn-primary" value="Submit">
    <a href="index.php" class="btn btn-default">Cancel</a>
</form>


<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>