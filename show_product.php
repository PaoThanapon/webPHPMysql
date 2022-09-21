<?php
session_start();
$servername="localhost";
$username="root";
$password="12345678";
$dbname="shop1";
$per_page=10;
if(isset($_GET["page"])) $start_page=$_GET["page"]*$per_page;
else $start_page=0;
$con=mysqli_connect($servername,$username,$password,$dbname);
if(!$con) die("Connnect mysql database fail!!".mysqli_connect_error());
echo "Connect mysql successfully!";
$sql="SELECT * FROM product";
$result=mysqli_query($con,$sql);
$numrow=mysqli_num_rows($result);
echo "<br>".$numrow." Records<br>";
for($i=0;$i<ceil($numrow/$per_page);$i++)
    echo "<a href='show_product.php?page=$i'>[".($i+1)."]</a>";

    /*if(isset($_GET["page"])){
        $previous = $_GET["page"]-1;
        if($previous<0){
            $previous=0;
        }
        $next = $_GET["page"]+1;
        if($next>=$totalpage){
            $totalpage = $next + $totalpage;
        }
    }else{
        $previous=0;
        $_GET["page"]=0;
    }*/
    if(isset($_GET["page"])){
        $previous = $_GET["page"]-1;
        $next = $_GET["page"]+1;
        if($previous<0){
            $previous = 0;
        }
        if($next >= 4){
            $next =  4 ;
        }
    }
    else{
        $previous=0;
        $_GET["page"]=0;
    }
    
echo "<a href='show_product.php?page=$previous'>[<-- previous]</a>";
echo "<a href='show_product.php?page=$next'>[next-->]</a>";



$sql="SELECT * FROM product LIMIT $start_page,$per_page";
$result=mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
    
    echo "<table border=1><tr><th>id</th><th>name</th><th>description</th><th>price</th><th></th></tr>";
    while($row=mysqli_fetch_assoc($result)){
        $url_id=$row["image"];
    
    echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>"."<img src='$url_id' style='width:150px;height:150px;'><br>";
    echo $row["description"]."</td><td>".$row["price"]."</td>";
    echo "<td><a href='add_product.php?id=".$row["id"]."'>ใส่ตระกร้า</td></tr>";
    }
    echo "</table>";
}else{
    echo "0 results";
}

if(isset($_SESSION["cart"])){
$total=0;
echo "<h1>ตระกร้าสินค้า</h1>";
echo "<table><tr><th>ลำดับ</th><th>id</th><th>name</th><th>description</th><th>price</th></tr>";
    for($i=0;$i<count($_SESSION["cart"]);$i++)
    {
        $item=$_SESSION["cart"][$i];
        echo "<tr><td>".($i+1)."</td>";
        echo "<td>".$item['id']."</td>";
        echo "<td>".$item['name']."</td>";
        echo "<td>".$item['description']."</td>";
        echo "<td>".$item['price']."</td></tr>";
        echo "<td><a href='del_cart.php?i=".$i."'>" ; 
        echo "<font coolor - 'red'>x</font></a></td></tr>";
        $total+=$item['price'];
    }
echo "</table>";
echo "<h1>ราคาสินค้า $total บาท</h1>";
echo "<h2><a href='checkout.php'>สั่งซื้อ</a></h2>";
}
mysqli_close($con);
?>