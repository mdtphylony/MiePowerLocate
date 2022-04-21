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
    <title>信息上报系统</title>
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
</head>
<body>
    <div id="container">
    <form method="POST" action="/index/edit1">
        <fieldset>
        <label for="email">楼栋号</label>
        <input type="text" name="build_num" id="build_num" value="1" class="text ui-widget-content ui-corner-all">&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="Date">日期</label>
        <input type="text" name="date" id="datepicker" value="" class="text ui-widget-content ui-corner-all">
        </br>
        </br>
        <label for="Desc">描述</label></br>
        <textarea id="desc" name="desc" rows="5" style="width: 90%;">健康</textarea>
        </br>
        <!-- Allow form submission with keyboard without duplicating the dialog button -->
        <input type="submit" value="录入">
        </fieldset>
    </form>

    </div>

    <!-- ui-dialog -->
    <div id="dialog" title="详情">

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

//     var map = new BMapGL.Map('container',{
//     minZoom: 19,
//     maxZoom: 21
//     }); // 创建Map实例
//     map.centerAndZoom(new BMapGL.Point(121.48917, 31.17545), 21); // 初始化地图,设置中心点坐标和地图级别
//     map.enableScrollWheelZoom(true); // 开启鼠标滚轮缩放
// //
//     var mapPoints = [];
//     window.onload=function(){
//         jQuery.ajax({url:"/index/map",success:function(result){
//             for(var builds in result){
//                 var pos=result[builds]["latlng"].split(",");
//                 var dics={"x":pos[0]*1,"y":pos[1]*1,"title":result[builds]["positive_time"],"con":result[builds]["build_desc"],"branch":result[builds]["build_num"]};
//                 mapPoints[builds]=dics;
//             }
//             addlab();

//         }});
//     }
    
    //var i = 0;
    $( function() {
        $.datepicker.regional[ "zh" ];
        $( "#datepicker" ).datepicker();
    } );

    $( "#dialog" ).dialog({
        autoOpen: false,
        width: 600,
        buttons: [
            {
                text: "Ok",
                click: function() {
                    $( this ).dialog( "close" );
                    $.ajax({type:"post",url:"/index/edit",data:$("dialog").find("form").serialize(),success:function(result){
                        console.log(result);
                    }});
                }
            },
            {
                text: "Cancel",
                click: function() {
                    $( this ).dialog( "close" );
                }
            }
        ]
    });

    function getTime() {
        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var dates = date.getDate();
        month = month < 10 ? '0' + month : month; 
        dates = dates < 10 ? '0' + dates : dates;
        return year + '/' + month + '/' + dates;
    }

    function showMore(build_num){
        jQuery.ajax({url:"/index/info/"+build_num,success:function(result){
            console.log("output"+result+getTime());
            $("#datepicker").datepicker().datepicker("setDate",new Date());
            console.log(result);
            $("#build_num").attr("value",build_num);
            for(var builds in result){
                console.log("op:",result[builds]["build_desc"]);
                $("#desc").val(result[builds]["build_desc"]);
            }
            $( "#dialog" ).dialog('open');
        }});    
    }

        // 函数 创建多个标注
    function markerFun (points,label,infoWindows,ishealth) {

        var myIcon = new BMapGL.Icon("/static/images/red.png", new BMapGL.Size(35, 60));
        if(ishealth){
            myIcon=new BMapGL.Icon("/static/images/green.png", new BMapGL.Size(35, 60));
        }
        // 创建Marker标注，使用小车图标
        var marker = new BMapGL.Marker(points, {
            icon: myIcon
        });
        map.addOverlay(label);

        map.addOverlay(marker);

        marker.addEventListener("click",function (event) {
            map.openInfoWindow(infoWindows,points);//参数：窗口、点  根据点击的点出现对应的窗口

        });
    }


    function addlab () {
        console.log(mapPoints);
        for (var i=0; i < mapPoints.length; i++) {
            var points = new BMapGL.Point(mapPoints[i].x, mapPoints[i].y);//创建坐标点
            var opts = {
                position: points,    // 指定文本标注所在的地理位置
                offset: new BMapGL.Size(0, -25),    //设置文本偏移量
            }
            var label = new BMapGL.Label(mapPoints[i].branch, opts);  // 创建文本标注对象
            label.setStyle({
                transform: 'translateX(-50%)',
                color: "rad",
                backgroundColor: 'transparent',//文本背景色
                borderColor: 'transparent',//文本框边框色
                fontSize: "14px",
                height: "30px",
                lineHeight: "30px",
                fontFamily: "微软雅黑"
            });
            var infoopts = {
                width: 250,
                height: 100,
                title: mapPoints[i].title
            };

            var infoWindows = new BMapGL.InfoWindow(mapPoints[i].con+'</br><a href="javascript:showMore('+mapPoints[i].branch+')">录入新数据</a>', infoopts);
            var ishealth=mapPoints[i].con=="健康"?true:false;
            markerFun(points, label, infoWindows,ishealth);
        }
    }
    map.addEventListener("click",function(e){
        console.log("x:" + e.point.lng + "," + "y:"+ e.point.lat);
    });


                
</script>