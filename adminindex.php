<!doctype html>
   <head>
      <meta charset="UTF-8">
      <title></title>
      <script src="jquery-3.1.1.min.js"></script>
      <style>
         .mytable{
            text-align: center;
            width: 60%;
            margin: 0 auto;
            font-weight: bolder;
         }
         img{
            height: 100px;
            width: 100px;
         }
         .add{
            border-radius: 50%;
            height: 70px;
            width: 120px;
            color: white;
            font-weight: bolder;
            background-color: orange;
            line-height: 70px;
            text-align: center;
            margin: 20px auto;
            cursor: pointer;
         }
      </style>
   </head>
   <body>
   <?php
      include_once 'top2.php';
      include_once 'conn.php';
      $data=$con->query("select * from flower")

   ?>
   <div class="add">添加</div>
   <table class="mytable">
      <tr>
         <th>鲜花编号</th>
         <th>鲜花名字</th>
         <th>图片</th>
         <th>操作</th>
      </tr>
      <?php
         while($row=$data->fetch_assoc()){
            echo "<tr>
                    <td>$row[flowerID]</td>
                    <td><input value='$row[fname]' name='fname'></td>
                    <td><img src='flowerpicture/$row[picturem]' data-id='$row[flowerID]'></td>
                    <td>
                          <span class='edit' data-id='$row[flowerID]'>修改</span>&nbsp;&nbsp;&nbsp;
                          <span class='delete' data-id='$row[flowerID]'>删除</span></td>
                    </tr>";
         }
      ?>

   </table>
   <input style="display: none" id="img" type="file">
   <div style="display: none;position:fixed;top: 0;bottom: 0;left: 0;right: 0;background-color: black;opacity: 0.5;z-index: 1000" id="hideDiv"></div>
   <div id="fatherDiv" style="display: none;position: fixed;top: 0;bottom: 0;left: 0;right: 0;z-index: 2000">
      <div id="sonDiv" style="position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);display: flex;
      justify-content: center;align-content: center;align-items: center;border-radius: 10px;background-color: white;
      flex-wrap:wrap;height: 300px;width: 400px;position: relative">
            <div style="position: absolute;top: 10px;right: 10px;font-weight: bolder;cursor: pointer" id="cuo">×</div>
            <h2 style="color: orange;width: 400px;text-align: center;margin: 0">添加</h2>
            <img src="" style="height: 100px;width: 150px">
            <div style="width: 400px;height: 20px"></div>
            <input placeholder="花名">


            <input type="file" id="img2" style="border: 1px solid ghostwhite">
            <div style="width: 400px">
               <div id="addSure" style="margin:0 auto;width: 100px;line-height: 50px;background-color:darkorange;text-align: center;color: white">确定</div>
            </div>


      </div>
   </div>

   </body>
   <script>
      $(function(){
          $(".delete").click(function(){
             $.ajax({
                url:"dealAdmin.php",
                type:"post",
                dataType:"json",
                data:{str:"delete",flowerID:$(this).attr("data-id")},
                success:function(data){
                     if(data.status==1)
                         location.reload(true);
                }
             })
          })
          $("img").click(function(){
              $("#img").remove();
              var src=$(this).attr("data-id");
              $("body").append('<input style="display: none" id="img" type="file" data-id="'+src+'">')
              $("#img").click();
          })
          $("body").on("change","#img",function(){
                var data_id=$(this).attr("data-id");

                $("img[data-id="+data_id+"]").prop("src",getObjectURL($("#img").get(0).files[0]))
          })
          $(".edit").click(function () {
             var formdata=new FormData();
             formdata.append("str","edit");
             formdata.append("flowerID",$(this).attr("data-id"));
             formdata.append("fname",$(this).parents("tr").find("input[name=fname]").val())
             formdata.append("img",$("#img").get(0).files[0]);
             $.ajax({
                url:"dealAdmin.php",
                type:"post",
                dataType:"json",
                data:formdata,

                processData:false,
                contentType:false,

                success:function(data){
                   if(data.status==1)
                      location.reload(true);
                }
             })
          })
          $(".add").click(function () {
                const father=$("#fatherDiv");
                const hide=$("#hideDiv");

                father.fadeIn();
                hide.fadeIn();
          })
          $("#img2").change(function(){
              $(this).prev().prev().prev().prop("src",getObjectURL(this.files[0]))
          })
          $("#cuo").click(function(){
            const father=$("#fatherDiv");
            const hide=$("#hideDiv");

            father.fadeOut();
            hide.fadeOut();
         })
          $("#addSure").click(function () {
             var formdata=new FormData();
             formdata.append("str","add");
             formdata.append("fname",$(this).parent().prev().prev().val())
             formdata.append("img",$("#img2").get(0).files[0]);
             $.ajax({
                url:"dealAdmin.php",
                type:"post",
                dataType:"json",
                data:formdata,

                processData:false,
                contentType:false,

                success:function(data){
                   if(data.status==1)
                      location.reload(true);
                }
             })
          })
      })
      function getObjectURL(file) {
         var url = null ;
         if (window.createObjectURL!=undefined) { // basic
            url = window.createObjectURL(file) ;
         } else if (window.URL!=undefined) { // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
         } else if (window.webkitURL!=undefined) { // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
         }
         return url ;
      }

   </script>
</html>
