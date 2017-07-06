
<!DOCTYPE html>
  <head>
     <meta charset="utf-8">
     <script src="jquery-3.1.1.min.js"></script>
     <style>
        td{
            min-width: 150px;
            text-align: center;
        }
         input[type=button]{
             border: none;
             outline: none;
             vertical-align: middle;
         }
         .button{
             box-sizing: border-box;
             padding: 5px 10px;
             border-radius: 5px;
             cursor: pointer;

         }
     </style>
  </head>
  <body>
  <?php
  session_start();
  error_reporting(0);
  include "conn.php";
  include "top.php";
  if(empty($_SESSION[cartID]))
      $_SESSION[cartID]=time();
  $str="insert into cart (cartID,email,flowerID,num) VALUES($_SESSION[cartID],'$_SESSION[email]','$_GET[flowerid]',1)";
  $res=mysqli_query($con, $str);
  ?>
  <div style="width: 100%;overflow: hidden;text-align: center">

      <table style="display: inline-block">
          <tr>
              <td>编号</td>
              <td>商品名称</td>
              <td>市场价</td>
              <td>现价</td>
              <td>数量</td>
              <td>删除商品</td>
          </tr>
          <?php
          $mount=0;
          $str="select cart.flowerID,fname,price,yourprice,num,picturem from cart,flower where cartID='$_SESSION[cartID]' and cart.flowerID=flower.flowerID";
          $rs=mysqli_query($con, $str);
          while(@$row=mysqli_fetch_assoc($rs)){
              echo
              "<tr>
                <td class='flowerID'>$row[flowerID]</td>
                <td><img src='flowerpicture/$row[picturem]' style='height: 20px;width: 20px;vertical-align: top'>$row[fname]</td>
                <td>$row[price]</td>
                <td>$row[yourprice]</td>
                <td>
                   <input type='number' value='$row[num]' style='width: 50px;' id='num'>&nbsp;&nbsp;
                   <input type='button' value='更新' class='update' style='cursor: pointer'>
                </td>
                <td><input type='button' value='删除' class='delete' style='cursor: pointer'></td>
             </tr>";
             $mount+=$row[yourprice]*$row[num];
          }
          ?>
          <tr>

          </tr>
      </table>

      <br><Br><br>
      <div style="text-align: right;height: 100px;width: 80%;margin: 0 auto">
          <?php
          echo "合计:￥$mount&nbsp;&nbsp;";
          ?>
          <a class="button" id="goOn"  style="background-color: greenyellow">继续选购</a>
          <a class="button" id="clear" style="background-color: red">清除购物车</a>
          <a class="button" id="submit" style="background-color: #00b7ee">提交订单</a>
      </div>

  </div>

</body>
<script>
    $(function(){
        $("#goOn").click(function(){
            location.href="showflower.php"
        })
        $("#clear").click(function(){
            $.ajax({
                url:"sqlQuery.php",
                type:"post",
                dataType:"json",
                data:{query:"clear"},
                success:function(returndata){
                    if(returndata.status==1){
                        alert("清空成功！")
                        location.href="showflower.php";
                    }
                }
            })
        })
        $("#submit").click(function(){
            location.href="order.php";
        })
        $(".update").click(function(){
            $.ajax({
                url:"sqlQuery.php",
                type:"post",
                dataType:"json",
                data:{query:"update",num:$(this).prev().val(),flowerID:$(this).parents("tr").eq(0).find(".flowerID").eq(0).text()},
                success:function(returndata){
                    if(returndata.status==1){
                        alert("修改成功！")
                        location.href=returndata.to;
                    }
                }
            })
        })
        $(".delete").click(function(){
            $.ajax({
                url:"sqlQuery.php",
                type:"post",
                dataType:"json",
                data:{query:"delete",flowerID:$(this).parents("tr").eq(0).find(".flowerID").eq(0).text()},
                success:function(returndata){
                    if(returndata.status==1){
                        alert("删除成功！")
                        location.href=returndata.to;
                    }
                }
            })
        })
    })
</script>
</html>