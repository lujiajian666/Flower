<?php
/**
 * Created by PhpStorm.
 * User: lujiajian
 * Date: 2017/5/13
 * Time: 13:31
 */
  session_start();
  error_reporting(0);
  $email=$_SESSION[email];
  $custID=$_POST[custID];
  $inputtime=time();
  $peisongday=$_POST[peisongday];
  $peisongtime=$_POST[peisongtime];
  $peisong=$_POST[peisong];
  $liuyan=$_POST[liuyan];
  $shuming=$_POST[shuming];
  $fkfs=$_POST[fkfs];
  $zip=$_POST[zip];
  $fpsname=$_POST[fpsname];
  $fpaddress=$_POST[fpaddress];


  $con=new mysqli("localhost","root","root","flower") or die();
  $con->query("SET NAMES utf8");

  
  //ljj 开启回滚操作
  mysqli_query($con,"SET AUTOCOMMIT=0");
  mysqli_query($con,"BEGIN");//开始事务定义
  
  //ljj 添加信息至myorder表
  if($res=$con->query("insert into myorder (email,custID,inputtime,peisongday,peisongtime,peisong,liuyan,shuming,fkfs,zip,fpsname,fpaddress) VALUES
      ('$email',$custID,$inputtime,'$peisongday','$peisongtime',$peisong,'$liuyan','$shuming','$fkfs','$zip','$fpsname','$fpaddress')")){
      $myorderFlag=1;

  }
  //ljj 将购买的商品列表添加到shoplist表中
  $myorderID=mysqli_insert_id($con);  //获取刚刚插入的myorder 的id
  $shoplistFlag=1;
  $all_flower=$con->query("select flowerID,num from cart where cartID=$_SESSION[cartID]");  //获取所有要插入shoplist表的flower
  foreach ($all_flower as $value){
      $aa=$con->query("insert into shoplist (orderID,flowerID,num) values($myorderID,'$value[flowerID]',$value[num])");

      if(!$aa){
          $shoplistFlag=0;
          break;
      }
  }
  //ljj shoplist 和 myorder都插入成功
  if($myorderFlag*$shoplistFlag==1){
      mysqli_query($con,"COMMIT");//执行事务//成功
      mysqli_query($con,"END");
      $con->query("delete from cart where email=$email");//根据email删除cart表记录
      echo json_encode(array("status" => 1,"to"=>"showflower.php"));
      exit();
      
  }
  
  
  
  
  