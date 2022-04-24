<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.5, user-scalable=no">
    <script src="/static/js/jquery.js?rnd=100"></script>
    <script src="/static/js/jquery-ui.js?rnd=100"></script>
    <link href="/static/css/jquery-ui.css?rnd=100" rel="stylesheet">

	<link rel="stylesheet" href="/static/css/style.css?rnd=100"> 

    <script type="text/javascript" src="https://api.map.baidu.com/api?type=webgl&v=1.0&ak=ap6f2VqoYj5zo1OPbhEuKUC2I5LYgsVR"></script>
	<!-- <script type="text/javascript" src="//api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
	<link rel="stylesheet" href="//api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" /> -->

    <link rel="stylesheet" href="/static/css/bootstrap.css?rnd=100" type="text/css">
    <script src="/static/js/bootstrap.js?rnd=100"></script>

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
        position:absolute;
        left: 0px;
        top: 0px;
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

        .example{
            font-size: 1.2em;
            font-family: Helvetica Neue,Helvetica,PingFang SC,Hiragino Sans GB,Microsoft YaHei,Noto Sans CJK SC,WenQuanYi Micro Hei,Arial,sans-serif;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            width: 98%;
            color: #000;
            background-color: #e5eecc;
            margin: 0 0 5px 0;
            padding: 5px;
            border: 1px solid #d4d4d4;
            background-image: linear-gradient(#ebb64c,#e5eecc 100px);
        }

        .example_head{
            font-family: Helvetica Neue,Helvetica,PingFang SC,Hiragino Sans GB,Microsoft YaHei,Noto Sans CJK SC,WenQuanYi Micro Hei,Arial,sans-serif;
        -webkit-font-smoothing: antialiased;
        -webkit-text-size-adjust: none;
        border: 0;
        padding: 0;
        margin: 2px 0;
        text-align: center;
        line-height: 1.8em;
        color: #000;
        background-color: transparent;
        margin-top: 0;
        font-size: 1.7em;
        }

        .example_code{
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            color: #000;
            margin: 0;
            line-height: 1.4em;
            background-color: #fff;
            padding: 5px;
            border: 1px solid #d4d4d4;
            font-size: 110%;
            font-family: Menlo,Monaco,Consolas,"Andale Mono","lucida console","Courier New",monospace;
            word-break: break-all;
            word-wrap: break-word;
            width: 96%;
        }
        .tryitbtn{
            font-family: Helvetica Neue,Helvetica,PingFang SC,Hiragino Sans GB,Microsoft YaHei,Noto Sans CJK SC,WenQuanYi Micro Hei,Arial,sans-serif;
            -webkit-font-smoothing: antialiased;
            -webkit-text-size-adjust: none;
            border: 0;
            margin: 0;
            -webkit-transition-duration: .2s;
            -webkit-transition-property: opacity;
            outline: none;
            display: inline-block;
            color: #FFF;
            background-color: #8ca86d;
            font-weight: bold;
            font-size: 13px;
            text-align: center;
            padding-left: 10px;
            padding-right: 10px;
            padding-top: 4px;
            padding-bottom: 4px;
            text-decoration: none;
            margin-left: 5px;
            margin-top: 0;
            margin-bottom: 5px;
            border-radius: 2px;
            white-space: nowrap;
        }
        #bg_img{
            background:url(/static/images/title_bg.png) no-repeat;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        
    </style>
</head>
<body>
    <div id="container">
    </div>

    <header class="cd-main-content" style="z-index:999;">
		<a href="#0" class="cd-btn js-cd-panel-trigger" data-panel="main">更多</a>
        <a href="/index.php/index/edit" class="cd-btn">编辑</a>
        <a href="/index.php/index/build" class="cd-btn">日报</a>
		<!-- your content here -->
	</header>


    <!-- ui-dialog -->
    <div id="dialog" title="详情">
        <div id="d_txt">.</div>
    </div>


	<div class="cd-panel cd-panel--from-right js-cd-panel-main" style="z-index: 1000;">
		<div class="cd-panel__header">
			<h1>济中新村-日报</h1>
			<a href="#0" class="cd-panel__close js-cd-close">Close</a>
        </div>

		<div class="cd-panel__container">
			<div class="cd-panel__content">


                <div  style=" text-align:center;margin: auto;">
                    <div id="bg" style="position: relative; text-align:center">
                        <img src="/static/images/title_bg.png" style="width: 240px;">
                        <div style="position:absolute; top:6px; width:100%; font-size:24px" id="date_txt"></div>
                        </br>
                    </div>
                    </br>
                    </br>

                    <img src="/static/images/news.png" style="width: 175px; text-align:center;margin: auto;">
                </div>
                <div id="news">

                    {foreach $data as $v}                    
                        <div class="container-fluid">
                            <div class="row" style="border-color: #000; border: size 1px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div>
                                            <table class="table" style="table-layout: fixed;">
                                                <tbody>
                                                    <tr>
                                                        <td width="105px">
                                                            <ul class="nav nav-pills">
                                                                <li class="nav-item">
                                                                    <div class="nav-link btn btn-primary" style="font-size:20px;">{$v['road_num']}弄 <br/><span class="badge badge-light" style="font-size:18px;">{$v['build_num']}#</span></div>
                                                                </li>
                                                                
                                                            </ul>
                                                        </td>
                                                        <td valign="middle" style="word-wrap:break-word;word-break:break-all; text-align:center;margin: aut; vertical-align:middle">
                                                            <div style="text-align:center;margin: auto; font-size:14px; border:#000 1px line">{$v['build_desc']}</div>
                                                        </td>
                                                        <td width="80px" valign="middle">
                                                            </br>
                                                            <lable class="badge badge-success" width="60px" style="width:80px;height:20px;font-size: 12px; margin-top:4px;">{$v['mie_status']}</lable></br>
                                                            <label class="badge badge-danger"width="60px" style="width: 80px;height:20px;font-size: 12px; margin-top:4px;">{$v['build_status']}</label>
                                                        </td>
                                                    </tr>
                
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    {/foreach}
                    
                </div>
                

                <div  style=" text-align:center;margin: auto; position:relative">
                    </br>
                    <div style="z-index:999;"><img src="/static/images/attention.png" style="width: 175px; text-align:center;margin: auto;z-index:999"></div>
                    <div id="" style="width:90%;margin-left:5%;position:relative;top:-20px; text-align:center;border: #F0BB4A solid 4px;z-index:-1">
                    <br/>
                        <ul  style="list-style:none;">
                        <li  class="nav-item" style="text-align: left; padding:5px;font-size:12px;">①阳性病人未转运时不恐慌，自觉做到不开门不开窗，上下疏通管道及时消毒和堵漏，居民严格遵守足不出户原则；</li>
                        <li  class="nav-item" style="text-align: left; padding:5px;font-size:12px;">②核酸最好上门做，如需要下楼，一定要有秩序，分楼层，一层做完再下一层；</li>
                        <li  class="nav-item" style="text-align: left; padding:5px;font-size:12px;">③每日每层楼最好自行消杀；门把手等人接触最多的地方每日消杀；</li>
                        <li  class="nav-item" style="text-align: center; padding:5px;font-size:12px;">封控楼需要信息透明，互相理解、配合，团结一致；</li>

                        </ul>

                        <div style="border:#F0BB4A solid 4px;background-color:#F0BB4A;">
                            <ul  style="list-style:none;background-color:#F0BB4A; padding-bottom:0px">
                            <li  class="nav-item" style="text-align: center; font-size:12px;color:white">居委正在全力转运阳性病人</li>
                            <li  class="nav-item" style="text-align: center; font-size:12px;color:white">多份理解，少份抱怨</li>
                            <li  class="nav-item" style="text-align: center; font-size:12px;color:white">我们一同努力 早日解封</li>
                            </ul>
                        </div>

                    </div>

                </div>



                <div  style=" text-align:center;margin: auto;">
                    <img src="/static/images/release.png" style="width: 175px; text-align:center;margin: auto;">
                </div>

                <div  style=" text-align:center;margin: auto;">
                    <br>
                    <div style="width:70%;height:120px; margin-left:15%; background-color:#fff; border-radius:15px">      
                        <h1 style="text-align:center;padding-top:15px" size="1" _root="[object Object]" __ownerID="undefined" __hash="undefined" __altered="false"><span style="letter-spacing:1px"><span style="font-size:76px">{$month}</span>月<span style="font-size:76px">{$day}</span>日</span></h1>
                    </div>

                    <br>
                    <br>
                    <img src="/static/images/footer.png" style="width: 100%; text-align:center;margin: auto;">

                </div>

            </div>



            </div> <!-- cd-panel__content -->
		</div> <!-- cd-panel__container -->
	</div> <!-- cd-panel --></body>
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

    //map.disableDragging();

    function getTime() {
        var date = new Date();
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var dates = date.getDate();
        month = month < 10 ? '0' + month : month; 
        dates = dates < 10 ? '0' + dates : dates;
        return year + '/' + month + '/' + dates;
    }
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

        $("#date_txt")[0].innerHTML=getTime();
    }
    
    //var i = 0;


    // 函数 创建多个标注
    function markerFun (points,label,infoWindows,ishealth) {
        var myIcon;
        if(ishealth==1){
            myIcon=new BMapGL.Icon("/static/images/green.png", new BMapGL.Size(35, 50));
        }else if(ishealth==-1){
            myIcon = new BMapGL.Icon("/static/images/red.png", new BMapGL.Size(35, 50));
        }else if(ishealth==-2){
            myIcon = new BMapGL.Icon("/static/images/yellow.png", new BMapGL.Size(35, 50));
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
            var ishealth=mapPoints[i].con=="健康"?1:-1;
            ishealth=mapPoints[i].con.search("异常")!=-1?-2:ishealth;
            console.log(ishealth);
            markerFun(points, label, infoWindows,ishealth);
        }
    }
    // map.addEventListener("click",function(e){
    //     console.log("x:" + e.point.lng + "," + "y:"+ e.point.lat);
    // });


                
