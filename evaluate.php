<?php
/**
 * Created by PhpStorm.
 * User: lujiajian
 * Date: 2017/6/8
 * Time: 12:33
 */
?>
<!doctype html>
   <head>
      <script src="jquery-3.1.1.min.js"></script>
      <style>
          body{
              text-align: center;
          }
          .comment{
              box-sizing: border-box;
              padding: 10px;
              border: 1px aqua solid;
              text-align: center;
              margin: 20px auto;
              width: 60%;

          }
          table,tr{
              width: 100%;
              height:50px;
          }
          tr>td:first-of-type{
              width: 40%;
          }
          tr>td:nth-of-type(2){
              width: 60%;
          }
      </style>
   </head>
   <body onload="a()">
       <?php
          include_once "top.php";
       ?>
       <template id="template">
           <div class="comment">
               <p>评价宝贝--请您对所购买的商品评价</p>

               <table>
                   <tr>
                       <td rowspan="3">
                           <img class="img" src="src" style="height: 100%;width: 100%;text-align: center;" alt="alt">
                       </td>
                       <td style="text-align: left">
                           <span class="good">优<input type="radio" name="comment" value="1" checked></span>
                           <span class="average">良<input type="radio" name="comment" value="2"></span>
                           <span class="poor">差<input type="radio" name="comment" value="3"></span>
                       </td>
                   </tr>
                   <tr>
                       <td rowspan="2" style="text-align: left;">
                           <textarea class="textarea" placeholder="送货很准时，鲜花很漂亮，包装精美" style="width: 90%;height: 100%"></textarea>
                       </td>
                   </tr>
                   <tr></tr>
               </table>
           </div>
       </template>

   </body>
<script>
    $(function () {
         $("body").on('click',".submit", function (){
               console.log("submit!")
               const array=[];
               var obj=$(".comment");
               obj.each(function () {
                   const txt=$(this).find(".textarea").eq(0).val();
                   const comment=$(this).find("input[type=radio]:checked").val();
                   const flowerID=$(this).find(".img").eq(0).attr("data-id");
                   array.push({txt:txt,comment:comment,flowerID:flowerID});
               })

             $.ajax({
                 url:"comment.php",
                 type:"post",
                 dataType:"json",
                 data:{array:array,str:2,orderID:getId(location.href)},
                 success: function (data) {
                      if(data.status==1) {
                          alert("评价成功!")
                          location.href="showflower.php";
                      }
                 }
             })
         })
    })
    function getId(url){
        url=url.split('?')[1].split('=');
        return url[1];
    }
    function a(){
        const orderID=getId(location.href);
        $.ajax({
            url:"comment.php",
            type:"post",
            dataType:"json",
            data:{orderID:orderID,str:1},
            success: function (data) {
                  var str;
                  for(var i in data){
                       str=$("#template").html();
                       str=$(str);
                      str.find(".img").attr("alt","123")
                      str.find("input[type=radio]").prop("name","comment"+i)
                      str.find(".img").prop("src","flowerpicture/"+data[i]["pic"])
                      str.find(".img").attr("data-id",data[i]["flowerID"])
                      $("body").append(str);
                  }
                  $("body").append('<input type="submit" value="确定" class="submit">');
            }
        })
    }
</script>
</html>
