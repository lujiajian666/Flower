<?php
   include_once "top.php";
?>
<!doctype html>
   <head>
      <meta charset="UTF-8">
      <title>鲜花网首页</title>
      <script src="jquery-3.1.1.min.js"></script>
      <style>
          *{
              padding: 0;
              margin: 0;
          }
          ul{
              list-style: none;
          }
          #nav .ul{
              overflow: hidden;
              text-align: center;
              width: 60%;
              margin: 0 auto;
          }

          #nav .ul li{
              float: left;
              padding: 9px 24px;
              font-weight: bolder;
          }
          #lunBo{
              width: 100%;
              height: 440px;
              overflow: hidden;
              position: relative;
          }
          #lunBo ul{
              width: 400%;
          }
          #lunBo li{
              width: 25%;
              height: 100%;
              float: left;
          }
          #lunBo li img{
              width: 100%;
              height: 100%;
          }
          #lunBoNav{
              position: absolute;
              left: 10px;
              top: -40px;
              width: 250px;
              z-index: 9999;

          }
          #title{
              background-color: #fd6a01;
              color: white;
              font-weight: bolder;
              line-height: 40px;
              padding: 0 10px;
          }
          #content{
              background-color: white;
          }
          #lunBoBOX:after{
              content: "";
              border: 2px #fd6a01 solid;
              position: absolute;
              left: 0;
              right: 0;
              top: -2px;
          }
          #lunBoNav .ul{
              padding: 10px 16px;
              position: relative;
          }
          #lunBoNav .ul:after{
              content: "";

          }
          #lunBoNav .ul ul li{
              display: inline-block;
              padding: 5px;
              font-size: 12px;
          }
          #lunBoNav .ul>li>h4{
                color: orange;
                font-weight: bolder;
          }
          #dian{
              position: absolute;
              left: 50%;
              bottom: 10px;
              transform: translateX(-50%);
          }
          .dian{
              display: inline-block;
              height: 20px;
              width: 20px;
              margin: 10px;
              border-radius: 50%;
              background-color: black;
              opacity: 0.5;
          }
          .orange{
              background-color: red;
          }
      </style>
   </head>
   <body>
   <div id="nav" >
     <ul style="list-style: none" class="ul">
         <li>鲜花</li>
         <li>永生花</li>
         <li>蛋糕</li>
         <li>礼品</li>
         <li>巧克力</li>
         <li>花语大全</li>
         <li>企业团购</li>
         <li style="color: red">父亲节购物</li>
     </ul>
    </div>
   <div id="lunBoBOX" style="position: relative">
       <div id="lunBoNav">
           <div id="title">全部商品导购</div>
           <div id="content">
               <ul class="ul">
                   <li>
                       <h4>鲜花用途</h4>
                       <ul>
                           <li>爱情鲜花</li>
                           <li>友情鲜花</li>
                           <li>生日鲜花</li>
                           <li>问候长辈</li>
                           <li>探病慰问</li>
                           <li>道歉鲜花</li>
                           <li>祝贺鲜花</li>
                           <li>婚庆鲜花</li>
                           <li>商务鲜花</li>
                       </ul>
                   </li>
                   <li></li>
                   <li></li>
               </ul>
               <ul class="ul">
                   <li>
                       <h4>鲜花花材</h4>
                       <ul>
                           <li>玫瑰</li>
                           <li>康乃馨</li>
                           <li>郁金香</li>
                           <li>百合</li>
                           <li>扶郎</li>
                           <li>马蹄莲</li>
                           <li>向日葵</li>
                       </ul>
                   </li>
                   <li></li>
                   <li></li>
               </ul>
               <ul class="ul">
                   <li>
                       <h4>鲜花类别</h4>
                       <ul>
                           <li>花束</li>
                           <li>花盒</li>
                           <li>瓶话</li>
                           <li>精品鲜花</li>
                           <li>果篮</li>
                           <li>桌面花篮</li>
                           <li>开业花篮</li>
                       </ul>
                   </li>
               </ul>
           </div>
       </div>
       <div id="lunBo">

           <ul>
               <li><img src="http://img02.hua.com/pc/pimg/banner_lpk.jpg"></li>
               <li><img src="http://img02.hua.com/slider/17graduation_pc.jpg"></li>
               <li><img src="http://img02.hua.com/banner/longtou.jpg"></li>
               <li><img src="http://img02.hua.com/slider/17fatherday_pc.jpg"></li>
           </ul>
       </div>
       <div id="dian">
           <ul>
               <li class="dian orange"></li>
               <li class="dian"></li>
               <li class="dian"></li>
               <li class="dian"></li>
           </ul>
       </div>
   </div>
   <div>
       <h1 style="text-align: center;line-height: 50px">鲜花网，强无敌！</h1>
   </div>
   </body>
   <script>
       var index=0;
       const ul=$("#lunBo>ul:first-of-type");
       const li=$("#lunBo>ul:first-of-type>li");
       const width=li.eq(0).width();
       $(function () {
           var time=setInterval("lunbo(1200)",1200)
           $(".dian").hover(function () {
                 clearInterval(time);
           },function () {
                 time=setInterval("lunbo(1200)",1200)
           })
       })
       function lunbo(time){
           lunboTurnRight(time);



       }
       function lunboTurnRight(time) {
           if(index>=3)
               index=-1;
           index++
           $(".dian").eq(index).addClass("orange").siblings().removeClass("orange")
           ul.animate({marginLeft:-width+"px"},time,function () {
               ul.css("margin-left",0)
               ul.children("li").eq(0).appendTo(ul);
           })
       }
       function lunboTurnLeft(time){
           if(index<0)
               index=3
           index--;

           $(".dian").eq(index).addClass("orange").siblings().removeClass("orange")

           ul.children("li").last().prependTo(ul);
           ul.css("margin-left",-width+"px")
           ul.animate({marginLeft:0},time)
       }
   </script>
</html>