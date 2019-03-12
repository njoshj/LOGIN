<?php

if(isset($_SESSION["loggedin"])&&$_SESSION["logged in"]===true){
    exit;
}
    include 'dbconnect.php';

$username = $password ="";
$username_err = $password_err ="";

if ($_SERVER["REQUEST_METHOD"]=="POST"){

    if (empty(trim($_POST["username"]))){
        $username_err ="PLease enter name";
    }else{
        $username = trim($_POST["username"]);
    }
    if (empty(trim($_POST["password"]))){
        $password_err ="PLease enter password";
    }else{
        $password = trim($_POST["password"]);
    }
if (empty($username_err)&& empty($password_err)){
    $sql = "SELECT id,username,password FROM users WHERE username =?";

    if ($stmt = mysqli_prepare($connection,$sql)){
        mysqli_stmt_bind_param($stmt,"s",$param_username);

        $param_username =$username;
        //attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)){
            //store results

            mysqli_stmt_store_result($stmt);
            //check if username exists,if yes then verify password

            if (mysqli_stmt_num_rows($stmt)== 1){
                //bind result variable

                mysqli_stmt_bind_result($stmt,$id,$username,$hashed_password);
                if (mysqli_stmt_fetch($stmt)){
                    if (password_verify($password,$hashed_password)){
                        //password is correct, so start a new session
                        session_start();
                        //store data in session variable
                        $_SESSION["loggedin"] =true;
                        $_SESSION["id"];
                        $_SESSION["username"] =$username;

                        //redirect user to welcome page
                        header("location:index.php");
                    }else {
                        //display an error message if password is not valid
                        $password_err ="The password you entered was not valid.";
                    }
                }
            }else{
                //display an error message if username doesnt exist
                $username_err ="No account found with that name";
            }
        }else{
            echo "Oops! something went wrong. Please try again later.";
        }
    }
    //close statement
    mysqli_stmt_close($stmt);
}
//close statement
    mysqli_close($connection);
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>log in</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style type="text/css">
        body{font:14px sans-serif;}
        .wrapper{width:350px; padding:20px;}

    </style>

</head>
<body>
<div class="wrapper">
    <h2>Log in</h2>
    <p>Please fill in your credentials to log in.</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"method="post">
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
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>Dont have an account? <a href="register.php">Sign up</a>.</p>
    </form>
</div>
</body>
</html>