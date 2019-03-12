<html>
<head>
    <title></title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

<?php
include 'dbconnect.php';

$sql = "SELECT * FROM employees";
if($result =mysqli_query($connection, $sql)){
    if(mysqli_num_rows($result) >0){
        echo "<b>VIEW ALL</b>";
        echo "<table class='table table-bordered'>";
        echo "<tr>";
        echo "<th>#</th>";
        echo "<th class='font-weight-bold'>name</th>";
        echo "<th class='font-weight-bold'>address</th>";
        echo "<th class='font-weight-bold'>salary</th>";
        echo "<th class='font-weight-bold'>action</th>";
        echo "</tr>";

        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";
            echo "<td>" . $row['salary'] . "</td>";
            echo "<td><a href='read.php?id=". $row['id']."><span class='btn btn-success' '>view</span></a></td>";
            echo "<td><a href='update.php?id=". $row['id']."><span class='btn btn-success'>update</span></a></td>";
            echo "<td><a href='delete.php?id=". $row['id']."><span class='btn btn-success'>delete</span></a></td>";
            echo "</tr>";
    }

     echo "</table>";
}else{
    echo "No records matching your query were found.";
    }
}else{
     echo "Error:Could not be executed $where." . mysqli_error($connection);
}



$order = "SELECT * FROM employees ORDER BY name";

if($get =mysqli_query($connection, $order)){
    if(mysqli_num_rows($get) >0){
        echo "<b> VIEW ALL </b>";
        echo "<table class='table table-bordered'>";
        echo "<tr>";
        echo "<th class='font-weight-bold'>id</th>";
        echo "<th class='font-weight-bold'>name</th>";
        echo "<th class='font-weight-bold'>address</th>";
        echo "<th class='font-weight-bold'>salary</th>";
        echo "<th class='font-weight-bold'>action</th>";
        echo "</tr>";

        while($row = mysqli_fetch_array($get)){
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['address'] . "</td>";;
            echo "<td>" . $row['salary'] . "</td>";
            echo "<td><a href='read.php?id=". $row['id']."><span class='btn btn-success' '>view</span></a></td>";
            echo "<td><a href='update.php?id=". $row['id']."><span class='btn btn-success'>update</span></a></td>";
            echo "<td><a href='delete.php?id=". $row['id']."><span class='btn btn-success'>delete</span></a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }else {
        echo "No records matching your query were found.";
    }
}else{
    echo "Error:Could not be executed $order." . mysqli_error($connection);
}





?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
