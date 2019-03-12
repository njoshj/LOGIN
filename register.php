<?php
include 'dbconnect.php';

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else {

        $sql = "SELECT id FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($connection, $sql)) {

            mysqli_stmt_bind_param($stmt, "s", $param_username);

            $param_username = trim($_POST["username"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }


        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have at least 6 characters.";
        } else{
            $password = trim($_POST["password"]);
        }

        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";
        } else{
            $confirm_password = trim($_POST["confirm_password"]);

            if(empty($password_err) && ($password !=$confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }

        if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){


            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            if($stmt = mysqli_prepare($connection, $sql)){
                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT);

                if(mysqli_stmt_execute($stmt)){

                    header("location: login.php");
                } else{
                    echo "Something went wrong. Please try again later.";
                }
            }
            mysqli_stmt_close($stmt);
        }
        mysqli_close($connection);

    }
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
    <h2>Sign Up</h2>
</div>
<p>Please fill this form to create an account.</p>
<form action="<?php echo htmlspecialchars(($_SERVER["PHP_SELF"])); ?>" method="post" class="container">
    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label for="name">Username:</label>
        <input type="text" id="name" name="username" class="form-control" value=" <?php echo $username; ?>">
        <span class="help-block"><?php echo $username_err;?></span>
    </div>
    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" class="form-control" value=" <?php echo $password; ?>">
        <span class="help-block"><?php echo $password_err;?></span>
    </div>
    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
        <label>Confirm password:</label>
        <input type="password" name="confirm_password" class="form-control" value=" <?php echo $confirm_password; ?>">
        <span class="help-block"><?php echo $confirm_password_err;?></span>
    </div>
    <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Submit">
        <input type="reset" class="btn btn-default" value="Reset">
    </div>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</form>


<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
