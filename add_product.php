<?php
session_start();
$id=$_GET['id'];
$servername="localhost";
$username="root";
$password="12345678";
$dbname="shop1";
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con) die("Connnect mysql database fail!!".mysqli_connect_error());
//echo "Connect mysql successfully!";
$sql="SELECT * FROM product WHERE id=$id";
$result=mysqli_query($con,$sql);

if(mysqli_num_rows($result)>0){
    $row=mysqli_fetch_assoc($result);
    echo $row['id']."<br>";
    echo $row['name']."<br>";
    echo $row['description']."<br>";
    echo $row['price']."<br>";

    if(!isset($_SESSION["cart"]))
        $_SESSION["cart"]=array();
    $item=array("id"=>$row['id'],
                "name"=>$row['name'],
                "description"=>$row['description'],
                "price"=>$row["price"]);
    array_push($_SESSION["cart"],$item);
    print_r($_SESSION["cart"]);
}

mysqli_close($con);
?>
<script>
    window.alert("นำสินค้าใส่ตะกร้าเรียบร้อย");
    window.location.replace("show_product.php");
</script>