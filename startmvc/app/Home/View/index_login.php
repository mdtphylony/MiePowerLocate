<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.5, user-scalable=no">

    <script src="/static/js/bootstrap.js"></script>
    <script src="/static/js/jquery.js"></script>
    <script src="/static/js/jquery-ui.js"></script>
    <link href="/static/css/jquery-ui.css" rel="stylesheet">
    <script src="http://api.map.baidu.com/api?type=webgl&v=1.0&ak=ap6f2VqoYj5zo1OPbhEuKUC2I5LYgsVR"></script>
    <link rel="stylesheet" href="/static/css/bootstrap.css" type="text/css">
    <title>信息上报系统-登录</title>

    <script src="/static/js/infobox.js"></script>
    <style type="text/css">
        .infoBoxContent{font-size:12px;}
        .infoBoxContent .title{background:url(images/title.jpg) no-repeat;height:42px;width:272px;}
        .infoBoxContent .title strong{font-size:14px;line-height:42px;padding:0 10px 0 5px;}
        .infoBoxContent .title .price{color:#FFFF00;}
        .infoBoxContent .list{width:268px;border:solid 1px #4FA5FC;border-top:none;background:#fff;height:260px;}
        .infoBoxContent .list ul{margin:0;padding:5px;list-style:none;}
        .infoBoxContent .list ul li {float:left;width:255px;border-bottom:solid 1px #4FA5FC;padding:2px 0;}
        .infoBoxContent .list ul .last{border:none;}
        .infoBoxContent .list ul img{width:53px;height:42px;margin-right:5px;}
        .infoBoxContent .list ul p{padding:0;margin:0;}
        .infoBoxContent .left{float:left;}
        .infoBoxContent .rmb{float:right;color:#EB6100;font-size:14px;font-weight:bold;}
        .infoBoxContent a{color:#0041D9;text-decoration:none;}
    </style>

    <style>
        body,
        html,
        #container {
        overflow: hidden;
        width: 100%;
        height: 100%;
        margin: 0;
        font-family: "微软雅黑";
        }
        .container {
            width: 90%;
            margin: 10% auto 0;
            background-color: #f0f0f0;
            padding: 2% 5%;
            border-radius: 10px
        }
        ul {
            padding-left: 20px;
        }

            ul li {
                line-height: 2.3
            }
        a {
            color: #20a53a
        }
        
    </style>
    <style>
        label, input { display:block; }
        input.text { margin-bottom:12px; width:95%; padding: .4em; }
        fieldset { padding:0; border:0; margin-top:25px; }
        h1 { font-size: 1.2em; margin: .6em 0; }
        div#users-contain { width: 350px; margin: 20px 0; }
        div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
        div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
        .ui-dialog .ui-state-error { padding: .3em; }
        .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>

</head>
<body>
 
 <div class="container">

 <div id="users-contain" class="ui-widget">
  <h1>登录上报信息:</h1>
  
  <form method="POST" >
    <fieldset>
      <label for="email">手机</label>
      <input type="text" name="mobile" id="mobile" value="" placeholder="手机号" class="text ui-widget-content ui-corner-all" style="width: 60%;">
      <label for="password">密码</label>
      <input type="password" name="password" id="password" value="" placeholder="密码" class="text ui-widget-content ui-corner-all" style="width: 60%;">
      <!-- Allow form submission with keyboard without duplicating the dialog button -->
      <input type="submit" value="登录">
    </fieldset>
  </form>

</div>

 </div>


</body>
</html>

<script>
  $( function() {
    var dialog, form,
 
      // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
      mobile = $( "#mobile" ),
      password = $( "#password" ),
      allFields = $( [] ).add( mobile ).add( password ),
      tips = $( ".validateTips" );
   
    function login() {
      var valid = true;
      allFields.removeClass( "ui-state-error" ); 
 
      if ( valid ) {
        $.ajax({type:"POST",url:'/index.php/index/login',data:form.serialize(),success:function(result){
            if(result["result"]==1){
                window.location=result["msg"]
            }else{
                console.log(result);
                alert("验证失败，请重新登录");
            }
        }});
      }
      return valid;
    }
 
    form = $("#users-contain").find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        console.log("login");
        login();
    });


} );
  </script>
