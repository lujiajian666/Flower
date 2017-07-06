<?php
/**
 * Created by PhpStorm.
 * User: lujiajian
 * Date: 2017/6/11
 * Time: 12:51
 */

          include_once "conn.php";
          session_start();
          $orderID=$_POST["orderID"];

if($_POST[str]==1) {
    $data = $con->query("select flowerID from shoplist where orderID='$orderID'");
    $data_array = [];
    $array = [];
    while ($flower = $data->fetch_assoc()) {
        $pic = $con->query("select picturem,fname from flower where flowerID=$flower[flowerID]")->fetch_assoc();
        $array[pic] = $pic[picturem];
        $array[fname] = $pic[fname];
        $array[flowerID]=$flower[flowerID];
        array_push($data_array, $array);

    }
    echo json_encode($data_array);
}else{
    $array=$_POST["array"];
    foreach($array as $key=>$val){
        $con->query("insert into comment (flowerID,txt,username,class) values($val[flowerID],'$val[txt]','$_SESSION[email]',$val[comment])");
    }
    $con->query("update myorder set comment=1 WHERE orderID=$orderID");
    unset($key);
    unset($val);
    echo json_encode(array("status"=>1));
}