<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.5, user-scalable=no">

    <script src="/static/js/jquery.js"></script>
    <script src="/static/js/jquery-ui.js"></script>
    <link href="/static/css/jquery-ui.css" rel="stylesheet">
    <script src="http://api.map.baidu.com/api?type=webgl&v=1.0&ak=ap6f2VqoYj5zo1OPbhEuKUC2I5LYgsVR"></script>
    <link rel="stylesheet" href="/static/css/bootstrap.css" type="text/css">
    <script src="/static/js/bootstrap.js"></script>

    <title>信息上报系统-录入</title>

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


 <div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="tabbable" id="tabs-774304">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active show" href="#tab1" id="ctab1" data-toggle="tab">楼宇</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="ctab2" href="#tab2" data-toggle="tab">解封日期</a>
					</li>
                    <li class="nav-item">
						<a class="nav-link" id="ctab3" href="#tab3" data-toggle="tab">新闻</a>
					</li>

				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">

                        <div id="users-contain" class="ui-widget">
                            <h1>信息录入:</h1>
                            
                            <form method="POST" >
                                <fieldset>
                                <label for="build">楼号</label>
                                <input type="text" name="build_num" id="build_num" value="" placeholder="楼号" class="text ui-widget-content ui-corner-all" style="width: 60%;">
                                <label for="location">定位</label>
                                <input type="text" name="location" id="location" value="" placeholder="定位" class="text ui-widget-content ui-corner-all" style="width: 60%;">
                                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                                <input type="submit" value="录入">
                                </fieldset>
                            </form>

                        </div>					
                    </div>

					<div class="tab-pane" id="tab2">
                        <div id="users-contain1" class="ui-widget">
                            <h1>解封日期:</h1>
                            
                            <form method="POST" >
                                <fieldset>
                                <label for="build">楼号</label>
                                <input type="text" name="build_num" id="build_num" value="1" placeholder="楼号" class="text ui-widget-content ui-corner-all" style="width: 60%;">
                                <label for="location">日期</label>
                                <input type="text" name="release_date" id="release_date" value="" placeholder="日期" class="text ui-widget-content ui-corner-all" style="width: 60%;">
                                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                                <input type="submit" value="录入">
                                </fieldset>
                            </form>

                        </div>
					</div>

                    <div class="tab-pane" id="tab3">
                        <div id="users-contain2" class="ui-widget">
                            <h1>新闻录入:</h1>
                            
                            <form method="POST" >
                                <fieldset>
                                <label for="build">弄堂号</label>
                                <input type="text" name="road_num" id="road_num" value="44" placeholder="弄堂号" class="text ui-widget-content ui-corner-all" style="width: 60%;">
                                <label for="location">楼号</label>
                                <input type="text" name="build_num" id="build_num" value="1" placeholder="楼号" class="text ui-widget-content ui-corner-all" style="width: 60%;">
                                <label for="location">信息描述</label>
                                <input type="text" name="build_desc" id="build_desc" value="无新增" placeholder="信息描述" class="text ui-widget-content ui-corner-all" style="width: 60%;">
                                <label for="location">咩宝状态</label>
                                <input type="text" name="mie_status" id="mie_status" value="病人已转运" placeholder="咩宝状态" class="text ui-widget-content ui-corner-all" style="width: 60%;">
                                <label for="location">楼栋状态</label>
                                <input type="text" name="build_status" id="build_status" value="楼栋封控中" placeholder="楼栋状态" class="text ui-widget-content ui-corner-all" style="width: 60%;">
                                <label for="location">日期</label>
                                <input type="text" name="build_date" id="build_date" value="" placeholder="日期" class="text ui-widget-content ui-corner-all" style="width: 60%;">

                                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                                <input type="submit" value="录入">
                                </fieldset>
                            </form>
                            <h1>今日新闻:</h1>

                        </div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>



    

 </div>

 <div class="toast" id="toast" style="display:none">
    <div class="toast-header">
        提交成功
    </div>
    <div class="toast-body">
        完成！
    </div>
</div>


</body>
</html>

<script>


