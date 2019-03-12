<?php
$server='localhost';
$user='root';
$password='';
$database='hospital';

$connection=new mysqli($server,$user,$password,$database);
if ($connection->connect_error){
    die("No connection".$connection->connect_error);
}
?>