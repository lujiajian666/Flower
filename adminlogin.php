<?php
include_once 'conn.php';
session_start();
if($_POST[submit]){
    $username=$_POST[username];
    $password=$_POST[password];

    $str=" SELECT COUNT(*) FROM admin where username='$username' and password='$password'";
    $data=$con->query($str)->fetch_row();
    $url="adminindex.php";
    if($data[0]){
        $_SESSION['email']=$username;
        $_SESSION[runtimeNum]=0;
        echo "<script>alert(\"登录成功\")</script>";
        echo "<META HTTP-EQUIV='refresh' CONTENT=\"0.5;url=$url\">";
    }else{

        echo "<script>alert('账号或密码错误!')</script>";
    }
}
?>
<!doctype html>
   <head>
       <title>鲜花网后台登陆</title>
       <style type="text/css">
           .content{
	          width:50%;
           	  margin:50px auto 0;
           }
           label{
           	  display:inline-block;
	          width:60px
           }
           .input_group{
           	  width:80%;
	          margin:20px auto;
           	  text-align:center;
           }
       </style>
       <script src=jquery-3.1.1.min.js></script> 
   </head>
   <body>

      <div class="content">
        <form id="form" method="post" action="">
           <fieldset>
             <legend>后台登陆</legend>
             <div class="input_group">
               <label for="username">用户名</label>
               <input id="username" name="username">
             </div>
             <div class="input_group">
               <label for="密码">密码</label>
               <input id="password" name="password" type="password">
             </div>
             <div class="input_group">
               <input type="submit" name="submit" value="提交">
             </div>
           </fieldset> 
        </form>
      </div>
   </body>
   <script>
            $(function(){
                


            })
   </script>
</html>