( function( factory ) {
        "use strict";

        if ( typeof define === "function" && define.amd ) {

            // AMD. Register as an anonymous module.
            define( [ "../widgets/datepicker" ], factory );
        } else {

            // Browser globals
            factory( jQuery.datepicker );
        }
    } )
    ( function( datepicker ) {
        "use strict";
        datepicker.regional[ "zh" ] = {
            closeText: "關閉",
            prevText: "&#x3C;上個月",
            nextText: "下個月&#x3E;",
            currentText: "今天",
            monthNames: [ "一月", "二月", "三月", "四月", "五月", "六月",
            "七月", "八月", "九月", "十月", "十一月", "十二月" ],
            monthNamesShort: [ "一月", "二月", "三月", "四月", "五月", "六月",
            "七月", "八月", "九月", "十月", "十一月", "十二月" ],
            dayNames: [ "星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六" ],
            dayNamesShort: [ "週日", "週一", "週二", "週三", "週四", "週五", "週六" ],
            dayNamesMin: [ "日", "一", "二", "三", "四", "五", "六" ],
            weekHeader: "週",
            dateFormat: "yy/mm/dd",
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: true,
            yearSuffix: "年" };
        datepicker.setDefaults( datepicker.regional[ "zh" ] );

        return datepicker.regional[ "zh" ];

    } );

</script>

<script>
    $( function() {
        $.datepicker.regional[ "zh" ];
        $( "#release_date" ).datepicker();
    } );

    function getTime() {
        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var dates = date.getDate();
        month = month < 10 ? '0' + month : month; 
        dates = dates < 10 ? '0' + dates : dates;
        return year + '/' + month + '/' + dates;
    }

    window.onload=function(){
        $("#build_date").attr("value",getTime());

        //$("#build_date").datepicker().datepicker("setDate",new Date());

    };

    $( function() {
        var dialog, form,form1,form2,
    
        // From http://www.whatwg.org/specs/web-apps/current-work/multipage/states-of-the-type-attribute.html#e-mail-state-%28type=email%29
        build_num = $( "#build_num" ),
        location = $( "#location" ),
        allFields = $( [] ).add( build_num ).add( location ),
        tips = $( ".validateTips" );
    
        function builds() {
            var valid = true;
            allFields.removeClass( "ui-state-error" ); 
                
            if ( valid ) {
                $.ajax({type:"POST",url:'/index.php/index/build',data:form.serialize(),success:function(result){

                    if(result["result"]==1){
                        window.location=result["msg"]
                        alert("提交完成");
                    }else{
                        console.log(result);
                        alert("验证失败，请重新登录");
                    }
                }});
            }
            return valid;
        }

        function release() {
            var valid = true;
            allFields.removeClass( "ui-state-error" ); 
                
            if ( valid ) {
                $.ajax({type:"POST",url:'/index.php/index/release',data:form1.serialize(),success:function(result){

                    if(result["result"]==1){
                        
                        window.location=result["msg"]
                        alert("提交完成");
                    }else{
                        console.log(result);
                        alert("验证失败，请重新登录");
                    }
                }});
            }
            return valid;
        }

        function news() {
            var valid = true;
            allFields.removeClass( "ui-state-error" ); 
                
            if ( valid ) {
                $.ajax({type:"POST",url:'/index.php/index/news',data:form2.serialize(),success:function(result){

                    if(result["result"]==1){
                        window.location=result["msg"]
                        alert("提交完成");
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
            
            builds();
        });
        form1 = $("#users-contain1").find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            console.log("login");
            
            release();
        });
        form2 = $("#users-contain2").find( "form" ).on( "submit", function( event ) {
            event.preventDefault();
            console.log("login");
            
            news();
        });


    } );
</script>


<script>
        (function(){
            function removeStatus(){
                $("#tab1").removeClass("active");
                $("#tab2").removeClass("active");
                $("#tab3").removeClass("active");
                $("#ctab1").removeClass("active show");
                $("#ctab2").removeClass("active show");
                $("#ctab3").removeClass("active show");
            }
            $("#ctab1").click(function(){
                removeStatus();
                $("#tab1").addClass("active");
                $("#ctab1").addClass("active show");
            });
            $("#ctab2").click(function(){
                removeStatus();
                $("#ctab2").addClass("active show");
                $("#tab2").addClass("active");
                
                $("#release_date").datepicker().datepicker("setDate",new Date());

            });
            $("#ctab3").click(function(){
                removeStatus();
                $("#ctab3").addClass("active show");
                $("#tab3").addClass("active");
                //$("#datepicker").datepicker().datepicker("setDate",new Date());

            });


        })();
    </script>