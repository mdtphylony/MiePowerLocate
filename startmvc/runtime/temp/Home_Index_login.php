<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <script src="/static/js/bootstrap.js"></script>
    <script src="/static/js/jquery.js"></script>
    <script src="/static/js/jquery-ui.js"></script>
    <link href="/static/css/jquery-ui.css" rel="stylesheet">
    <script src="http://api.map.baidu.com/api?type=webgl&v=1.0&ak=ap6f2VqoYj5zo1OPbhEuKUC2I5LYgsVR"></script>
    <link rel="stylesheet" href="/static/css/bootstrap.css" type="text/css">
    <title>信息上报系统-登录</title>
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
            width: 60%;
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
      <input type="text" name="mobile" id="mobile" value="" placeholder="手机号" class="text ui-widget-content ui-corner-all">
      <label for="password">密码</label>
      <input type="password" name="password" id="password" value="" placeholder="密码" class="text ui-widget-content ui-corner-all">
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
