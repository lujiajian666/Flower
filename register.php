<?php
  header("Content-type: text/html; charset=utf-8");
  include "conn.php";	//通过include调用数据库连接文件
  if(@$_POST[submit]){
      $email=$_POST["username"].$_POST["select"].".com";
      $str="select * from member where email='".$email."'";
      $rs=mysqli_query($con, $str);
      if(mysqli_fetch_row($rs)){
        echo "<script>alert('您输入的用户名已经存在！');window.location.href='register.php'</script>";
      }else{
          $_POST[password1]=md5($_POST[password1]);
        $sql="insert into  member(email,password,mname,sex,mobile,address,jifen,ye) values('$email','$_POST[password1]',
        '$_POST[name]','$_POST[gender]','$_POST[tel]','$_POST[address]',0,0.0)";
        $info=mysqli_query($con,$sql);
        if($info)
              echo "<script>alert('注册成功！');window.location.href='register.php'</script>";
        else
              echo "<script>alert('注册失败！');window.location.href='register.php'</script>";
      }
  }
  
?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
     <form method="post" action="">
     <table>
        <tr>
           <td>Email</td>
           <td><input name="username">@</td>
           <td>
               <select name="select">
                  <option value="126">126.com</option>
                  <option value="163">163.com</option>
                  <option value="qq">qq.com</option>
               </select>
           </td>
        </tr>
        <tr>
           <td>密码：</td>
           <td><input type="password" name="password1"></td>
        </tr>
        <tr>
           <td>确认密码：</td>
           <td><input type="password" name="password"></td>
        </tr>
        <tr>
           <td>姓名：</td>
           <td><input name="name"></td>
        </tr>
        <tr>
           <td>性别：</td>
           <td><input type="radio" name="gender" value="b" checked>男<input type="radio" name="gender" value="g">女</td>
        </tr>
        <tr>
           <td>联系电话：</td>
           <td><input type="tel" name="tel"></td>
        </tr>
        <tr>
           <td>地址：</td>
           <td><input name="address"></td>
        </tr>
        <tr>
           <td><input type="submit" name="submit" value="提交"></td>
        </tr>
     </table>
     </form>
  </body>
</html>