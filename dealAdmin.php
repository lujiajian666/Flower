<?php
/**
 * Created by PhpStorm.
 * User: lujiajian
 * Date: 2017/6/6
 * Time: 21:17
 */
include "conn.php";
$str=$_POST["str"];
session_start();
if($str=="logout") {
    session_unset();
    session_destroy();
    echo json_encode(array("status"=>1));
    exit();
}
else if($str=="xiugai"){
    if($con->query("update myorder set ddzt=$_POST[value] where orderID='$_POST[id]'")){
        echo json_encode(array("txt"=>"修改成功！"));
        $con->query("insert into tbddzt (orderID,ddzt,cltime) VALUES($_POST[id],$_POST[value],time())");
        exit();
    }
    else {
        echo json_encode(array("txt" => "修改失败！"));
        exit();
    }
}
else if($str=="delete"){
    $flowerID=$_POST["flowerID"];
    if($con->query("delete from flower where flowerID=$flowerID"))
        echo json_encode(array("status"=>1));
    exit();
}
else if($str=="edit"){

    if($_FILES){
        $fileName=$_FILES["img"]["name"];
        move_uploaded_file($_FILES["img"]["tmp_name"], "flowerpicture/" . $fileName);
        $sql="update flower set fname='$_POST[fname]',picturem='$fileName' WHERE flowerID=$_POST[flowerID]";
    }else{
        $sql="update flower set fname='$_POST[fname]' WHERE flowerID=$_POST[flowerID]";
    }

    if($con->query($sql)){
        echo  json_encode(array("status"=>1));
    }
    exit();


}
else if($str=="add"){

        $fileName=$_FILES["img"]["name"];
        move_uploaded_file($_FILES["img"]["tmp_name"], "flowerpicture/" . $fileName);
        $t=time();

        if($con->query("insert into flower (flowerID,fname,picturem) VALUES($t ,'$_POST[fname]','$fileName')")){
             echo  json_encode(array("status"=>1));
         }else{
            echo  $con->error;
        }
    exit();
}