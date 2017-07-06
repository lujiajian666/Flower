<?php
/**
 * Created by PhpStorm.
 * User: lujiajian
 * Date: 2017/5/13
 * Time: 11:50
 */
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <script src="jquery-3.1.1.min.js"></script>
    <style>
        .session{
            text-align: center;
        }
        ul{
            list-style: none;
        }
        .a{
           margin-left: 10px;
        }
        .fullScreenDiv{
            position: fixed;
            top:0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: black;
            opacity: 0.4;
            z-index: 1;
        }
        .contentScreenDiv{
            position: fixed;
            top:50%;
            left: 20%;
            width: 60%;
            height: 300px;
            background-color: white;
            border-radius: 10px;
            transform: translateY(-50%);
            z-index: 2;
            text-align: center;
        }
        .close{
            position: absolute;
            right: 10px;
            font-weight: bold;
            top: 10px;
            cursor: pointer;;
        }
        .contentScreenDiv input{
            padding: 5px;
            width: 250px;
            margin-bottom: 5px;
        }
        .contentScreenDiv select{
            padding: 5px;
            width: 264px;
            margin-bottom: 5px;
        }
        .aButton{
            color: white;
            background-color: #f0ad4e;
            display: inline-block;
            height: 40px;
            width: 150px;
            line-height: 40px;
            text-align: center;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php
include "conn.php";
include "top.php";
?>
  <div id="session1" class="session">
      <h1>选择收货人地址</h1><a href="javascript:void(0)" id="add">添加</a>
      <ul>
          <?php
             $str="select * from customer WHERE(email='$_SESSION[email]') ORDER BY custID";
             $res=mysqli_query($con, $str);
             while($row=mysqli_fetch_assoc($res)){
                 if($row["cdefault"]!=1) {
                     echo "<li><input type='radio' value='$row[custID]' name='custID' form='form' >$row[sname],$row[mobile],$row[address],$row[zip]";
                     echo "<a class='a' href='javascript:void(0)'>设为默认地址</a>&nbsp;&nbsp;<a class='b' href='javascript:void(0)'>删除</a></li>";
                 }
                 else {
                     echo "<li><input type='radio' value='$row[custID]' name='custID' form='form' checked>$row[sname],$row[mobile],$row[address],$row[zip]";
                     echo "<a class='a'>&nbsp;&nbsp;&nbsp;默认地址&nbsp;&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;<a class='b' href='javascript:void(0)'>删除</a></li>";
                }
             }
          ?>
      </ul>
  </div>
  <div id="session2" class="session">
      <h1>配送费用</h1>
      <input type="radio" name="peisong" value="10" form="form" checked>市区
      <input type="radio" name="peisong" value="20" form="form">郊区
      <input type="radio" name="peisong" value="30" form="form">远郊
  </div>
  <div id="session3" class="session">
      <h1>配送日期</h1>
      <p>送货日期:<input type="date" name="peisongday" form="form"></p>
      <p>时段:
          <input type="radio" name="time" name="peisongtime" value="0" form="form" checked>不限
          <input type="radio" name="time" name="peisongtime" value="1" form="form">上午
          <input type="radio" name="time" name="peisongtime" value="2" form="form">下午
          <input type="radio" name="time" name="peisongtime" value="3" form="form">晚上
      </p>
  </div>
  <div id="session4" class="session">
      <h1>卡片资料</h1>
      <p>留言：<input type="text" name="liuyan" form="form"></p>
      <p>署名：<input type="text" name="shuming" form="form"></p>
  </div>
  <div id="session5" class="session">
      <h2>付款方式</h2>
      <input type="radio" name="fkfs" value="0" form="form" checked>网上支付<br>
      <input type="radio" name="fkfs" value="1" form="form">银行转账<br>
      <input type="radio" name="fkfs" value="2" form="form">邮局汇款<br>
      <input type="radio" name="fkfs" value="3" form="form">上门收款<br>
  </div>
  <div id="session6" class="session">
    <h2>我要寄发票</h2>
    <input type="text" name="fpsname" form="form">&nbsp;&nbsp;&nbsp;抬头<br>
    <input type="text" name="fpaddress" form="form" >&nbsp;&nbsp;&nbsp;地址<br>
    <input type="text" name="zip" form="form">&nbsp;&nbsp;&nbsp;邮编<br>
    <input type="text" name="fkfs" form="form">收信人<br>
      <hr>
      <a class="button submit" style="cursor: pointer">提交</a>
  </div>

  <div class="fullScreenDiv" style="display: none"></div>
  <div class="contentScreenDiv" style="display: none">
      <span class="close">×</span>
      <h3>添加收货人地址</h3>
      <input type="text" placeholder="收货人姓名" id="name"><br>
      <input id="phone" placeholder="移动电话"><br>
      <input id="zip" placeholder="邮编"><br>
      <input id="dAddress" placeholder="详细地址"><br>
      <select id="sex">
          <option value="男">收货人性别</option>
          <option value="男">男</option>
          <option value="女">女</option>
      </select><br>
      <a class="aButton">确认提交</a>
  </div>
  <div style="display: none">
      <form id="form"></form>
  </div>
</body>
<script>
    $(function(){
        //ljj 提交订单
          $(".submit").click(function(){
              var formdata=new FormData($("#form").get(0));
              $.ajax({
                  url:"dealOrder.php",
                  data:formdata,
                  type:"post",
                  dataType:"json",

                  processData:false,
                  contentType:false,

                  success: function (returndata) {
                      if(returndata.status==1) {
                          alert("添加成功！");
                          location.href=returndata.to;
                      }
                  }
              })
          })
        //ljj 添加地址
          $("#add").click(function(){
              var fullScreenDive=$(".fullScreenDiv")
              var contentScreenDiv=$(".contentScreenDiv")
              fullScreenDive.show();
              contentScreenDiv.show();
          })
        //ljj 添加地址确认
        $(".aButton").click(function () {
            var data={
                query:"add",
                name:$("#name").val(),
                phone:$("#phone").val(),
                zip:$("#zip").val(),
                dAddress:$("#dAddress").val(),
                sex:$("#sex").val()
            };
            $.ajax({
                url:"sqlQuery.php",
                data:data,
                type:"post",
                dataType:"json",

                success: function (returndata) {
                    if(returndata.status==1) {
                        alert("添加成功！");
                        location.href=returndata.to;
                    }
                }
            })
        })
        //ljj 添加地址处×
        $(".close").click(function(){
            var fullScreenDive=$(".fullScreenDiv")
            var contentScreenDiv=$(".contentScreenDiv")

            fullScreenDive.hide();
            contentScreenDiv.hide();
        })
        //ljj 删除地址
        $(".b").click(function () {
            $.ajax({
                url:"sqlQuery.php",
                data:{query:"delAddress",custerID:$(this).parent().find("input").eq(0).val()},
                type:"post",
                dataType:"json",

                success: function (returndata) {
                    if(returndata.status==1) {
                        alert("删除成功！");
                        location.href=returndata.to;
                    }
                }
            })
        })
        //ljj 设为默认地址
        $(".a").click(function () {
            $.ajax({
                url:"sqlQuery.php",
                data:{query:"setDefault",custerID:$(this).parent().find("input").eq(0).val()},
                type:"post",
                dataType:"json",

                success: function (returndata) {
                    if(returndata.status==1) {
                        alert("设置成功！");
                        location.href=returndata.to;
                    }
                }
            })
        })

    })
</script>
</html>