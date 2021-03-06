<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="{{asset('admins')}}/lib/html5shiv.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link href="{{asset('admins')}}/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('admins')}}/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="{{asset('admins')}}/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>添加管理员 - 管理员管理 - H-ui.admin v3.1</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课程名称：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="" placeholder="" id="course_name" name="course_name">
		</div>
	</div>
	{{csrf_field()}}
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">所属专业：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="profession_id" size="1">
				<option value="">选择专业</option>
				@foreach($course as $v)
				<option value="{{$v->id}}">{{$v->profession_name}}</option>
				@endforeach
			</select>
			</span> </div>
	</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>课程价格：</label>
			<div class="formControls col-xs-4 col-sm-3">
				<input type="text" class="input-text" value="" placeholder="" id="course_price" name="course_price">
			</div>
		</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>缩略图：</label>
		<div class="formControls col-xs-8 col-sm-9">
				<!--用于显示上传成功后的图片-->
				<div id="fileList" class="uploader-list"></div>
				<input type="text" readonly="readonly" class="input-text"  id="cover_img" name="cover_img">
				<div id="a">
					<div class="b" style="width: 750px;">
						<span class="sr-only" style="width: 0%"></span>
					</div>
				</div>
				<!--显示图片上传的一个按钮-->
				<div id="filePicker">选择图片</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">课程描述：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="course_desc" cols="" rows="" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true" onKeyUp="$.Huitextarealength(this,100)"></textarea>
			<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
		</div>
	</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript" src="{{asset('admins')}}/lib/webuploader/0.1.5/webuploader.min.js"></script> 
<script type="text/javascript">
$(function(){
	var uploader1 = WebUploader.create({
		//表示自动上传
		auto: true,
		//引入一个小插件文件Uploader.swf
		swf: '{{asset("admins")}}/lib/webuploader/0.1.5/Uploader.swf',
	
		// 指定用于处理上传文件的路由
		server: '{{url("admin/course/upimage")}}',
	
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		//指定id=filePicker的元素为上传按钮；
		pick: '#filePicker',
	
		// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
		resize: false,
		// 只允许选择图片文件。
		accept: {
			title: '上传图片',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: 'image/*'
		},
		formData:{
			'_token':'{{csrf_token()}}'
		},
	});

	// 文件上传成功，处理的事件
	uploader1.on( 'uploadSuccess', function( file,res ) {
		//res是服务器端返回的数据，是一个json格式；
		var imgs = "<img src='"+res.info+"' width='100'/>"
		$("#fileList").html(imgs);
		$("#cover_img").val(res.info);
		layer.msg('上传成功',{icon:6,time:1000});
	});

// 文件上传过程中创建进度条实时显示。
	uploader1.on( 'uploadProgress', function( file, percentage ) {
		$("#a .sr-only").css( 'width', percentage * 100 + '%' );
	});




var uploader2 = WebUploader.create({
		//表示自动上传
		auto: true,
		//引入一个小插件文件Uploader.swf
		swf: '{{asset("admins")}}/lib/webuploader/0.1.5/Uploader.swf',
	
		// 指定用于处理上传文件的路由
		server: '{{url("admin/course/upvideo")}}',
	
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		//指定id=filePicker的元素为上传按钮；
		pick: '#filePicker2',
	
		// 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
		resize: false,
		// 只允许选择图片文件。
		accept: {
			title: '上传视频',
			extensions: '',
			mimeTypes: '*'
		},
		formData:{
			'_token':'{{csrf_token()}}'
		},
	});

	// 文件上传成功，处理的事件
	uploader2.on( 'uploadSuccess', function( file,res ) {
		//res是服务器端返回的数据，是一个json格式；
		var imgs = "<img src='"+res.info+"' width='100'/>"
		$("#video_address").val(res.info);
		layer.msg('上传成功',{icon:6,time:1000});
	});

// 文件上传过程中创建进度条实时显示。
	uploader2.on( 'uploadProgress', function( file, percentage ) {
		$("#a2 .sr-only").css( 'width', percentage * 100 + '%' );
	});
	//完成ajax的提交数据
	$("#form-admin-add").submit(function(e){
		//开始收集数据提交
		//阻止表单的默认提交
		e.preventDefault();
		//获取表单里面，提交的数据
		var data = $(this).serialize();//获取表单里面的输入的所有数据
		//ajax提交数据
		$.ajax({
			type:'post',
			url:'{{url("admin/course/add")}}',
			data:data,
			success:function(msg){
				if(msg.info==1){
					//添加成功，要弹出一个提示，同时要刷新dataTable表格
					layer.alert('添加成功',function(){
						//刷新dataTable表格
//						parent.mytable.api().ajax.reload();
						//关闭弹出框
						layer_close();
					});
				}else {
					//添加失败
					//msg.error是控制器中返回的错误提示；
					layer.msg('添加失败:'+msg.error,{icon:5,time:3000});
				}
			}
		});
	});







	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>