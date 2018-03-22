<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('homes')}}/img/asset-favicon.ico">
    <title>在线教育网</title>

    <link rel="stylesheet" href="{{asset('homes')}}/plugins/normalize-css/normalize.css" />
    <link rel="stylesheet" href="{{asset('homes')}}/plugins/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="{{asset('homes')}}/css/page-learing-index.css" />
</head>

<body data-spy="scroll" data-target="#myNavbar" data-offset="150">
    <!-- 页面头部 -->
    <!--头部导航-->
    <header>
        <div class=" learingHeader">
            <nav class="navbar container">
                <div class="navbar-left"><img src="{{asset('homes')}}/img/asset-logoIco.png" alt=""></div>
                <div class="navbar-left">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/" target=''>首页</a></li>
                        <li><a href="{{url('person/livecourse')}}">直播</a></li>
                        <li><a href="{{url('/person/paper')}}">职业测评</a></li>
                    </ul>
                </div>
                <div class="navbar-left"><input type="text" class="input-search" placeholder="输入查询关键词"><input type="submit" class="search-buttom"></div>
                <div class="navbar-right"><a href="/login">登录</a><a href="/register">注册</a></div>
            </nav>
        </div>
    </header>
    <!--banner区-->
    <div class="travel-index-imgroll">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="{{asset('homes')}}/img/widget-bannerA.jpg" alt="AA">
                </div>
                <div class="item">
                    <img src="{{asset('homes')}}/img/widget-bannerB.jpg" alt="">
                </div>
            </div>
            <!--<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">-->
            <!--<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
            <!--<span class="sr-only">Previous</span>-->
            <!--</a>-->
            <!--<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">-->
            <!--<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>-->
            <!--<span class="sr-only">Next</span>-->
            <!--</a>-->
        </div>
    </div>
    <div class="container">
        <!--左侧列表导航-->
        <div class="travel-index-nav" style="height: 400px">
            <div class="citylistbox">
                <div class="title text-center">全部分类课程</div>
                @foreach($course as $v)
                <div class="listbox">
                    <div class="list">
                        <dl><dt>{{$v->course_name}}</dt></dl>
                    </div>
                    <div class="box">
                        @foreach($v->lesson as $vv)
                            {{$vv->lesson_name}}<br>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="recommend-list">
            <div class="btn-group btn-group-justified">
                <a href="#" class="btn btn-primary">北京大学</a>
                <a href="#" class="btn btn-primary">清华大学</a>
                <a href="#" class="btn btn-primary">厦门大学</a>
                <a href="#" class="btn btn-primary">复旦大学</a>
                <a href="#" class="btn btn-primary">武汉大学</a>
                <a href="#" class="btn btn-primary">中央财经大学</a>
                <a href="#" class="btn btn-primary">西安电子科技大学</a>
                <a href="#" class="btn btn-primary">哈尔滨工业大学</a>
            </div>
        </div>
        <div class="conten-list">
            @foreach($course as $v)
            <div class="conten" id="{{$v->id}}">
                <div class="row text-center top">
                    <div class="col-lg-3 text-left" id="Title">{{$v->course_name}}</div>
                    <div class="col-lg-5 ">
                        <div class="btn-group btn-group-justified">
                            <a href="#" class="btn btn-primary active">热 门</a>
                            <a href="#" class="btn btn-primary">初 级</a>
                            <a href="#" class="btn btn-primary">中 级</a>
                            <a href="#" class="btn btn-primary">高 级</a>
                        </div>
                    </div>
                    <div class="col-lg-3 text-right"><a href="{{url('course/detail/'.$v->id)}}" class="btn btn-default ck-all">查看全部</a></div>
                </div>
                <div class="container cont-list">
                    <div class="cont-list-roll">
                        <div class="next glyphicon glyphicon-chevron-right"></div>
                        <div class="prev glyphicon glyphicon-chevron-left"></div>
                        <div class="cont-list-box">
                        @foreach($v->lesson as $vv)
                                <a href="{{ url('home/live/detail') . '?id='.$vv->id }}" target="_blank">
                                    <li class="">
                                        <img src="{{$vv->cover_img}}" alt="AA">
                                        <div class="tit">{{$vv->lesson_name}} <span>高</span></div>
                                    </li>
                                </a>
                        @endforeach

                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>
    <div class="index-cont-nav">
        <div id="myNavbar" class="collapse navbar-collapse ">
            <div id="myCollapse" class="collapse navbar-collapse">
                <div class="logo-ico"><img src="{{asset('homes')}}/img/asset-logoIco.png" alt=""></div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#a">编程入门</a></li>
                    @foreach($course as $v)
                        <li class="active"><a href="#{{ $v->id }}">{{ $v->course_name }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    </div>
    <div class="container">
        <div class="index-bot-video text-center">
            <div class="tit">运作方式</div>
            <div class="row">
                <div class="col-lg-6 text-left">
                    <div class="cont">
                        <p class="tit glyphicon glyphicon-hand-right"> 课程作业</p>
                        <p>每门课程都像是一本互动的教科书，具有预先录制的视频、测验和项目。</p>
                    </div>
                    <div>
                        <p class="tit glyphicon glyphicon-hand-right"> 证书</p>
                        <p>获得正式认证的作业，并与朋友、同事和家人分享您的成功。</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{asset('homes')}}/img/widget-video.jpg" width="500" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- 页面底部 -->
    <div class="gotop">
        <a href="#"><i class="glyphicon glyphicon-pencil"></i><span class="hide">问题反馈</span></a>
        <a href="#top"><i class="glyphicon glyphicon-plane"></i><span class="hide">返回顶部</span></a>
    </div>
    <!--底部版权-->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div>
                        <!--<h1 style="display: inline-block">学成网</h1>--><img src="{{asset('homes')}}/img/asset-logoIco.png" alt=""></div>
                    <div>学成网致力于普及中国最好的教育它与中国一流大学和机构合作提供在线课程。</div>
                    <div>© 2017年XTCG Inc.保留所有权利。-沪ICP备15025210号</div>
                    <input type="button" class="btn btn-primary" value="下 载" />
                </div>
                <div class="col-lg-5 row">
                    <dl class="col-lg-4">
                        <dt>关于学成网</dt>
                        <dd>关于</dd>
                        <dd>管理团队</dd>
                        <dd>工作机会</dd>
                        <dd>客户服务</dd>
                        <dd>帮助</dd>
                    </dl>
                    <dl class="col-lg-4">
                        <dt>新手指南</dt>
                        <dd>如何注册</dd>
                        <dd>如何选课</dd>
                        <dd>如何拿到毕业证</dd>
                        <dd>学分是什么</dd>
                        <dd>考试未通过怎么办</dd>
                    </dl>
                    <dl class="col-lg-4">
                        <dt>合作伙伴</dt>
                        <dd>合作机构</dd>
                        <dd>合作导师</dd>
                    </dl>
                </div>
            </div>
        </div>
    </footer>

    <!-- 页面 css js -->

    <script type="text/javascript" src="{{asset('homes')}}/plugins/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="{{asset('homes')}}/plugins/bootstrap/dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="{{asset('homes')}}/js/widget-travel-index-nav.js"></script>
    <script>
        $('.cont-list-roll').hover(function() {
            $(this).find('.next,.prev').show();
        }, function() {
            $(this).find('.next,.prev').hide();
        });



        $('.gotop a').hover(function() {
            $(this).find('span').removeClass('hide')
        }, function() {
            $(this).find('span').addClass('hide')
        })
    </script>
    <script src="{{asset('homes')}}/js/page-learing-index.js"></script>
</body>