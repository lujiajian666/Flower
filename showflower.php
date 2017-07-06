<html>
  <head>
     <meta charset="utf-8">
      <script src="jquery-3.1.1.min.js"></script>
     <style type="text/css">
        li{
	      display:block;
          overflow:hidden;  	
        }
        .left{
	       width:30%;
           height:300px;	 
           float:left;	
        }
        .left>img{
	       box-sizing:border-box;
           width:100%;
           height:100%;
           padding:50px 20px; 			  
        }
        .right{
	       width:60%;
           float:left;	
        }
        .right>p:first-of-type{
	      width:100%;
          box-sizing:border-box;
          border:3px red solid;
          line-height:50px;
          font-weight:bolder;
          color:blue;					
        }
        th{
	      display:inline-block;
          width:15%;
          text-align:left;
        }
        table[class^=aaaa]{
            width: 100%;
            border-bottom: 1px #999999 solid;
            border-top: 1px #999999 solid;
            margin-bottom: 10px;
            margin-top: 10px;
        }
        table:not([class^=aaaa]) .td{
        	text-align:left;
        	display:inline-block;
            width:75%;
         	word-wrap:break-word;word-break:break-all;
        }
        .centerter table:not([class^=aaaa]) tr{
            display: inline-block;
            width: 100%;
        }
        .aa>p:nth-of-type(1),.aa>p:nth-of-type(2){
	        color:blue;
        	position:relative;
        	line-height:30px;
        	margin:0;
        }
        .bb:after{
	         content:"";
        	 position:absolute;
        	 top:14px;
        	 left:50px;
        	 width:50px;
        	 border-top:2px blue solid;
        }
        .aa{
	      width:100%;
          text-align:left;	
        }
        .shopcar{
	      background-color:orange;
          border-radius:5px;
          height:40px;
          width:100px;
          line-height:40px;	
          margin:0;	
          text-align:center;			
        }
        a:link {
            color: #000000;
            text-decoration: none;
        }
        a:visited {
            color: #000000;
            text-decoration: none;
        }
        a:hover {
            color: #999999;
            text-decoration: underline;
        }
     </style>
  </head>
  <body>
<?php
error_reporting(0);
  include "top.php";
  include "conn.php";
 
  
?>
<center class="centerter">
  <ul style="width:60%;border:0;overflow:hidden">
       <?php
       $page=$_GET[page];
       if(empty($page))
           $page=1;
       $str="select * from flower";
       $rs=mysqli_query($con, $str);
       for($all_page_i=0;$all_page_i<ceil($rs->num_rows/5);$all_page_i++){
           $all_page_i++;
           echo "<a class='aaa' href='showflower.php?page=$all_page_i'>$all_page_i</a>&nbsp;&nbsp;&nbsp;";
           $all_page_i--;
       }

       $start=($page-1)*5;
       $end=5;

       $str="select * from flower limit $start,$end";
       $rs=mysqli_query($con, $str);
       while(@$row=mysqli_fetch_assoc($rs)){
           $commentData=$con->query("select * from comment where flowerID=$row[flowerID]");
           $commentStr=null;
           while($commentRow=$commentData->fetch_assoc()){

               if($commentRow["class"]==1)
                   $commentClass="优秀";
               elseif($commentRow["class"]==2)
                   $commentClass="一般";
               else
                   $commentClass="垃圾";
               $commentStr.="<li>
                              <table class='aaaa'>
                                <tr>
                                  <td rowspan='2' style='width: 30%'>$commentRow[username]</td>
                                  <td>评价：$commentClass</td>
                                </tr>
                                <tr>
                                  <td>评语:$commentRow[txt]</td>
                                </tr>
                              </table>
                            </li>";
           }

           echo '
       <li>
         <div class="left">
            <img alt="这是花" src="flowerpicture/'.$row[picturem].'" class="showComment">
         </div>
         <div class="right">
         <p>'.$row[fname].'</p>
         <table style="display:block;width:100%">
            <tbody style="display:block;width:100%">   
            <tr>
              <th>材料</td>
              <td class="td" >'.$row[cailiao].'</td>
            </tr>
             <tr>
              <th>包装</td>
              <td class="td">'.$row[baozhuang].'</td>
            </tr>
             <tr>
              <th>花语</td>
              <td class="td">'.$row[huayu].'</td>
            </tr>
             <tr>
              <th>说明</td>
              <td class="td">'.$row[shuoming].'</td>
            </tr>
         	<tbody>
         </table>
         <div class="aa">
         <p class="bb">原价：￥'.$row[price].'</p>
         <p>现价：&nbsp;<span style="color: red">￥'.$row[yourprice].'</span></p>
         <p class="shopcar" data-flowerid='.$row[flowerID].'>加入购物车</p>
         </div>
       </div>
         <div style="clear:both;display:none" class="hide">
           <ul>
          '.$commentStr.'
           </ul>
         </div>
       </li>';
       }
        
       ?>
  </ul>
</center>
</body>
<script>
    $(function(){
        $(".shopcar").click(function(){
            var flowerid=$(this).attr("data-flowerid");
             location.href="shopcar.php?flowerid="+flowerid;
        })
        $(".showComment").click(function () {
            $(this).parent().next().next().toggle();
        })
    })
</script>
</html>