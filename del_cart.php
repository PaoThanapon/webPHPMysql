<?php
session_start();
$i=$_GET['i'];
if(isset($_SESSION["cart"])) {
    array_splice($_SESSION["cart"],$i,1) ;
}
?>
<script>
    window.alert("นำสินค้าออกเรียบร้อย");
    window.location.replace("show_product.php");
</script>