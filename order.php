<?php
session_start() ; 
echo $_POST["fname"];
echo $_POST["lname"];
echo $_POST["address"];
echo $_POST["mobile"];
$servername="localhost";
$username="root";
$password="12345678";
$dbname="shop1";
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con) die("Connnect mysql database fail!!".mysqli_connect_error());
echo "Connect mysql successfully!";
$sql="INSERT INTO order_product (fname, lname,address,mobile)";
$sql="VALUES ('$fname','$lname','$address','$mobile')";
$result=mysqli_query($con,$sql);
$numrow=mysqli_num_rows($result);
?>