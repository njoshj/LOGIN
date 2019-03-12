<DOCTYPE! html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right:15px;

        }
    </style>
    <script src="js/jquery.js">
        $(document).ready(function () {
            $('[data-toggle="tooltip"]') . tooltip();
        });
    </script>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="-pull-left">Employees Details</h2>
                    <a href="add.php" class="btn btn-success -pull-right">Add New Employee</a>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
<?php











?>