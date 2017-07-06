<?php
session_start();
$con=new mysqli("localhost","root","root","flower") or die();
$con->query("SET NAMES utf8");
 $str=$_POST["query"];

 if($str=="clear") {
     $str = "delete from cart where(email='$_SESSION[email]')";
     $finish = json_encode(array("status" => 1, "to" => "showflower.php"));
 }
 else if($str=="submit") {
     $str = "delete from cart where(email='$_SESSION[email]')";
     $finish = json_encode(array("status" => 1, "to" => "showflower.php"));
 }
 else if($str=="update"){
     $num=$_POST["num"];
     $flowerID=$_POST["flowerID"];
     $str="update cart set num=$num WHERE(flowerID=$flowerID and cartID='$_SESSION[cartID]')";
     $finish = json_encode(array("status" => 1,"to"=>"shopcar.php"));
 }
 else if($str=="delete"){
     $flowerID=$_POST["flowerID"];
     $str="delete from cart  WHERE(flowerID=$flowerID and cartID='$_SESSION[cartID]')";
     $finish = json_encode(array("status" => 1,"to"=>"shopcar.php"));
 }
 else if($str=="add"){
    $name=$_POST["name"];
    $phone=$_POST["phone"];
    $zip=$_POST["zip"];
    $dAddress=$_POST["dAddress"];
    $sex=$_POST["sex"];

    $str="insert into customer (email,sname,sex,mobile,address,zip,cdefault) VALUES ('$_SESSION[email]','$name','$sex','$phone','$dAddress','$zip','0')";
    $finish = json_encode(array("status" => 1,"to"=>"order.php"));
 }
 else if($str=="delAddress"){
     $custerID=$_POST["custerID"];
     $str="delete from customer WHERE custID=$custerID";
     $finish = json_encode(array("status" => 1,"to"=>"order.php"));
 }
 else if($str=="setDefault"){
     mysqli_query($con,"SET AUTOCOMMIT=0");
     mysqli_query($con,"BEGIN");//开始事务定义
     $sql = "update customer set cdefault=0 WHERE email='$_SESSION[email]'";
     $query = mysqli_query($con,$sql);

     $sqlb = "update customer set cdefault=1 WHERE custID=$_POST[custerID]";
     $queryb = mysqli_query($con,$sqlb);

     if(!$query  ||   !$queryb){//至少有一个不成功
         mysqli_query($con,"ROLLBACK");//判断执行失败回滚
     }
     mysqli_query($con,"COMMIT");//执行事务//成功
     mysqli_query($con,"END");
     echo json_encode(array("status" => 1,"to"=>"order.php"));
     exit();
 }
 $res=mysqli_query($con, $str);
 if($res)
    echo $finish;
?>
