<?php 
session_start();
error_reporting(0);
header("Content-type: text/html; charset=utf-8");
include "conn.php";	//通过include调用数据库连接文件
if(@$_POST[btnLogin]){
    $email=$_POST["email"].$_POST["mailbox"];
   // echo $email;
    if($_POST[code]!=$_SESSION[check_checks]){
        echo "<script>alert('验证码错误！');window.location.href='login.php'</script>";
//        echo  "验证码错误：".$_POST[code]."!=".$_SESSION[check_checks];
        exit();
    }
    $_POST[password]=md5($_POST[password]);
    echo $_POST[password];
    $str="select * from member where email='$email' and password='$_POST[password]' ";
    $rs=mysqli_query($con, $str);
    if(mysqli_fetch_row($rs)){
        echo "<script>alert('登陆成功！');window.location.href='showflower.php'</script>";
        $_SESSION['email']=$email;
    }else{
        echo "<script>alert('账号或密码错误！')</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
 <form action="" method="post">
   <div align="center">
      <h2>请登录鲜花礼品网</h2>
      <table>
         <tr>
            <td>Email：</td>
            <td colspan="2">
               <input type="text" name="email">&nbsp;@
               <select name="mailbox">
                  <option value="@163.com">163.com</option>
               </select>
            </td>
         </tr>
          <tr>
            <td>密码：</td>
            <td colspan="2"><input type="password" name="password"></td>
         </tr>
         <tr>
            <td>验证码：</td>
            <td>
               <input type="text" name="code">
            </td>
            <td>
               <img src="./checks.php" width="65" height="28">
            </td>
         </tr>
         <tr>
           <td style="text-align: center;" colspan="3">
              <input type="submit" name="btnLogin" >
           </td>
         </tr>
      </table>
   </div>
</form>
</body>
</html>