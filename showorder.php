<!DOCTYPE html>
<head>
   <meta charset="utf-8">
   <title>我的订单</title>
    <script src="jquery-3.1.1.min.js"></script>
    <style>
        table{
            width: 100%;
        }
        tbody{
            width: 100%;
        }
        .center td{
            text-align: center;
        }
        img{
            height: 50px;
            width: 50px;
        }
        .oldprice{
            display: block;
            width: 100%;
            position: relative;
        }
        .oldprice:before{
            content: "";
            position: absolute;
            top:50%;
            border-top: 2px blue solid;
            left: 0;
            right: 0;
        }
        .nowprice{
            display: block;
        }
        .subtitle{
            background-color: #eefdbf;
            border-radius: 5px;
            text-indent: 2em;
            padding: 5px;
        }
        #takeDelivery{
            margin-left: 10px;
            box-sizing: border-box;
            padding: 2px 5px;
            background-color: #edfcbe;
            border-radius: 5px;
        }
        #evaluate{
            margin-left: 10px;
        }
    </style>
</head>
<body>
<?php
include "conn.php";
include "top.php";
?>

<table>
  <tr>
     <td colspan=6 style="text-align: center" class="subtitle">我的订单</td>
  </tr>
  <tr class="center">
     <td>宝贝</td> 
     <td>价格</td>
     <td>数量</td>
     <td>实付款</td>
     <td>交易状态</td>
     <td>操作</td>
  </tr>
    <?php
    $str="select * from myorder where email= '$_SESSION[email]'";
    $data=$con->query($str);
    while($row=$data->fetch_assoc()){
        $index=0;
        $shopList=$con->query("select * from shoplist where orderID=$row[orderID]");
        $shopListRow=$shopList->num_rows;

        $customer=$con->query("select sname from customer where custID=$row[custID]")->fetch_assoc();
        echo " <tr><td colspan=6 class='subtitle'>订单编号:$row[orderID] 配送日期：$row[peisongday] 收货人：$customer[sname]</td></tr>";

        $pp=0;

        if(empty($row[ddzt])){
            $ddztTxt="没发货";
        }else if($row[ddzt]==1){
            $ddztTxt="已发货<a href='#' id='takeDelivery' data-id=$row[orderID]>确认收货</a>";
        }else{
            if($row[comment]==0)
               $ddztTxt="已完成<a href='evaluate.php?orderID=$row[orderID]' id='evaluate'>评价</a>" ;
            else
               $ddztTxt="已完成<a href='javascript:void(0)' id='evaluate'>已评价</a>" ;
        }

        while($row2=$shopList->fetch_assoc()){
            $flower=$con->query("select price,yourprice from flower where flowerID=$row2[flowerID]")->fetch_assoc();
            $pp+=$flower[yourprice]*$row2[num];
        }
        $shopList->data_seek(0);
        unset($row2);
        while($row2=$shopList->fetch_assoc()){
             $flower=$con->query("select picturem,fname,price,yourprice from flower where flowerID=$row2[flowerID]")->fetch_assoc();
             $index++;

            if($index==1){
                echo " <tr class='center'>";
                echo "<td><img src=\"flowerpicture/$flower[picturem]\">$flower[fname]</td>";
                echo  "<td><span class='oldprice'>$flower[price]</span><span class='nowprice'>$flower[yourprice]</span></td>";
                echo  "<td>$row2[num]</td><td rowspan='$shopListRow'>$pp</td><td rowspan='$shopListRow'>$ddztTxt</td><td rowspan='$shopListRow'><a href='orderDetail.php?orderID=$row[orderID]'>查看</a> 取消 付款</td></tr>";
            }else{
                echo " <tr class='center'>";
                echo "<td><img src=\"flowerpicture/$flower[picturem]\">$flower[fname]</td>";
                echo  "<td><span class='oldprice'>$flower[price]</span><span class='nowprice'>$flower[yourprice]</span></td>";
                echo  "<td>$row2[num]</td>";
            }

        }

    }
    ?>
</table>
</body>
<script>
    $(function () {
        $("#takeDelivery").click(function () {
            $.ajax({
                url:"dealAdmin.php",
                type:"post",
                dataType:"json",
                data:{str:"xiugai",value:2,id:$(this).attr("data-id")},
                success: function (data) {
                    alert(data.txt)
                    window.location.reload(true);
                }
            })
        })

    })
</script>
</html>