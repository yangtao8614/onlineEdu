<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="{{asset('admins')}}/lib/html5shiv.js"></script>
    <script type="text/javascript" src="{{asset('admins')}}/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('admins')}}/lib/Hui-iconfont/1.0.8/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/skin/default/skin.css"
          id="skin"/>
    <link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/style.css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="{{asset('admins')}}/lib/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>用户管理</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span
            class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r"
                                                  style="line-height:1.6em;margin-top:3px"
                                                  href="javascript:location.replace(location.href);" title="刷新"><i
                class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c"> 日期范围：
        <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin"
               class="input-text Wdate" style="width:120px;">
        -
        <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax"
               class="input-text Wdate" style="width:120px;">
        <input type="text" class="input-text" style="width:250px" placeholder="输入专业名称" id="title" name="">
        <button type="submit" class="btn btn-success radius" id="searchTitle" name=""><i
                    class="Hui-iconfont">&#xe665;</i> 搜专业
        </button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"><span class="l"><a href="javascript:;" onclick="datadel()"
                                                               class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a
                    href="javascript:;" onclick="lesson_add()" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加专业</a></span>
        <span class="r">共有数据：<strong>{{count($profession)}}</strong> 条</span></div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-hover table-bg table-sort" style="text-align: center">
            <thead>
            <tr class="text-c">
                <th width="25"><input type="checkbox" name="" value=""></th>
                <th width="40">ID</th>
                <th width="120">专业名称</th>
                <th width="120">缩略图</th>
                <th width="130">专业描述</th>
                <th width="100">操作</th>
            </tr>
            </thead>
            <tbody style="text-align: center">
            @foreach($profession as $b)
                <tr style="text-align: center">
                    <td style="text-align: center"><input type="checkbox" name="ids[]" value="'+data.id+'{{$b->id}}">
                    </td>
                    <td style="text-align: center">{{$b->id}}</td>
                    <td style="text-align: center">{{$b->profession_name}}</td>
                    <td style="text-align: center"><img src="{{$b->cover_img}}" width="100"/></td>
                    <td style="text-align: center">{{$b->profession_desc}}</td>
                    <td style="text-align: center"><a title="编辑" href="javascript:;"
                                                      onclick="lesson_edit('+{{$b->id}}+')" class="ml-5"
                                                      style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                        <a title="删除" href="javascript:;" onclick="lesson_del(this,'+{{$b->id}}+')" class="ml-5"
                           style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admins')}}/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
    function datadel() {
        //开始操作；
        //获取复选框的数据
        var ids = [];//定义一个数组，用于存储复选框的id;
        $("input:checked").each(function () {
            ids.push($(this).val());
        });
        if (ids.length < 1) {
            alert('至少得选一个吧');
            return false;
        }
        //继续执行代码；
        $.ajax({

            type: 'post',
            url: '{{url("admin/lesson/datadel")}}',
            data: {ids: ids, '_token': '{{csrf_token()}}'},
            success: function (msg) {
                if (msg.info == 1) {
                    //弹窗显示删成功，
                    layer.msg('批量删除成功', {icon: 6, time: 1000});
//                    mytable.api().ajax.reload();
                } else {
                    layer.msg('批量删除失败', {icon: 5, time: 1000});
                }
            }
        });

    }


    q
    /* 专业-添加*/
    //title是一个标题（提示文字）
    //url是一个路由（一个地址），加载的页面路由地址
    //w,窗口的宽度（可以使用默认值）
    //h,窗口的高度(可以使用默认值)
    /*function lesson_add(title,url,w,h){
        layer_show(title,url,w,h);
    }*/
    function lesson_add() {
        //layer_show该函数是实现弹窗效果的。
        layer_show('添加专业', '{{url("admin/profession/add")}}');
    }

    /*用户-查看*/
    function member_show(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }



    function lesson_edit(id) {
        layer_show('修改专业', '{{url("admin/lesson/update")}}/' + id);
    }

    /*密码-修改*/
    function change_password(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }

    /*专业-删除*/
    function lesson_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            $.ajax({
                type: 'POST',
                url: '{{url("admin/lesson/del")}}/' + id,
                data: {'_token': '{{csrf_token()}}'},
                dataType: 'json',
                success: function (data) {
                    if (data.info == 1) {
                        $(obj).parents("tr").remove();
                        layer.msg('删除成功!', {icon: 6, time: 1000});
                    } else {
                        layer.msg('删除失败!', {icon: 5, time: 1000});
                    }

                },
                error: function (data) {
                    console.log(data.msg);
                },
            });
        });
    }
</script>
</body>
</html>