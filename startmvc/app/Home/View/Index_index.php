<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.5, user-scalable=no">
    <script src="/static/js/bootstrap.js"></script>
    <script src="/static/js/jquery.js"></script>
    <script src="/static/js/jquery-ui.js"></script>
    <link href="/static/css/jquery-ui.css" rel="stylesheet">

    <script type="text/javascript" src="https://api.map.baidu.com/api?type=webgl&v=1.0&ak=ap6f2VqoYj5zo1OPbhEuKUC2I5LYgsVR"></script>
	<!-- <script type="text/javascript" src="//api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
	<link rel="stylesheet" href="//api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" /> -->

    <link rel="stylesheet" href="/static/css/bootstrap.css" type="text/css">
    <title>信息上报系统</title>

    
    <script src="/static/js/infobox.js?r=100"></script>
    <style type="text/css">
        .infoBoxContent{font-size:12px;}
        .infoBoxContent .title{background:url(/static/images/title.jpg) no-repeat;height:42px;width:272px;}
        .infoBoxContent .title strong{font-size:14px;line-height:42px;padding:0 10px 0 5px;}
        .infoBoxContent .title .price{color:#FFFF00;}
        .infoBoxContent .list{width:268px;border:solid 1px #4FA5FC;border-top:none;background:#fff;height:120px;}
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
    </div>

    <!-- ui-dialog -->
    <div id="dialog" title="详情">
        <div id="d_txt">.</div>
    </div>

</body>
</html>
<script>
    var map = new BMapGL.Map('container',{
    minZoom: 19,
    maxZoom: 21
}); // 创建Map实例
    map.centerAndZoom(new BMapGL.Point(121.48917, 31.17545), 21); // 初始化地图,设置中心点坐标和地图级别
    map.enableScrollWheelZoom(true); // 开启鼠标滚轮缩放
    map.addEventListener('touchmove', function(e) {
        map.enableDragging();
    });
    //触摸结束始，禁止拖拽
    map.addEventListener("touchend", function(e) {
        map.disableDragging();
    });


//
    var mapPoints = [
        // {x:121.48917,y:31.17645,title:"C",con:"我是C",branch:"老三"},
        // {x:121.48917,y:31.17545,title:"D",con:"我是D",branch:"老四"},
        // {x:121.48917,y:31.17445,title:"E",con:"我是E",branch:"老五"}
    ];
    window.onload=function(){
        jQuery.ajax({url:"/index.php/index/map",success:function(result){
            for(var builds in result){
                var pos=result[builds]["latlng"].split(",");
                var dics={"x":pos[0]*1,"y":pos[1]*1,"title":result[builds]["positive_time"],"con":result[builds]["build_desc"],"branch":result[builds]["build_num"]};
                mapPoints[builds]=dics;
            }
            addlab();

        }});
    }
    
    //var i = 0;


    // 函数 创建多个标注
    function markerFun (points,label,infoWindows,ishealth) {
        var myIcon;
        if(ishealth){
            myIcon=new BMapGL.Icon("/static/images/green.png", new BMapGL.Size(35, 50));
        }else{
            myIcon = new BMapGL.Icon("/static/images/red.png", new BMapGL.Size(35, 50));
        }
        // 创建Marker标注，使用小车图标
        var marker = new BMapGL.Marker(points, {
            icon: myIcon
        });
        map.addOverlay(label);

        map.addOverlay(marker);


        marker.addEventListener("click",function (event) {
            //map.openInfoWindow(infoWindows,points);//参数：窗口、点  根据点击的点出现对应的窗口
            infoWindows.open(marker);
        });
    }

    $( "#dialog" ).dialog({
        autoOpen: false,
        width: 400,
        buttons: [
            {
                text: "Ok",
                click: function() {
                    $( this ).dialog( "close" );
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

    function showMore(build_num){
        console.log("show more"+build_num);
        jQuery.ajax({url:"/index.php/index/more/"+build_num,success:function(result){
            var txt="";
            console.log("finish ajax");
            for( builds in result){

               txt+=result[builds]["description"]+"----" + result[builds]["positive_date"]+"</br>";
            }
            console.log(txt);
            $("#d_txt")[0].innerHTML=txt;
            $( "#dialog" ).dialog('open');
        }});    
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
                width: 350,
                height: 100,
                title: mapPoints[i].title
            };
            var html=["<div class='infoBoxContent'><div class='title'><strong>"+mapPoints[i].branch+"号楼</strong><span class='price'></span></div>",
                    "<div class='list'><ul>"
                    ,"<li><div class='left'><p>"+mapPoints[i].con+"</p></div></br><a class='rmb' href='javascript:showMore("+mapPoints[i].branch+")'>历史记录</a></li>"
                    ,"</ul></div>"
                    ,"</div>"];
            var infoWindows=new BMapGLLib.InfoBox(map,html.join(""),{
                boxStyle:{
                    background:"url('/static/images/tipbox.gif') no-repeat center top",
                    width: "270px",
                    height: "100px"
                }
                ,closeIconMargin: "1px 1px 0 0",
                closeIconUrl: '/static/images/close.png',
                enableAutoPan: true,
                align: INFOBOX_AT_TOP
            });
            //var infoWindows = new BMapGL.InfoWindow(mapPoints[i].con+'</br><div onclick="alert(\'1111\');" href="javascript:showMore('+mapPoints[i].branch+')">More</div>', infoopts);
            var ishealth=mapPoints[i].con=="健康"?true:false;
            markerFun(points, label, infoWindows,ishealth);
        }
    }
    // map.addEventListener("click",function(e){
    //     console.log("x:" + e.point.lng + "," + "y:"+ e.point.lat);
    // });


                
</script>