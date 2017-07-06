<!--  Created by PhpStorm.-->
<!--  User: lujiajian-->
<!--  Date: 2017/6/7-->
<!--  Time: 21:00-->


<!doctype html>
  <head>
      <script src="jquery-3.1.1.min.js"></script>
      <style>
          tr,table,tbody{
              width: 100%;
              text-align: center;
          }
          .xiugai{
              box-sizing: border-box;
              padding: 2px 5px;
              border-radius: 5px;
              color: white;
              background-color: orange;
              margin-left: 10px;
              cursor: pointer;
              font-size: 14px;
              transition: background-color 0.5s;
          }
          .xiugai:hover{
              background-color: greenyellow;
          }
      </style>
  </head>
  <body>
  <?php
  include_once "conn.php";
  include_once "top2.php";
  ?>
      <table>
          <tr>
              <th>序号</th>
              <th>叮当编号</th>
              <th>订货人</th>
              <th>收货人</th>
              <th>下单时间</th>
              <th>实付</th>
              <th>订单状态</th>
              <th>处理时间</th>
              <th>功能</th>
          </tr>
          <?php


          $str="select * from myorder";
          if($res=$con->query($str)){
              $i=0;
               while($row=$res->fetch_assoc()){
                  $sname=$con->query("select sname from customer where custID='$row[custID]' ")->fetch_row()[0];

                   $i++;
                   $orderTime=date("Y-m-d h:i:s",$row[inputtime]);
                   if(empty($row[ddzt])){
                       $ddzt1=0;
                       $ddztText1="未完成";
                       $ddzt2=1;
                       $ddztText2="已完成";
                   }else{
                       $ddzt2=0;
                       $ddztText2="未完成";
                       $ddzt1=1;
                       $ddztText1="已完成";
                   }
                   $str="<tr>";
                   $str.="<td>$i</td><td>$row[orderID]</td><td>$row[email]</td><td>$sname</td><td>$orderTime</td><td>$row[shifu]</td>".
                       "<td><select><option value=$ddzt1>$ddztText1</option><option value=$ddzt2>$ddztText2</option></select><a class='xiugai' data-id=$row[orderID]>修改</a></td>".
                       "<td>$row[cltime]</td><td><a href='#'>详情</a></td>";
                  echo $str;
              }
          }
          ?>
      </table>
  </body>
  <script>
      $(function () {
           $(".xiugai").click(function () {
               const value=$(this).prev().val();
               $.ajax({
                   url:"dealAdmin.php",
                   type:"post",
                   dataType:"json",
                   data:{str:"xiugai",value:value,id:$(this).attr("data-id")},
                   success: function (data) {
                       alert(data.txt)
                       location.href=location.href;
                   }
               })
           })
      })
  </script>
</html>