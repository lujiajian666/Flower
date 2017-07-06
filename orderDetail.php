<!--/*-->
<!-- * Created by PhpStorm.-->
<!-- * User: lujiajian-->
<!-- * Date: 2017/5/31-->
<!-- * Time: 10:46-->
<!-- */-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        table{
            width: 100%;
        }
        tbody{
            width: 100%;
        }
        img{
            height: 100px;
            width: 100px;
        }
        .title{
            text-align: center;
            background-color: #9e9e9e;
            padding: 10px;
        }
        .center{
            text-align: center;
        }
        .quarter>td,.quarter>th{
            width: 25%;
        }
        .hr{
            padding-bottom: 10px;
            border-bottom: 1px black solid;
        }
    </style>
</head>
<body>
     <?php
         include "conn.php";
         include "top.php";
         $orderID=$_GET[orderID];
         $data=$con->query("select * from myorder where orderID=$orderID")->fetch_assoc();
         $people=$con->query("select * from member where email='$data[email]'")->fetch_assoc();
         $customer=$con->query("select * from customer where custID=$data[custID]")->fetch_assoc();

     ?>
     <table>
         <tr><td class="title">订单处理信息</td></tr>
         <tr><td>订单编号：<span style="color: red"><?php echo $data[orderID] ?></span></td></tr>
         <tr><td>订单状态：未付款 取消 付款</td></tr>
         <tr><td class="title">订单基本信息</td></tr>
         <tr><td><span style="color: red">订单人信息</span></td></tr>
         <tr><td>姓名：<?php echo $people[mname] ?></td></tr>
         <tr><td>地址：<?php echo $people[address] ?></td></tr>
         <tr><td>手机：<?php echo $people[mobile] ?></td></tr>
         <tr><td class="hr">邮箱：<?php echo $data[email] ?></td></tr>
         <tr><td><span style="color: red">收货人信息</span></td></tr>
         <tr><td>姓名：<?php echo $customer[sname] ?></td></tr>
         <tr><td>地址：<?php echo $customer[address] ?></td></tr>
         <tr><td>手机：<?php echo $customer[mobile] ?></td></tr>
         <tr><td class="hr">邮编：<?php echo $customer[zip] ?></td></tr>
         <tr><td><span style="color: red">其他信息</span></td></tr>
         <tr><td>配送日期：<?php echo $data[peosongday] ?> 时段：<?php echo $data[peosongtime] ?></td></tr>
         <tr><td>订购时间：<?php echo date("Y-m-d h:i:s",$data[inputtime])?></td></tr>
         <tr><td>付款方式：<?php echo $data[fkfs] ?></td></tr>
         <tr><td>配送区域：<?php echo $data[fpadaddress] ?></td></tr>
         <tr><td class="hr">留言：<?php echo $data[liuyan] ?></td></tr>
         <tr><td class="title">商品信息</td></tr>
         <tr>
             <td class="center">
                 <table>
                     <tr class="quarter">
                         <th>商品名称</th>
                         <th>价格</th>
                         <th>数量</th>
                         <th>小计</th>
                     </tr>
                 </table>
             </td>

         </tr>
         <tr>
             <td class="center">
                 <table>
                     <?php
                     $str="select * from myorder where orderID='$orderID'";
                     $data=$con->query($str);
                     $all=0;
                     while($row=$data->fetch_assoc()){
                         $shopList=$con->query("select * from shoplist where orderID=$row[orderID]");
                         while($row2=$shopList->fetch_assoc()){
                             $flower=$con->query("select picturem,fname,price,yourprice from flower where flowerID=$row2[flowerID]")->fetch_assoc();
                             $pp=$row2[num]*$flower[yourprice];
                             $all+=$pp;
                             echo "<tr class=\"quarter\">";
                             echo "<td><img src=\"flowerpicture/$flower[picturem]\">$flower[fname]</td>";
                             echo  "<td>$flower[yourprice]</td>";
                             echo  "<td>$row2[num]</td>";
                             echo  "<td>小计:$pp</td>";
                         }
                     }
                     ?>
                 </table>
             </td>
         </tr>
         <tr><td style="text-align: right" class="hr">合计：<?php echo  $all ?></td></tr>
     </table>

</body>
</html>