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
    <link rel="stylesheet" href="{{asset('homes')}}/css/page-learing-personal.css" />
    <link rel="stylesheet" href="{{asset('homes')}}/css/page-learing-course-score.css" />
</head>

<body>
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
                <div class="navbar-right"><a href="/login">登录</a><a href="#">注册</a></div>
            </nav>
        </div>
    </header>
    <div class="personal-header" style="background-image: url({{asset('homes')}}/img/asset-temp1.jpg);">
        <div class="personal-info">
            <p>
                <h1>吴雪</h1>
            </p>
            <p>Web前端工程师 学习时长 48小时35分</p>
        </div>
    </div>
    <!-- 页面 -->
    <div class="container" style="background: #fff;">
        <div class="personal-nav pull-left">
            <div class="nav nav-stacked text-left">
                <div class="my-ico"><img src="{{asset('homes')}}/img/asset-myimg.jpg" alt=""></div>
                <div class="item">
                    <li class="active"><a href="" class="glyphicon glyphicon-tower"> 我的考试<i class="pull-right">></i></a></li>
                    <li><a href="" class="glyphicon glyphicon-list-alt"> 全部课程<i class="pull-right">></i></a> </li>
                    <li><a href="" class="glyphicon glyphicon-cog"> 设置<i class="pull-right">></i></a></li>
                    <li><a href="" class="glyphicon glyphicon-log-out"> 退出<i class="pull-right">></i></a></li>
                </div>
            </div>
        </div>
        <div class="personal-content pull-right">
            <div class="course-score-cont">
                <div class="title text-center">
                    <h3>程序设计语言成绩单</h3>
                </div>
                <div class="score-info">
                    <span class="more pull-right">考试成绩计算方法?</span>
                </div>
                <div>
                    <table class="table text-center">
                        <tr>
                            <td>名称</td>
                            <td>分数（满分100）</td>
                            <td>操作</td>
                        </tr>
                        @foreach($paper as $v)
                        <tr>
                            <td>{{$v->paper_name}}</td>
                            <td>{{$v->paper_score}}</td>
                            <td><a href="{{url('person/exam/'.$v->id)}}">开始考试</a></td>
                        </tr>
                       @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- 页面 css js -->
    <script type="text/javascript" src="{{asset('homes')}}/plugins/jquery/dist/jquery.js"></script>
    <script type="text/javascript" src="{{asset('homes')}}/plugins/bootstrap/dist/js/bootstrap.js"></script>
    <script>
        $(function() {
            $(window).scroll(function() {
                console.log($(this)[0].scrollY);
                if ($(this)[0].scrollY > 155) {
                    console.log(1);
                    $('.personal-nav').css({
                        'position': 'fixed',
                        'top': 10
                    });
                    $('.personal-nav img').css({
                        'width': '140',
                        'height': '140'
                    });
                } else if ($(this)[0].scrollY <= 155) {
                    console.log(2)
                    $('.personal-nav').css({
                        'position': 'relative',
                        'top': -160
                    });
                    $('.personal-nav img').css({
                        'width': '180',
                        'height': '180'
                    });
                };
            })
        })
    </script>
     <!--底部-->
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
</body>
</html>