</script>
<!--Panel Script-->
<script>
        (function(){
            // Slide In Panel - by CodyHouse.co
            var panelTriggers = document.getElementsByClassName('js-cd-panel-trigger');
            if( panelTriggers.length > 0 ) {
                for(var i = 0; i < panelTriggers.length; i++) {
                    (function(i){
                        var panelClass = 'js-cd-panel-'+panelTriggers[i].getAttribute('data-panel'),
                            panel = document.getElementsByClassName(panelClass)[0];
                        // open panel when clicking on trigger btn
                        panelTriggers[i].addEventListener('click', function(event){
                            event.preventDefault();
                            addClass(panel, 'cd-panel--is-visible');
                        });
                        //close panel when clicking on 'x' or outside the panel
                        panel.addEventListener('click', function(event){
                            if( hasClass(event.target, 'js-cd-close') || hasClass(event.target, panelClass)) {
                                event.preventDefault();
                                removeClass(panel, 'cd-panel--is-visible');
                            }
                        });
                    })(i);
                }
            }
            
            //class manipulations - needed if classList is not supported
            //https://jaketrent.com/post/addremove-classes-raw-javascript/
            function hasClass(el, className) {
                if (el.classList) return el.classList.contains(className);
                else return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
            }
            function addClass(el, className) {
                if (el.classList) el.classList.add(className);
                else if (!hasClass(el, className)) el.className += " " + className;
            }
            function removeClass(el, className) {
                if (el.classList) el.classList.remove(className);
                else if (hasClass(el, className)) {
                    var reg = new RegExp('(\\s|^)' + className + '(\\s|$)');
                    el.className=el.className.replace(reg, ' ');
                }
            }
        })();
    </script>